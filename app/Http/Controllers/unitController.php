<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\unitModel;
use Response;
use DB;
use Datatables;

class unitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
     $result=DB::table("tblUnit")
     ->select(['tblBuilding.strBuilDesc','tblFloor.intFloorNum','tblUnit.strUnitCode','tblUnit.intUnitType','tblUnit.intUnitNumber','tblUnit.dblUnitArea','tblUnit.boolIsActive','tblUnit.intUnitCode'])
     ->join("tblFloor","tblUnit.intFloorCode","tblFloor.intFloorCode")
     ->join("tblBuilding","tblFloor.intBuilCode","tblBuilding.intBuilCode")
     ->join("tblBuildingType","tblBuilding.intBuilTypeCode","tblBuildingType.intBuilTypeCode")
     ->where("tblBuilding.boolIsDeleted",0)
     ->where("tblBuilding.boolIsActive",1)
     ->where("tblUnit.boolIsDeleted",0)
     ->get();
     return Datatables::of($result)
     ->addColumn('action', function ($data) {
        return '<button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->intUnitCode.'"><i class="mdi-editor-border-color"></i></button>';
    })
     ->editColumn('boolIsActive', function ($data) {
      $checked = '';
      if($data->boolIsActive==1){
        $checked = 'checked';
    }
    return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->intUnitCode.'"><span class="lever switch-col-blue"></span>On</label></div>';
})
     ->editColumn('dblUnitArea', function ($data) {

      return "$data->dblUnitArea sqm";
  })
     ->editColumn('intUnitType', function ($data) {
        $value = 'raw';
        if($data->intUnitType==1){
            $value = 'shell';
        }
        return $value;
    })
     ->setRowId(function ($data) {
        return $data = 'id'.$data->intUnitCode;
    })
     ->rawColumns(['boolIsActive','action'])
     ->make(true);
 }
 public function index()
 {
        //
    return view("maintenance.unit.index");
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
       $uNum=$request->txtUNum;    
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
     $result=DB::table("tblUnit")
     ->select("tblFloor.*","tblBuilding.*","tblUnit.*")
     ->join("tblFloor","tblUnit.intFloorCode","tblFloor.intFloorCode")
     ->join("tblBuilding","tblFloor.intBuilCode","tblBuilding.intBuilCode")
     ->where("tblUnit.intUnitCode",$id)
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
      $unit=unitModel::find($id);
      $unit->intUnitType=$request->comUnitType;
      $unit->dblUnitArea=$request->txtArea;
      $unit->intUnitNumber=$request->txtUNum;
      $unit->save();
      return Response::json("succes update");
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
       try
       {
        $result = unitModel::findorfail($id);
        try
        {
          $result->delete();
          return Response::json($result);
      }
      catch(\Exception $e) {
          if($e->errorInfo[1]==1451)
            return Response::json(['true',$result]);
        else
            return Response::json(['true',$result,$e->errorInfo[1]]);
    }
} 
catch(\Exception $e) {
    return "Deleted";
}
}
public function softdelete($id)
{
 $result=unitModel::find($id);
 if(!$result->boolIsActive)
    $val=1;
else
    $val=0;
$result->boolIsActive=$val;
$result->save();
return Response::json("success");
}

public function getFloor($id)
{
    $query = DB::table('tblFloor')
    ->select('tblFloor.*')
    ->leftJoin('tblUnit','tblFloor.intFloorCode','=','tblUnit.intFloorCode')
    ->join('tblBuilding','tblFloor.intBuilCode','=','tblBuilding.intBuilCode')
    ->where('tblFloor.boolIsActive','=',1)
    ->where('tblBuilding.boolIsDeleted','=',0)
    ->where('tblBuilding.boolIsActive','=',1)
    ->where('tblBuilding.intBuilCode','=',$id)
    ->groupBy('tblFloor.intFloorCode')
    ->havingRaw('tblFloor.intNumOfUnit > COUNT(tblUnit.intFloorCOde)')
    ->get();
    return Response::json($query);
}

public function getLatest($id)
{
    $query = DB::table('tblFloor')
    ->JOIN('tblUnit','tblFloor.intFloorCode','=','tblUnit.intFloorCode')
    ->WHERE('tblFloor.intFloorCode','=',$id)
    ->select(DB::raw("tblFloor.intNumOfUnit as max,COALESCE(MAX(tblUnit.intUnitNumber) + 1,1) as number"))
    ->first();
    return Response::json($query);
}
}
