<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParkSpace;
use Response;
use Datatables;
use DB;

class parkSpaceController extends Controller
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
        $result=DB::table("park_spaces")
        ->join("park_areas","park_spaces.park_area_id","park_areas.id")
        ->join("floors","park_areas.floor_id","floors.id")
        ->join("buildings","floors.building_id","buildings.id")
        ->select("buildings.description as building_description","floors.number as floor_number","park_areas.description as park_area_description","park_spaces.*")
        ->where("buildings.is_active",1)
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
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['is_active','action'])
        ->make(true);
    }

    public function index()
    {
        //
        return view("maintenance.parkSpace.index");
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
        //
        $parkSpace=new ParkSpace();
        $parkSpace->description="PS".$request->txtPNum;
        $parkSpace->park_area_id=$request->comParkArea;
        $parkSpace->number=$request->txtPNum;
        $parkSpace->size=$request->txtArea;;
        $parkSpace->save();
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
     $result=DB::table("park_spaces")
     ->join("park_areas","park_spaces.park_area_id","park_areas.id")
     ->join("floors","park_areas.floor_id","floors.id")
     ->join("buildings","floors.building_id","buildings.id")
     ->select("buildings.description as building_description","floors.number as floor_number","park_areas.description as park_area_description","floors.building_id","park_spaces.*")
     ->where("park_spaces.id",$id)
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
        $parkSpace=ParkSpace::find($id);
        $parkSpace->size=$request->txtArea;
        $parkSpace->save();
        return Response::json("success update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function softDelete($id)
    {
        $parkSpace=ParkSpace::find($id);
        $val=1;
        if($parkSpace->is_active)
            $val=0;
        $parkSpace->is_active=$val;
        $parkSpace->save();
        return Response::json("success");
    }

    public function destroy($id)
    {
        //
    }
    public function getBuilding()
    {
        $result=DB::table("buildings")
        ->select("park_areas.num_of_space","buildings.*",DB::raw("COUNT(park_spaces.id), (park_areas.size - COALESCE(SUM(park_spaces.size),0)) as max"))
        ->where("buildings.is_active","=",1)
        ->where("park_areas.is_active","=",1)
        ->leftJoin("floors","buildings.id","floors.building_id")
        ->leftJoin("park_areas","floors.id","park_areas.floor_id")
        ->leftJoin("park_spaces","park_areas.id","park_spaces.park_area_id")
        ->groupBy("buildings.id")
        ->havingRaw("park_areas.num_of_space > COUNT(park_spaces.id)")
        ->get();
        return Response::json($result);
    }
    public function getParkArea($id)
    {
        $result=db::table("park_areas")
        ->select("floors.number","park_areas.num_of_space","park_areas.*",DB::raw("COUNT(park_spaces.id)"))
        ->where("buildings.is_active","=",1)
        ->where("park_areas.is_active","=",1)
        ->where("buildings.id","=",$id)
        ->join("floors","park_areas.floor_id","floors.id")
        ->join("buildings","floors.building_id","buildings.id")
        ->leftJoin("park_spaces","park_areas.id","park_spaces.park_area_id")
        ->groupBy("floors.id")
        ->havingRaw("park_areas.num_of_space > COUNT(park_spaces.id)")
        ->get();
        return Response::json($result);
    }
    public function getLatest($id)
    {
        $query = DB::table('park_areas')
        ->leftJOIN('park_spaces','park_areas.id','=','park_spaces.park_area_id')
        ->WHERE('park_areas.id','=',$id)
        ->select('park_areas.id',DB::raw("park_areas.num_of_space as ceiling,COALESCE(MAX(park_spaces.number),0) + 1 as number, (COALESCE(park_areas.size,0) - COALESCE(SUM(park_spaces.size),0)) as max"))
        ->first();
        return Response::json($query);
    }
}
