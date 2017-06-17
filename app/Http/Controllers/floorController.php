<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\floor;
use App\unit;
use DB;
use Datatables;
use Response;


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
        return '<button id="btnAddUnit" type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-content-add"></i></button> <button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button>';
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
      return Response::json("success store");
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
      $unit=new unit();
      $unit->code=$pk;
      $unit->type=$request->comUnitType;
      $unit->size=$request->txtArea;
      $unit->number=$uNum;
      $unit->floor_id=$request->comFloor;
      $unit->save();
      return Response::json("success store");
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
      ->select('units.*','buildings.*','floors.*',DB::raw('COUNT(units.id) as current'))
      ->leftJoin('units','floors.id','=','units.floor_id')
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
