<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Config;
use PDF;

class contractReportController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('admin');
		$this->middleware('auth');
	}
	public function index()
	{
		return view('report.contract.index');
	}
	public function document(Request $request)
	{

		$headers=DB::TABLE('contract_headers')
		->JOIN('current_contracts','contract_headers.id','current_contracts.contract_header_id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHEREBETWEEN('start_of_contract',[$request->from,$request->to])
		->SELECT("tenants.description as tenant","current_contracts.id as header_id",'contract_headers.code','start_of_contract','end_of_contract')->GROUPBY("current_contracts.id")->GET();
		foreach ($headers as $key => &$header) {
			$header->start_of_contract=new Carbon($header->start_of_contract);
			$header->start_of_contract=$header->start_of_contract->toFormattedDateString();
			$header->end_of_contract=new Carbon($header->end_of_contract);
			$header->end_of_contract=$header->end_of_contract->toFormattedDateString();
		}


		$details=DB::TABLE('contract_details')
		->JOIN('current_contracts','contract_details.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->JOIN('units','contract_details.unit_id','units.id')
		->JOIN('floors','units.floor_id','floors.id')
		->JOIN('buildings','floors.building_id','buildings.id')
		->WHEREBETWEEN('start_of_contract',[$request->from,$request->to])
		->SELECT("current_contracts.id as header_id",'units.code','units.type','buildings.description as building','units.type','floors.number','units.size')
		->GET();
		foreach ($details as $key => &$detail) {
			if($detail->type==0)
				$detail->type='Raw';
			else
				$detail->type='Shell';
			$detail->size=number_format($detail->size)." sqm";
		}
		$today = Carbon::today(); 
		$pdf_details = array('today' => $today, );
		$pdf_details = array('today' => Carbon::today() );
		$pdf = PDF::loadView('report.contract.document', compact('pdf_details','details','headers'));
		return $pdf->stream();
	}
}
