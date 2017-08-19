<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\floor;
use App\unit;
use DB;
use Datatables;
use Response;
use Image;
use Config;
use Carbon\Carbon;
use App\UnitPrice;


class floorController extends Controller
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
    public function index()
    {
        //
      return view("maintenance.floor.index");
    }
    public function data()
    {
      $result=DB::table("floors")
      ->where("buildings.is_active",1)
      ->select("buildings.*","floors.*")
      ->join("buildings","floors.building_id","buildings.id")
      ->orderBy("floors.number")
      ->get();
      return Datatables::of($result)
      ->addColumn('action', function ($data) {
        return '<button id="btnAddUnit" type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-content-add"></i></button> <button id="btnEdit" type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button>
        <button id="btnPrice" type="button" class="btn bg-brown btn-circle waves-effect waves-circle waves-float" value= "'.$data->id.'"><i class="mdi-action-visibility"></i></button>
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

    public function getBuilding()
    {
      $query = DB::table('buildings')
      ->select('buildings.*')
      ->leftJoin('floors','buildings.id','=','floors.building_id')
      ->where('buildings.is_active','=',1)
      ->groupBy('buildings.id')
      ->havingRaw('buildings.num_of_floor > COUNT(floors.id)')
      ->get();
      return Response::json($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
      $floor=new floor();
      $floor->number=$request->txtFNum;
      $floor->building_id=$request->comBuilding;
      $floor->num_of_unit=$request->txtUNum;
      $floor->save();
    }

    public function storeUnit (Request $request)
    {
        //
     $uNum=$request->txtUUNum; 

     $result=DB::table("floors")
     ->where("floors.id",$request->comFloor)
     ->join("buildings","floors.building_id","buildings.id")
     ->select("buildings.description","floors.number")
     ->first();

     $pk=strtoupper(substr($result->description, 0, 3)).strtoupper($result->number)."UNIT".strtoupper($uNum) ;

     $image = $request->file('picture');
     $imagename = md5($pk).'.'.$image->getClientOriginalExtension();
     $location=public_path('images/units/'.$imagename);
     Image::make($image)->resize(400,400)->save($location);

     $unit=new unit();
     $unit->code=$pk;
     $unit->type=$request->comUnitType;
     $unit->size=$request->txtArea;
     $unit->number=$uNum;
     $unit->picture=$imagename;
     $unit->floor_id=$request->comFloor;
     $unit->save();

     $unit_price=new UnitPrice();
     $unit_price->unit_id=$unit->id;
     $unit_price->date_as_of=Carbon::now(Config::get('app.timezone')); 
     $unit_price->price=$request->txtPrice;
     $unit_price->save();

   }

   public function storePrice (Request $request)
   {
    $units=DB::table('floors')
    ->select('units.id')
    ->join('units','floors.id','units.floor_id')
    ->where('floors.is_active',1)
    ->where('units.is_active',1)
    ->where('floors.id',$request->floor_id)
    ->get();
    foreach ($units as $unit) {
      $unit_price=new UnitPrice();
      $unit_price->unit_id=$unit->id;
      $unit_price->date_as_of=Carbon::now(Config::get('app.timezone'));
      $unit_price->price=$request->txtPrice;
      $unit_price->save();
    }
    return response::json($request->floor_id);
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
        //
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
        //
      $result=floor::find($id);
      $result->num_of_unit=$request->txtUNum;
      $result->save();
      return Response::json("success update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function softdelete($id)
    {
      $result=floor::find($id);
      if($result->is_active==1)
        $val=0;
      else
        $val=1;
      $result->is_active=$val;
      $result->save();
    }

  }
