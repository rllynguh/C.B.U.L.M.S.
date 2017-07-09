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


