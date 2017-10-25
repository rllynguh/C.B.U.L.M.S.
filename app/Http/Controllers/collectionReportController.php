<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Carbon\Carbon;
use Config;
use DateTime;
use App\Tenant;

class collectionReportController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('admin');
		$this->middleware('auth');
	}

	public function document(Request $request)
	{
		$grandTotal=DB::TABLE('payments')
		->JOIN('billing_headers','payments.billing_header_id','billing_headers.id')
		->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHEREBETWEEN('payments.date_collected',[$request->from,$request->to])
		->SELECT('tenants.id as tenant_id','tenants.description',DB::RAW('SUM(payments.payment) as total'))
		->FIRST()->total;
		$grandTotal="PHP ".number_format($grandTotal,2);
		$tenants=DB::TABLE('payments')
		->JOIN('billing_headers','payments.billing_header_id','billing_headers.id')
		->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHEREBETWEEN('payments.date_collected',[$request->from,$request->to])
		->GROUPBY('tenants.id')
		->SELECT('tenants.id as tenant_id','tenants.description',DB::RAW('SUM(payments.payment) as total'))
		->GET();

		foreach ($tenants as $key => $tenant) {
			# code...
			$tenant->total="PHP ".number_format($tenant->total);
		}


		$headers=DB::TABLE('payments')
		->JOIN('billing_headers','payments.billing_header_id','billing_headers.id')
		->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->JOIN('users','payments.user_id','users.id')
		->WHEREBETWEEN('payments.date_collected',[$request->from,$request->to])
		->GROUPBY('billing_headers.id')
		->SELECT('payments.id as payment_id','billing_headers.code as bill_code','payments.code as payment_code','payments.date_collected','billing_headers.id as header_id','tenants.id as tenant_id','tenants.description','payments.id','billing_headers.cost',DB::RAW('CONCAT(first_name," ",last_name) as name,SUM(payments.payment) as total,mode'))
		->GET();

		foreach ($headers as $key => $header) {
			# code...
			$header->total="PHP ".number_format($header->total);
			$date = new DateTime($header->date_collected);
			$result = $date->format('F d,Y');
			$header->date_collected=$result;
			if($header->mode==0)
				$header->mode='Cash';
			else if($header->mode==1)
				$header->mode='PDC';
			else if($header->mode==2)
				$header->mode='Fund Transfer';
			else
				$header->mode='Dated Check';
			$header->cost="PHP ".number_format($header->cost);
		}

		//when mode of payment is pdc
		$pdcs=DB::TABLE('post_dated_checks')
		->JOIN('banks','post_dated_checks.bank_id','banks.id')
		->WHERE('is_accepted',1)
		->SELECT('payment_id','code','description')
		->GET();


		//when mode of payment is fund transfer
		$fund_banks=DB::TABLE('fund_transfers')
		->JOIN('payments','fund_transfers.payment_id','payments.id')
		->JOIN('banks','fund_transfers.bank_id','banks.id')
		->SELECT('payments.id as payment_id','banks.description')
		->GET()
		;


		$details=DB::TABLE('payments')
		->JOIN('billing_headers','payments.billing_header_id','billing_headers.id')
		->JOIN('billing_details','billing_headers.id','billing_details.billing_header_id')
		->JOIN('billing_items','billing_details.billing_item_id','billing_items.id')
		->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHEREBETWEEN('payments.date_collected',[$request->from,$request->to])
		->GROUPBY('billing_details.id')		
		->SELECT('billing_headers.id as header_id','billing_items.description','billing_details.price','billing_details.price')
		->GET();
		foreach ($details as $key => $detail) {
			# code...
			$detail->price="PHP ".number_format($detail->price,2);
		}

		$today = Carbon::today(); 
		$pdf_details = array('today' => $today, );
		$pdf_details = array('today' => Carbon::today() );
		$pdf = PDF::loadView('report.collection.document', compact('pdf_details','details','tenants','headers','pdcs','fund_banks','grandTotal'));
		return $pdf->stream();
	}

	public function index()
	{
		return view('report.collection.index');
	}
	public function index2()
	{
		return view('report.collection.index2');	
	}

	public function document2(Request $request)
	{
		$contracts=Tenant::JOIN('registration_headers','tenants.id','registration_headers.tenant_id')
		->JOIN('contract_headers','registration_headers.id','contract_headers.registration_header_id')
		->JOIN('current_contracts','contract_headers.id','current_contracts.contract_header_id')
		->SELECT('current_contracts.id')
		->GROUPBY('current_contracts.id')
		->GET();

		$getId = $contracts->map(function ($contracts) {
			return collect($contracts->toArray())
			->only(['id'])
			->all();
		});

			# code...
		$monthArray=collect(['JAN','FEB','MARCH','APRIL','MAY','JUN','JULY','AUG','SEPT','OCT','NOV','DEC']);
		$month=new Carbon($request->date);
		$month=$month->format('m');
		$monthSamting=DB::TABLE('current_contracts')
		->JOIN('billing_headers','current_contracts.id','billing_headers.current_contract_id')
		->LEFTJOIN('payments','billing_headers.id','payments.billing_header_id')
		// ->JOIN('billing_details','billing_headers.id','billing_details.billing_header_id')
		// ->JOIN('billing_items','billing_details.billing_item_id','billing_items.id')
		// ->WHERE('billing_items.description','Rent')
		->SELECT('current_contract_id','payments.date_collected',DB::RAW('SUM(COALESCE(payment,0)) as payment,MONTH("'.$request->date.'") as month'))
		->GROUPBY('current_contracts.id')
		->GET()
		;


		$today = Carbon::today(); 
		$pdf_details = array('today' => $today, );
		$pdf_details = array('today' => Carbon::today() );
		$pdf = PDF::loadView('report.collection.document2', compact('pdf_details','monthSamting'));
		return $pdf->stream();
	}


}
