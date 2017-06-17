<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\park_area;
use Response;
use Datatables;
use App\park_space;

class parkAreaController extends Controller
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
      return view("maintenance.parkArea.index");
  }
  public function data()
  {
    $result=DB::table("park_areas")
    ->join("floors","park_areas.floor_id","floors.id")
    ->join("buildings","floors.building_id","buildings.id")
    ->select("buildings.description as building_description","floors.number","park_areas.*")
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
public function getBuilding()
{
    $result=DB::table("buildings")
    ->select("buildings.*",DB::raw("count(`floors`.`id`), count(`park_areas`.`id`)"))
    ->leftjoin("floors","buildings.id","floors.building_id")
    ->leftjoin("park_areas","floors.id","park_areas.floor_id")
    ->where("buildings.is_active","=",1)
    ->where("floors.is_active","=",1)
    ->groupBy("buildings.id")
    ->havingRaw("count(`floors`.`id`) > count(`park_areas`.`id`)")
    ->get();
    return Response::json($result);
}
public function getFloor($id)
{
   $result=DB::table("floors")
   ->select("floors.*",DB::raw("count(`floors`.`id`), count(`park_areas`.`id`)"))
   ->join("buildings","floors.building_id","buildings.id")
   ->leftjoin("park_areas","floors.id","park_areas.floor_id")
   ->where("buildings.is_active","=",1)
   ->where("floors.is_active","=",1)
   ->where("buildings.id","=",$id)
   ->groupBy("floors.id")
   ->havingRaw("count(`floors`.`id`) > count(`park_areas`.`id`)")
   ->get();
   return Response::json($result);
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
       $parkArea=new park_area();
       $parkArea->description="PA$request->comFloor-$request->txtPNum";
       $parkArea->floor_id=$request->comFloor;
       $parkArea->num_of_space=$request->txtPNum;
       $parkArea->size=$request->txtArea;
       $parkArea->save();
       return Response::json("success store");
   }

   public function storeSpace(Request $request)
   {
        //
       $parkSpace=new park_space();
       $parkSpace->description=$request->txtPPNum;
       $parkSpace->park_area_id=$request->comParkArea;
       $parkSpace->number=$request->txtPPNum;
       $parkSpace->size=$request->txtPArea;;
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
        $result=DB::table("park_areas")
        ->join("floors","park_areas.floor_id","floors.id")
        ->join("buildings","floors.building_id","buildings.id")
        ->leftJoin('park_spaces','park_areas.id','=','park_spaces.park_area_id')
        ->where("park_areas.id",$id)
        ->select("buildings.description as building_description","floors.*","park_areas.*",DB::raw("COUNT(park_spaces.id) as current, COALESCE(SUM(park_spaces.size),0) as space_size"))
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
       $parkArea=park_area::find($id);
       $parkArea->num_of_space=$request->txtPNum;
       $parkArea->size=$request->txtArea;
       $parkArea->save();
       $result=DB::table("park_areas")
       ->join("floors","park_areas.floor_id","floors.id")
       ->join("buildings","floors.building_id","buildings.id")
       ->where("park_areas.floor_id",$parkArea->id)
       ->select("buildings.*","floors.*","park_areas.*")
       ->first();
       return Response::json($result);
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
       $parkArea=park_area::find($id);
       $val=1;
       if($parkArea->is_active)
          $val=0;
      $parkArea->is_active=$val;
      $parkArea->save();
      return Response::json("success");
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
