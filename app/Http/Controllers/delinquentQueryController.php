<?php

namespace App\Http\Controllers;
use DB;
use Carbon\Carbon;
use Config;
use Illuminate\Http\Request;
use Datatables;


class delinquentQueryController extends Controller
{
    //
	public function index()
	{
		return view('query.delinquent.index');
	}
	public function data(Request $request)
	{
		$results=DB::TABLE('billing_headers')
		->JOIN('payments','billing_headers.id','payments.billing_header_id')
		->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
		->JOIN('contract_details','current_contracts.id','contract_details.current_contract_id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->JOIN('business_types','tenants.business_type_id','business_types.id')
		->SELECT('tenants.description as tenant','business_types.description as business','contract_headers.code','current_contracts.date_issued',DB::RAW('count(distinctrow contract_details.id) as unit_count, MAX(DATEDIFF(payments.date_collected,billing_headers.date_issued)) as gap, payments.date_collected,billing_headers.date_issued'))
		->GROUPBY('tenants.id')
		->HAVING('gap','>',0)
		->GET();
		foreach ($results as $result) {
			# code...
			$dt=new Carbon($result->date_issued);
			$dt2=new Carbon($result->date_collected);
			$result->gap=$dt->diffForHumans($dt2);   

		}
		return Datatables::of($results)
		->make(true)
		;
	}
}
