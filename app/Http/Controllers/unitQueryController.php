<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use App\Building;
use App\Floor;

class unitQueryController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('admin');
		$this->middleware('auth');
	}
    //
	public function index()
	{
		$buildings=Building::where('is_active','=','1')
		->select('description','id')
		->orderBy('description')
		->pluck('description','id');

		$floors=Floor::where('is_active','=','1')
		->select('number','id')
		->orderBy('number')
		->groupBy('number')
		->pluck('number','number')
		;
		return view('query.unit.index')
		->withBuildings($buildings)
		->withFloors($floors)
		;
	}
	public function data(Request $request)
	{
		$result=DB::table("units")
		->select(DB::Raw('price,buildings.description,floors.number as floor_number,units.code as unit_code,units.type,units.size,units.is_active,units.id,CONCAT(cities.description,", ",provinces.description) as location'))
		->join("floors","units.floor_id","floors.id")
		->join("buildings","floors.building_id","buildings.id")
		->join('addresses','buildings.address_id','addresses.id')
		->join('cities','addresses.city_id',"cities.id")
		->join('provinces','cities.province_id',"provinces.id")
		->join("building_types","buildings.building_type_id","building_types.id")
		->leftJoin('unit_prices','units.id','unit_prices.unit_id')
		->whereRaw("unit_prices.date_as_of=(SELECT MAX(unit_prices.date_as_of) from unit_prices where unit_id=units.id)")
		->where("buildings.is_active",1)
		->where('buildings.id',$request->building)
		->where('floors.number',$request->floor)

		->get();

		return Datatables::of($result)
		->addColumn('action', function ($data) {
			return '<button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button>';
		})
		->editColumn('is_active', function ($data) {
			$checked = '';
			if($data->is_active==1){
				$checked = 'checked';
			}
			return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->id.'"><span class="lever switch-col-blue"></span>On</label></div>';
		})
		->editColumn('size', function ($data) {

			return "$data->size sqm";
		})
		->editColumn('price', function ($data) {

			return "P $data->price /sqm";
		})
		->editColumn('type', function ($data) {
			$value = 'Raw';
			if($data->type==1){
				$value = 'Shell';
			}
			return $value;
		})
		->setRowId(function ($data) {
			return $data = 'id'.$data->id;
		})
		->rawColumns(['is_active','action'])
		->make(true);
	}
}
