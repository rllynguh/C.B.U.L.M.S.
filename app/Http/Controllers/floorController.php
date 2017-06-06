<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\floorModel;
use App\buildingModel;
use App\unitModel;
use DB;
use Datatables;
use Response;


class floorController extends Controller
{
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
     $result=DB::table("tblFloor")
     ->where("tblFloor.boolIsDeleted",0)
     ->where("tblBuilding.boolIsDeleted",0)
     ->where("tblBuilding.boolIsActive",1)
     ->select("tblBuilding.*","tblFloor.*")
     ->join("tblBuilding","tblFloor.intBuilCode","tblBuilding.intBuilCode")
     ->orderBy("tblFloor.intFloorNum")
     ->get();
     return Datatables::of($result)
     ->addColumn('action', function ($data) {
        return '<button id="btnAddUnit" type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" value="'.$data->intFloorCode.'"><i class="mdi-content-add"></i></button> <button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->intFloorCode.'"><i class="mdi-editor-border-color"></i></button>';
    })
     ->editColumn('boolIsActive', function ($data) {
        $checked = '';
        if($data->boolIsActive==1){
          $checked = 'checked';
      }
      return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->intFloorCode.'"><span class="lever switch-col-blue"></span>On</label></div>';
  })
     ->setRowId(function ($data) {
        return $data = 'id'.$data->intFloorCode;
    })
     ->rawColumns(['boolIsActive','action'])
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
      $result=DB::table("tblFloor")
      ->join("tblBuilding","tblFloor.intBuilCode","tblBuilding.intBuilCode")
      ->orderBy("tblFloor.intFloorNum","desc")
      ->select(DB::raw("tblBuilding.intBuilNumOfFloor as max,COALESCE(MAX(intFloorNum) + 1,1) as current, count(*) as count"))
      ->where("tblBuilding.intBuilCode",$id)
      ->first();
      return Response::json($result);
  }

  public function getBuilding()
  {
      $query = DB::table('tblBuilding')
      ->select('tblBuilding.*')
      ->leftJoin('tblFloor','tblBuilding.intBuilCode','=','tblFloor.intBuilCode')
      ->where('tblBuilding.boolIsDeleted','=',0)
      ->where('tblBuilding.boolIsActive','=',1)
      ->groupBy('tblBuilding.intBuilCode')
      ->havingRaw('tblBuilding.intBuilNumOfFloor > COUNT(tblFloor.intFloorCOde)')
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
       $floor=new floorModel();
       $floor->intFloorNum=$request->txtFNum;
       $floor->intBuilCode=$request->comBuilding;
       $floor->intNumOfUnit=$request->txtUNum;
       $floor->save();
       return Response::json("success store");
   }

   public function storeUnit (Request $request)
   {
        //
    $uNum=$request->txtUUNum;        
    $result=DB::table("tblFloor")
    ->where("tblFloor.intFloorCode",$request->comFloor)
    ->join("tblBuilding","tblFloor.intBuilCode","tblBuilding.intBuilCode")
    ->select("tblBuilding.*","tblFloor.*")
    ->first();
    $pk=strtoupper(substr($result->strBuilDesc, 0, 3)).strtoupper($result->intFloorNum)."UNIT".strtoupper($uNum) ;
    $unit=new unitModel();
    $unit->strUnitCode=$pk;
    $unit->intUnitType=$request->comUnitType;
    $unit->dblUnitArea=$request->txtArea;
    $unit->intUnitNumber=$uNum;
    $unit->intFloorCode=$request->comFloor;
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
       $result = DB::table('tblfloor')
       ->select('tblunit.*','tblbuilding.*','tblfloor.*',DB::raw('COUNT(tblunit.intUnitCode) as current'))
       ->leftJoin('tblunit','tblfloor.intFloorCode','=','tblunit.intFloorCode')
       ->join('tblbuilding','tblfloor.intBuilCode','=','tblbuilding.intBuilCode')
       ->where('tblfloor.intFloorCode','=',$id)
       ->groupBy('tblfloor.intFloorCode')
       ->orderBy('tblfloor.intFloorCode')
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
        $result=floorModel::find($id);
        $result->intNumOfUnit=$request->txtUNum;
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
     $result=floorModel::find($id);
     if($result->boolIsActive==1)
        $val=0;
    else
        $val=1;
    $result->boolIsActive=$val;
    $result->save();
}

}
