<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use App\BuildingType;
use App\province;
use App\BusinessType;
use App\RepresentativePosition;
use App\Floor;
use App\SizeRange;

class customController extends Controller
{
    //
	public function getCity($id)
	{
		$result=DB::table("cities")
		->select("cities.*")
		->join("provinces","cities.province_id","provinces.id")
		->where("cities.province_id","=",$id)
		->get();
		return Response::json($result);
	}
	public function getBanks()
	{
		$result=DB::table("banks")
		->select("banks.id",'banks.description')
		->get();
		return Response::json($result);
	}
	public function getMarketRate($id)
	{
		$result=DB::table("cities")
		->leftJoin("market_rates","cities.id","market_rates.city_id")
		->join('addresses','cities.id','addresses.city_id')
		->join('buildings','addresses.id','buildings.address_id')
		->where('buildings.id',$id)
		->whereRaw("market_rates.date_as_of=(SELECT MAX(date_as_of) from market_rates where city_id=cities.id)")
		->select(DB::raw("COALESCE(market_rates.rate,0) as rate"))
		->first(); 
		return Response::json($result->rate);
	}
	public function getBuildingType()
	{
		$result=BuildingType::where('is_active',1)
		->orderBy("description")
		->get();
		return Response::json($result);
	}
	public function getProvince()
	{
		$result=province::where('is_active',1)->get();
		return Response::json($result);
	}
	public function getFloor()
	{
		$result=Floor::where('floors.is_active','=',1)
		->groupBy('floors.number')
		->join('units','floors.id','units.floor_id')
		->select('floors.id','floors.number')
		->get();
		return Response::json($result);
	}
	public function getRange()
	{
		$range=SizeRange::where('is_active','=',1)
		->select(DB::Raw('id, size_from, size_to,CONCAT(size_from," - ",size_to," sqm") as name,CONCAT(size_from,"|",size_to) as value'))
		->get()
		;
		return Response::json($range);

	}
}


