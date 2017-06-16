<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use App\building_type;
use App\province;

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
		$result=building_type::where('is_active',1)->get();
		return Response::json($result);
	}
	public function getProvince()
	{
		$result=province::where('is_active',1)->get();
		return Response::json($result);
	}
}

