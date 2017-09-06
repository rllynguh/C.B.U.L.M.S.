<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Datatables;
use App\address;
use App\building;
use App\BuildingType;
use App\floor;
use App\UnitPrice;
use Carbon\Carbon;
use Config;

class buildingController extends Controller
{
	public function __construct()
	{
		$this->middleware('admin');
		$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
    	$result=DB::table("buildings")
    	->select("addresses.*","cities.description as city_description", 'provinces.*' ,'buildings.*')
    	->join('addresses','buildings.address_id','addresses.id')
    	->join('cities','addresses.city_id',"cities.id")
    	->join('provinces','cities.province_id',"provinces.id")
    	->get();
        return response()->json($result);
    	return Datatables::of($result)
    	->addColumn('action', function ($data) {
    		return '<button id="btnAddFloor" type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-content-add"></i></button> <button id="btnEdit" type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button> <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float deleteRecord" value= "'.$data->id.'"><i class="mdi-action-delete"></i></button>
    		<button id="btnPrice" type="button" class="btn bg-brown btn-circle waves-effect waves-circle waves-float" value= "'.$data->id.'"><i class="mdi-editor-attach-money"></i></button>
    		';
    	})
    	->editColumn('is_active', function ($data) {
    		$checked = '';
    		if($data->is_active==1){
    			$checked = 'checked';
    		}
    		return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->id.'"><span class="lever switch-col-blue"></span>On</label></div>';
    	})
    	->setRowId(function ($data) {
    		return $data = 'id'.$data->id;
    	})
    	->rawColumns(['is_active','action'])
    	->make(true);
    }

    public function index()
    {
        //
    	$btype=Db::table('building_types')
    	->where("is_active",1)
    	->select("building_types.*")
    	->get();
    	$province=Db::table('provinces')
    	->where("is_active",1)
    	->select("provinces.*")
    	->get();
    	return view("maintenance.building.index")
    	->withBtype($btype)
    	->withProvince($province)
    	;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storefloor(Request $request)
    {
    	$floor=new floor();
    	$floor->number=$request->txtFNum;
    	$floor->building_id=$request->comBuilding;
    	$floor->num_of_unit=$request->txtUNum;
    	$floor->save();
    }
    public function storePrice(Request $request)
    {
    	$string="";
    	$result=DB::table('buildings')
    	->join('floors','buildings.id','floors.building_id')
    	->join('units','floors.id','units.floor_id')
    	->where('buildings.id',$request->building_id)
    	->where('floors.is_active','1')
    	->where('buildings.is_active','1')
    	->where('units.is_active','1');
    	$max_query=$result->Select(DB::Raw("Max(floors.number) as maximum"));
    	$max=$max_query->first()->maximum;
    	$current_price=$request->txtBasePrice;
    	if($request->comPriceChange==0)
    		$added_price=$current_price*($request->txtPriceChange/100);
    	else
    		$added_price=$request->txtPriceChange;
    	$output="";
    	for($x=$max;$x>0;$x--)
    	{
    		$units=DB::table('buildings')
    		->join('floors','buildings.id','floors.building_id')
    		->join('units','floors.id','units.floor_id')
    		->where('buildings.id',$request->building_id)
    		->where('floors.is_active','1')
    		->where('buildings.is_active','1')
    		->where('units.is_active','1')
    		->select('units.id')
    		->where('floors.number',$x)
    		->get();
    		foreach ($units as $unit) {
    			$output.=" ".$x;
    			$unit_price=new UnitPrice();
    			$unit_price->unit_id=$unit->id;
    			$unit_price->date_as_of=Carbon::now(Config::get('app.timezone'));
    			$unit_price->price=$current_price;
    			$unit_price->save();
    		}
    		$current_price+=$added_price;
    	}
    	return response::json($output);
    }
    public function store(Request $request)
    {
        //
    	$latest=DB::table("buildings")
    	->select("buildings.*")
    	->orderBy('buildings.code',"DESC")
    	->join('building_types','buildings.building_type_id','building_types.id')
    	->join('addresses','buildings.address_id','addresses.id')
    	->where('buildings.building_type_id',$request->comBuilType)
    	->first();
    	$btype=BuildingType::find($request->comBuilType);
    	$pk="BLDG".strtoupper(substr($btype->description, 0, 3));
    	if(!is_null($latest))
    		$pk=$latest->code;
    	$sc= new smartCounter();
    	$pk=$sc->increment($pk);
    	$address=new address();
    	$address->number=$request->txtSNum;
    	$address->street=$request->txtStreet;
    	$address->district=$request->txtDistrict;
    	$address->city_id=$request->comCity;
    	$address->save();
    	try
    	{
    		$result=new building();
    		$result->code=$pk;
    		$result->description=$request->txtBuilDesc;
    		$result->building_type_id=$request->comBuilType;
    		$result->num_of_floor=$request->txtBFNum;
    		$result->address_id=$address->id;
    		$result->save();
    	}
    	catch(\Exception $e) {
    		return $e;
    	} 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function getFloor($id)
    {
    	$result=DB::table("floors")
    	->join("buildings","floors.building_id","buildings.id")
    	->orderBy("floors.number","desc")
    	->select(DB::raw("buildings.num_of_floor as max,COALESCE(MAX(number) + 1,1) as current, count(*) as count"))
    	->where("buildings.id",$id)
    	->first();
    	return Response::json($result);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    	$result = DB::table('buildings')
    	->select('addresses.*','addresses.number as address_number','cities.*','floors.*','provinces.*','building_types.description as building_type_description','buildings.*',DB::raw('COUNT(floors.building_id) as current'))
    	->leftJoin('floors','buildings.id','=','floors.building_id')
    	->join('addresses','buildings.address_id','=','addresses.id')
    	->join('cities','addresses.city_id',"cities.id")
    	->join('provinces','cities.province_id',"provinces.id")
    	->join('building_types','buildings.building_type_id','=','building_types.id')
    	->where('buildings.id','=',$id)
    	->groupBy('buildings.id')
    	->first();
    	return Response::json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         //
    	try
    	{
    		try
    		{
    			$result=building::find($id);
    			$result->description=$request->txtBuilDesc;
    			$result->num_of_floor=$request->txtBFNum;
    			$result->save();
    		}catch(\Exception $e)
    		{
    			if($e->errorInfo[1]==1062)
    				return "This Data Already Exists";
    			else
    				return var_dump($e->errorInfo[1]);
    		}
    	}
    	catch(\Exception $e)
    	{
    		return "Deleted";
    	}
    	$address=address::find($result->address_id);
    	$address->number=$request->txtSNum;
    	$address->street=$request->txtStreet;
    	$address->district=$request->txtDistrict;
    	$address->city_id=$request->comCity;
    	$address->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softdelete($id)
    {
    	$result=building::find($id);
    	if($result->is_active==1)
    		$val=0;
    	else
    		$val=1;
    	$result->is_active=$val;
    	$result->save();
    }
    public function destroy($id)
    {
        //
    	try
    	{
    		$result = building::findorfail($id);
    		try
    		{
    			$result->delete();
    			return response::json($result->description);
    		}
    		catch(\Exception $e) {
    			if($e->errorInfo[1]==1451)
    				return Response::json(['true',$result->description]);
    			else
    				return Response::json(['true',$result,$e->errorInfo[1]]);
    		}
    	} 
    	catch(\Exception $e) {
    		return "Deleted";
    	}
    }
}
