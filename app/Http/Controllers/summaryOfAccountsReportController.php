<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use Config;
use PDF;
use Illuminate\Http\Request;

class summaryOfAccountsReportController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('admin');
		$this->middleware('auth');
	}
	public function index()
	{
		return view('report.summaryOfAccounts.index');
	}
	public function document(Request $request)
	{

		$contracts=DB::TABLE('tenants')
		->JOIN('registration_headers','registration_headers.tenant_id','tenants.id')
		->JOIN('contract_headers','registration_headers.id','contract_headers.registration_header_id')
		->JOIN('current_contracts','contract_headers.id','current_contracts.contract_header_id')
		->JOIN('billing_headers','current_contracts.id','billing_headers.current_contract_id')
		->LEFTJOIN('payments','billing_headers.id','payments.billing_header_id')
		->JOIN('billing_details','billing_headers.id','billing_details.billing_header_id')
		->JOIN('billing_items','billing_details.billing_item_id','billing_items.id')
		->WHERE('billing_items.description','Rent')
		->GROUPBY('current_contracts.id')
		->HAVINGRAW('SUM(payment) < billing_headers.cost AND DATEDIFF("'.$request->date.'",billing_headers.date_issued)>=0')
		->SELECT('tenants.description as tenant','current_contracts.id as current_contract_id','payment','cost','billing_headers.date_issued',DB::RAW('SUM(payment),billing_headers.cost,DATEDIFF("'.$request->date.'",billing_headers.date_issued),billing_headers.cost -(SUM(COALESCE(payment,0))) as outstanding_balance'))
		->GET();
		$cost_summary=0;
		$outstanding_balance_summary=0;
		$current_summary=0;
		$overthirty_summary=0;
		$oversixty_summary=0;
		$overonetwenty_summary=0;

		foreach ($contracts as $contract) {
			$outstanding_balance_summary+=$contract->outstanding_balance;
			$cost_summary+=$contract->cost;

			$contract->outstanding_balance="PHP ".number_format($contract->outstanding_balance);
			$contract->cost="PHP ".number_format($contract->cost);
			$units=DB::TABLE('units')
			->JOIN('floors','units.floor_id','floors.id')
			->JOIN('buildings','floors.building_id','buildings.id')
			->JOIN('contract_details','contract_details.unit_id','units.id')
			->WHERE('current_contract_id',$contract->current_contract_id)
			->SELECT('units.code','units.size','buildings.description')
			->GET();
			$code="";
			$size=0;
			$location="";
			foreach ($units as $key => $unit) {
				# code...
				if($key==0)
				{
					$code.=$unit->code;
					$location.=$unit->description;
				}
				else
				{
					$code.=", $unit->code";
					$location.=", $unit->description";
				}
				$size+=$unit->size;
			}
			$contract->unit_size=number_format($size,2)." sqm";
			$contract->unit_code=$code;
			$contract->location=$location;
			$current=
			DB::TABLE('current_contracts')
			->JOIN('billing_headers','current_contracts.id','billing_headers.current_contract_id')
			->LEFTJOIN('payments','billing_headers.id','payments.billing_header_id')
			->JOIN('billing_details','billing_headers.id','billing_details.billing_header_id')
			->JOIN('billing_items','billing_details.billing_item_id','billing_items.id')
			->WHERE('billing_items.description','Rent')
			->WHERE('current_contracts.id',$contract->current_contract_id)
			->GROUPBY('current_contracts.id')
			->HAVINGRAW('SUM(COALESCE(payment,0)) < billing_headers.cost AND DATEDIFF("'.$request->date.'",billing_headers.date_issued)<30 AND DATEDIFF("'.$request->date.'",billing_headers.date_issued) >=0')
			->SELECT(DB::RAW('cost-(SUM(COALESCE(payment,0))) as balance,billing_headers.cost,billing_headers.date_issued,SUM(COALESCE(payment,0)),DATEDIFF("'.$request->date.'",billing_headers.date_issued)'))
			->FIRST();
			if(is_null($current))
				$current=(object)['balance'=>0];
			$current_summary+=$current->balance;
			$contract->current_balance="PHP ".number_format($current->balance,2);
			$overthirty=
			DB::TABLE('current_contracts')
			->JOIN('billing_headers','current_contracts.id','billing_headers.current_contract_id')
			->LEFTJOIN('payments','billing_headers.id','payments.billing_header_id')
			->JOIN('billing_details','billing_headers.id','billing_details.billing_header_id')
			->JOIN('billing_items','billing_details.billing_item_id','billing_items.id')
			->WHERE('billing_items.description','Rent')
			->WHERE('current_contracts.id',$contract->current_contract_id)
			->GROUPBY('current_contracts.id')
			->HAVINGRAW('SUM(COALESCE(payment,0)) < billing_headers.cost AND DATEDIFF("'.$request->date.'",billing_headers.date_issued)<61 AND DATEDIFF("'.$request->date.'",billing_headers.date_issued) >30')
			->SELECT(DB::RAW('cost-(SUM(COALESCE(payment,0))) as balance,billing_headers.cost,billing_headers.date_issued,SUM(COALESCE(payment,0)),DATEDIFF("'.$request->date.'",billing_headers.date_issued)'))
			->FIRST();
			if(is_null($overthirty))
				$overthirty=(object)['balance'=>0];
			$overthirty_summary+=$overthirty->balance;

			$contract->overthirty_balance="PHP ".number_format($overthirty->balance,2);
			$overSixty=
			DB::TABLE('current_contracts')
			->JOIN('billing_headers','current_contracts.id','billing_headers.current_contract_id')
			->LEFTJOIN('payments','billing_headers.id','payments.billing_header_id')
			->JOIN('billing_details','billing_headers.id','billing_details.billing_header_id')
			->JOIN('billing_items','billing_details.billing_item_id','billing_items.id')
			->WHERE('billing_items.description','Rent')
			->WHERE('current_contracts.id',$contract->current_contract_id)
			->GROUPBY('current_contracts.id')
			->HAVINGRAW('SUM(COALESCE(payment,0)) < billing_headers.cost AND DATEDIFF("'.$request->date.'",billing_headers.date_issued)>60 AND DATEDIFF("'.$request->date.'",billing_headers.date_issued) <=120')
			->SELECT(DB::RAW('cost-(SUM(COALESCE(payment,0))) as balance,billing_headers.cost,billing_headers.date_issued,SUM(COALESCE(payment,0)),DATEDIFF("'.$request->date.'",billing_headers.date_issued)'))
			->FIRST();
			if(is_null($overSixty))
				$overSixty=(object)['balance'=>0];
			$oversixty_summary+=$overSixty->balance;
			$contract->overSixty_balance="PHP ".number_format($overSixty->balance,2);
			$overonetwenty=
			DB::TABLE('current_contracts')
			->JOIN('billing_headers','current_contracts.id','billing_headers.current_contract_id')
			->LEFTJOIN('payments','billing_headers.id','payments.billing_header_id')
			->JOIN('billing_details','billing_headers.id','billing_details.billing_header_id')
			->JOIN('billing_items','billing_details.billing_item_id','billing_items.id')
			->WHERE('billing_items.description','Rent')
			->WHERE('current_contracts.id',$contract->current_contract_id)
			->GROUPBY('current_contracts.id')
			->HAVINGRAW('SUM(COALESCE(payment,0)) < billing_headers.cost AND DATEDIFF("'.$request->date.'",billing_headers.date_issued)>120')
			->SELECT(DB::RAW('cost-(SUM(COALESCE(payment,0))) as balance,billing_headers.cost,billing_headers.date_issued,SUM(COALESCE(payment,0)),DATEDIFF("'.$request->date.'",billing_headers.date_issued)'))
			->FIRST();
			if(is_null($overonetwenty))
				$overonetwenty=(object)['balance'=>0];
			$overonetwenty_summary+=$overonetwenty->balance;
			$contract->overonetwenty_balance="PHP ".number_format($overonetwenty->balance,2);
		}
		$summary=(object)['cost'=>"PHP ".number_format($cost_summary,2),'outstanding_balance'=>"PHP ".number_format($outstanding_balance_summary,2),
		'current'=>"PHP ".number_format($current_summary,2),'oversixty'=>"PHP ".number_format($oversixty_summary,2),'overthirty'=>"PHP".number_format($overthirty_summary,2),
		'overonetwenty'=>"PHP ".number_format($overonetwenty_summary,2)
	];
	$today = Carbon::today(); 
	$pdf_details = array('today' => $today, );
	$pdf_details = array('today' => Carbon::today() );
	$pdf = PDF::loadView('report.summaryOfAccounts.document', compact('pdf_details','contracts','summary'))->setPaper('A4','landscape');
	return $pdf->stream();
}
}
