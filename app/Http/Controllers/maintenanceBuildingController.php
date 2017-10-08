<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Building;
use App\Floor;
use App\Address;
use App\BuildingType;
use App\UnitPrice;
use DB;
use Datatables;
class maintenanceBuildingController extends Controller
{
     public function manageItemAjax()
    {
        return view('maintenance.test');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=DB::table("buildings")
        ->select("addresses.*","cities.description as city_description", 'provinces.*' ,'buildings.*')
        ->join('addresses','buildings.address_id','addresses.id')
        ->join('cities','addresses.city_id',"cities.id")
        ->join('provinces','cities.province_id',"provinces.id")
        ->select('cities.description as city_name','buildings.code as code','buildings.description as building_name','buildings.is_active as status',
            'buildings.id as id')
        ->get();
        // <button id = "btnShowParkArea" class="btn btn-primary btnChangeTable" data-id = "'.$data->id.'">Show Park Area</button>
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return '<button id = "btnShowFloor" class="btn btn-primary btnChangeTable" data-id = "'  .$data->id.  '">Show floors</button>
            <button data-toggle="modal" data-target="#buildingCreateModal" class="btn btn-primary btnEdit" data-edit = "building" data-id = "'.$data->id.'">Show price</button>
            <button data-toggle="modal" data-target="#buildingCreateModal" class="btn btn-primary btnEdit" data-edit = "building" data-id = "'.$data->id.'">Edit</button>
            
            <button class="btn btn-danger remove-item">Delete</button>';
        })
        ->editColumn('is_active', function ($data) {
            $checked = '';
            if($data->status==1){
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
    public function getFloors($id){
        $result=DB::table("floors")
        ->where("building_id",$id)
        ->get();
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return '
            <button id = "btnShowBuilding" class="btn btn-primary btnChangeTable" data-id = "'  .$data->id.  '">Go back</button>
            <button id = "btnShowUnit" class="btn btn-primary btnChangeTable" data-id = "'  .$data->id.  '">Show Units</button>
            <button data-toggle="modal" data-target="#floorCreateModal" class="btn btn-primary edit-item">Edit</button>
            <button class="btn btn-danger remove-item">Delete</button>';
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
    public function insertFloor(Request $request){
      $floor=new floor();
      $floor->number=$request->floor_number;
      $floor->building_id=$request->comBuilding;
      $floor->num_of_unit=$request->floor_units;
      $floor->save();
    }
    public function getUnits($id){
      $result=DB::table("units")
      ->select(DB::Raw('Coalesce(price,1) as price,buildings.description as building_name,floors.number as floor_number,units.code as code,units.type as type,units.size as size,units.is_active as is_active,units.id,buildings.id as building_id'))
      ->join("floors","units.floor_id","floors.id")
      ->join("buildings","floors.building_id","buildings.id")
      ->leftJoin('unit_prices','units.id','unit_prices.unit_id')
      ->where("units.floor_id",$id)
      ->whereRaw("unit_prices.date_as_of=(SELECT MAX(unit_prices.date_as_of) from unit_prices where unit_id=units.id) or isnull(unit_prices.date_as_of)")
      ->get();
      return Datatables::of($result)
      ->addColumn('action', function ($data) {
        return '
            <button id = "btnShowFloor" class="btn btn-primary btnChangeTable" data-id = "'.$data->building_id.'">Go back</button>
            <button data-toggle="modal" data-target="#unitCreateModal" class="btn btn-primary btnEdit" data-edit = "unit" data-id = "'.$data->id.'">Edit</button>
            <button class="btn btn-danger remove-item">Delete</button>';
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

        return "P $data->price / month";
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
    public function getParkAreas($id){
      $result=DB::table("Park_areas")
      ->join("floors","Park_areas.floor_id","floors.id")
      ->join("buildings","floors.building_id","buildings.id")
      ->select("buildings.description as building_description","floors.number","Park_areas.*")
      ->get();
      return Datatables::of($result)
      ->addColumn('action', function ($data) {
        return '<button id="btnAddParkSpace" type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-content-add"></i></button> <button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button>';
      })
      ->editColumn('is_active', function ($data) {
        $checked = '';
        if($data->is_active==1){
          $checked = 'checked';
        }
        return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->id.'"><span class="lever switch-col-blue"></span>On</label></div>';
      })
      ->editColumn('dblParkAreaSize', function ($data) {

        return "$data->size sqm";
      })
      ->setRowId(function ($data) {
        return $data = 'id'.$data->id;
      })
      ->rawColumns(['is_active','action'])
      ->make(true);
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
    public function store(Request $request)
    {
        $latest=DB::table("buildings")
        ->select("buildings.*")
        ->orderBy('buildings.code',"DESC")
        ->join('building_types','buildings.building_type_id','building_types.id')
        ->join('addresses','buildings.address_id','addresses.id')
        ->where('buildings.building_type_id',$request->building_type)
        ->first();
        $btype=BuildingType::find($request->building_type);
        $pk="BLDG".strtoupper(substr($btype->building_name, 0, 3));
        if(!is_null($latest))
            $pk=$latest->code;
        $sc= new smartCounter();
        $pk=$sc->increment($pk);
        $address=new address();
        $address->number=$request->building_address;
        $address->street=$request->building_street;
        $address->district=$request->building_district;
        $address->city_id=$request->building_city;
        $address->save();
        try
        {
            $result=new building();
            $result->code=$pk;
            $result->description=$request->building_name;
            $result->building_type_id=$request->building_type;
            $result->num_of_floor=$request->building_num_of_floors;
            $result->address_id=$address->id;
            $result->save();
            return response()->json($result);
        }
        catch(\Exception $e) {
            if($e->errorInfo[1]==1062)
                return "This Data Already Exists";
            else if($e->errorInfo[1]==1452)
                return "Already Deleted";
            else
                return var_dump($e->errorInfo[1]);
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
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        return Response()->json($result);
    }
    public function floorEdit($id){
      $result = DB::table('floors')
      ->select('unit_prices.date_as_of','unit_prices.price','units.*','buildings.*','floors.*',DB::raw('COUNT(units.id) as current,AVG(unit_prices.price) as avg_price'))
      ->leftJoin('units','floors.id','=','units.floor_id')
      ->leftJoin("unit_prices","units.id","unit_prices.unit_id")
      ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=units.id)")
      ->join('buildings','floors.building_id','=','buildings.id')
      ->where('floors.id','=',$id)
      ->groupBy('floors.id')
      ->orderBy('floors.id')
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
      try
      {
        try
        {
          $result=building::find($id);
          $result->description=$request->building_name;
          $result->num_of_floor=$request->building_num_of_floors;
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
      $address->number=$request->building_address;
      $address->street=$request->building_street;
      $address->district=$request->building_district;
      $address->city_id=$request->building_city;
      $address->save();
      return response()->json($result);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = building::findorfail($id);
        try
            {
                $result->delete();
                return response()->json(['done']);
            }
            catch(\Exception $e) {
                if($e->errorInfo[1]==1451)
                    return Response::json(['true',$result->description]);
                else
                    return Response::json(['true',$result,$e->errorInfo[1]]);
            }
        return response()->json(['done']);
    }
}