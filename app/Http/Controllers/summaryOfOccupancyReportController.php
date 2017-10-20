<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Carbon\Carbon;
use Config;

class summaryOfOccupancyReportController extends Controller
{
    //
     //
	public function __construct()
	{
		$this->middleware('admin');
		$this->middleware('auth');
	}
	public function index()
	{
		return view('report.summaryOfOccupancy.index');
	}
	public function document(Request $request)
	{

		$cities=DB::TABLE('cities')
		->JOIN('addresses','addresses.city_id','cities.id')
		->JOIN('buildings','addresses.id','buildings.address_id')
		->JOIN('floors','buildings.id','floors.building_id')
		->JOIN('units','floors.id','units.floor_id')
		->GROUPBY('cities.id')
		->SELECT('cities.id','cities.description')
		->GET();
		foreach ($cities as $city) {
			# code...
			$active=DB::TABLE('cities')
			->JOIN('addresses','addresses.city_id','cities.id')
			->JOIN('buildings','addresses.id','buildings.address_id')
			->JOIN('floors','buildings.id','floors.building_id')
			->JOIN('units','floors.id','units.floor_id')
			->WHERERAW('units.id in (select contract_details.unit_id from contract_details inner join current_contracts on current_contracts.id=contract_details.current_contract_id where current_contracts.status=1)')
			->GROUPBY('units.id')
			->COUNT();

			$vacant=DB::TABLE('cities')
			->JOIN('addresses','addresses.city_id','cities.id')
			->JOIN('buildings','addresses.id','buildings.address_id')
			->JOIN('floors','buildings.id','floors.building_id')
			->JOIN('units','floors.id','units.floor_id')
			->GROUPBY('units.id')
			->WHERERAW('units.id not in (select contract_details.unit_id from contract_details  inner join current_contracts on current_contracts.id=contract_details.current_contract_id where current_contracts.status=1)')
			->COUNT();
			$others=DB::TABLE('cities')
			->JOIN('addresses','addresses.city_id','cities.id')
			->JOIN('buildings','addresses.id','buildings.address_id')
			->JOIN('floors','buildings.id','floors.building_id')
			->JOIN('units','floors.id','units.floor_id')
			->GROUPBY('units.id')
			->COUNT();
			$city->active=$active;
			$city->vacant=$vacant;
			$undernego=DB::TABLE('cities')
			->JOIN('addresses','addresses.city_id','cities.id')
			->JOIN('buildings','addresses.id','buildings.address_id')
			->JOIN('floors','buildings.id','floors.building_id')
			->JOIN('units','floors.id','units.floor_id')
			->GROUPBY('units.id')
			->WHERERAW('units.id not in (select contract_details.unit_id from contract_details  inner join current_contracts on current_contracts.id=contract_details.current_contract_id where current_contracts.status=1) and units.id in (select unit_id from offer_sheet_details)')
			->COUNT();
			$city->active=$active;
			$city->vacant=$vacant;
			$city->undernego=$undernego;
			$city->others=$others- ($active + $vacant + $undernego);
			$total=$city->active + $city->vacant + $city->undernego;
			$city->total=$total;



		}
		$today = Carbon::today(); 
		$pdf_details = array('today' => $today, );
		$pdf_details = array('today' => Carbon::today() );
		$pdf = PDF::loadView('report.summaryOfOccupancy.document', compact('pdf_details','cities'));
		return $pdf->stream();
	}
}
