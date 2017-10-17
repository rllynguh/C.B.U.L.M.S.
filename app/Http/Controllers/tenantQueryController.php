<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Config;
use Carbon\Carbon;

class tenantQueryController extends Controller
{
	public function __construct()
	{
		$this->middleware('admin');
		$this->middleware('auth');
	}
    //
	public function index()
	{
		return view('query.tenant.index');
	}
	public function data(Request $request)
	{
		$results=DB::TABLE('move_in_details')
		->SELECT(DB::Raw('(unit_prices.price * units.size) as rent,units.code as unit_code,units.size,unit_prices.price as rate,current_contracts.start_of_contract,current_contracts.end_of_contract,CONCAT(cities.description,"",provinces.description) as location,tenants.description as tenant'))
		->JOIN('contract_details','move_in_details.contract_detail_id','contract_details.id')
		->JOIN('current_contracts','contract_details.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->JOIN('units','contract_details.unit_id','units.id')
		->JOIN("floors","units.floor_id","floors.id")
		->JOIN("buildings","floors.building_id","buildings.id")
		->join('addresses','buildings.address_id','addresses.id')
		->join('cities','addresses.city_id',"cities.id")
		->join('provinces','cities.province_id',"provinces.id")
		->JOIN('unit_prices','units.id','unit_prices.unit_id')
		->WHERERAW("unit_prices.date_as_of=(SELECT MAX(unit_prices.date_as_of) from unit_prices where unit_id=units.id)")
		->GET();
		foreach ($results as $result) {
			# code...
			$dt=new Carbon($result->start_of_contract);
			$dt2=new Carbon($result->end_of_contract);
			$dt=$dt->toFormattedDateString();
			$dt2=$dt2->toFormattedDateString();
			$result->lease_period="From $dt to $dt2" ;  
			$result->rate="₱ ".number_format($result->rate,2);
			$result->size=number_format($result->size,2);
			$result->rent="₱ ".number_format($result->rent,2);
		}
		return Datatables::of($results)
		->make(true)
		;
	}
}
