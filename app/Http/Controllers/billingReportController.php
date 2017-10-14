<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Config;
use Carbon\Carbon;
use PDF;
class billingReportController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('admin');
		$this->middleware('auth');
	}
	public function index()
	{
		return view('report.billing.index');
	}
	public function document(Request $request)
	{
		$summary=DB::TABLE('billing_headers')
		->SELECT(DB::RAW('SUM(payments.payment) as payment,SUM(billing_headers.cost) as cost'))
		->LEFTJOIN('payments','billing_headers.id','payments.billing_header_id')
		->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHEREBETWEEN('billing_headers.date_issued',[$request->from,$request->to])
		->FIRST()
		;
		$summary->payment="PHP ".number_format($summary->payment,2);
		$summary->cost="PHP ".number_format($summary->cost,2);

		$tenants=DB::TABLE('billing_headers')
		->SELECT(DB::RAW('SUM(payments.payment) as payment,SUM(billing_headers.cost) as cost'),'tenants.id as tenant_id','tenants.description')
		->LEFTJOIN('payments','billing_headers.id','payments.billing_header_id')
		->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHEREBETWEEN('billing_headers.date_issued',[$request->from,$request->to])
		->GROUPBY('tenants.id')
		->GET()
		;
		foreach ($tenants as $tenant) {
			# code...
			$tenant->payment="PHP ".number_format($tenant->payment,2);
			$tenant->cost="PHP ".number_format($tenant->cost,2);
		}

		$headers=DB::TABLE('billing_headers')
		->SELECT(DB::RAW('CONCAT(first_name," ",last_name) as name, SUM(payments.payment) as payment'),'billing_headers.id as header_id','tenants.id as tenant_id','billing_headers.date_issued','billing_headers.code','billing_headers.cost')
		->LEFTJOIN('payments','billing_headers.id','payments.billing_header_id')
		->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->JOIN('users','billing_headers.user_id','users.id')
		->WHEREBETWEEN('billing_headers.date_issued',[$request->from,$request->to])
		->GROUPBY('billing_headers.id')
		->GET()
		;
		foreach ($headers as $header) {
			$header->cost="PHP ".number_format($header->cost,2);
			$header->date_issued=Carbon::createFromFormat('Y-m-d',$header->date_issued)->toFormattedDateString();
			$header->payment="PHP ".number_format($header->payment,2);
		}

		$details=DB::TABLE('billing_headers')
		->SELECT('billing_headers.id as header_id','billing_details.price','billing_items.description')
		->JOIN('billing_details','billing_headers.id','billing_details.billing_header_id')
		->JOIN('billing_items','billing_details.billing_item_id','billing_items.id')
		->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->JOIN('users','billing_headers.user_id','users.id')
		->WHEREBETWEEN('billing_headers.date_issued',[$request->from,$request->to])
		->GROUPBY('billing_details.id')
		->GET()
		;

		foreach ($details as $detail) {
			# code...
			$detail->price="PHP ".number_format($detail->price,2);
		}

		$pdf=PDF::loadView('report.billing.document',compact('tenants','headers','details','summary'))->stream();
		return $pdf;
	}
}
