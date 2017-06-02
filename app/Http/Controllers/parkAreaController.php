<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\parkAreaModel;
use Response;
use Datatables;
use App\parkSpaceModel;

class parkAreaController extends Controller
{
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
       $result=DB::table("tblParkArea")
       ->join("tblFloor","tblParkArea.intFloorCode","tblFloor.intFloorCode")
       ->join("tblBuilding","tblFloor.intBuilCode","tblBuilding.intBuilCode")
       ->where("tblBuilding.boolIsDeleted","=",0)
       ->select("tblBuilding.*","tblFloor.*","tblParkArea.*")
       ->get();
       return Datatables::of($result)
       ->addColumn('action', function ($data) {
        return '<button id="btnAddParkSpace" type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" value="'.$data->intParkAreaCode.'"><i class="mdi-content-add"></i></button> <button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->intParkAreaCode.'"><i class="mdi-editor-border-color"></i></button>';
    })
       ->editColumn('boolIsActive', function ($data) {
          $checked = '';
          if($data->boolIsActive==1){
            $checked = 'checked';
        }
        return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->intParkAreaCode.'"><span class="lever switch-col-blue"></span>On</label></div>';
    })
       ->editColumn('dblParkAreaSize', function ($data) {

        return "$data->dblParkAreaSize sqm";
    })
       ->setRowId(function ($data) {
        return $data = 'id'.$data->intParkAreaCode;
    })
       ->rawColumns(['boolIsActive','action'])
       ->make(true);
   }
   public function getBuilding()
   {
       $result=DB::table("tblBuilding")
       ->select("tblBuilding.*",DB::raw("count(`tblFloor`.`intFloorCode`), count(`tblParkArea`.`intParkAreaCode`)"))
       ->leftjoin("tblFloor","tblBuilding.intBuilCode","tblFloor.intBuilCode")
       ->leftjoin("tblParkArea","tblFloor.intFloorCode","tblParkArea.intFloorCode")
       ->where("tblBuilding.boolIsActive","=",1)
       ->where("tblBuilding.boolIsDeleted","=",0)
       ->where("tblFloor.boolIsActive","=",1)
       ->groupBy("tblBuilding.intBuilCode")
       ->havingRaw("count(`tblFloor`.`intFloorCode`) > count(`tblParkArea`.`intParkAreaCode`)")
       ->get();
       return Response::json($result);
   }
   public function getFloor($id)
   {
     $result=DB::table("tblFloor")
     ->select("tblFloor.*",DB::raw("count(`tblFloor`.`intFloorCode`), count(`tblParkArea`.`intParkAreaCode`)"))
     ->join("tblBuilding","tblFloor.intBuilCode","tblBuilding.intBuilCode")
     ->leftjoin("tblParkArea","tblFloor.intFloorCode","tblParkArea.intFloorCode")
     ->where("tblBuilding.boolIsActive","=",1)
     ->where("tblBuilding.boolIsDeleted","=",0)
     ->where("tblFloor.boolIsActive","=",1)
     ->where("tblBuilding.intBuilCode","=",$id)
     ->groupBy("tblFloor.intFloorCode")
     ->havingRaw("count(`tblFloor`.`intFloorCode`) > count(`tblParkArea`.`intParkAreaCode`)")
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
       $parkArea=new parkAreaModel();
       $parkArea->strParkAreaDesc="PA$request->comFloor-$request->txtPNum";
       $parkArea->intFloorCode=$request->comFloor;
       $parkArea->intNumOfSpace=$request->txtPNum;
       $parkArea->dblParkAreaSize=$request->txtArea;
       $parkArea->save();
       return Response::json("success store");
   }

   public function storeSpace(Request $request)
   {
        //
       $parkSpace=new parkSpaceModel();
       $parkSpace->strParkSpaceDesc=$request->txtPPNum;
       $parkSpace->intParkAreaCode=$request->comParkArea;
       $parkSpace->intParkSpaceNumber=$request->txtPPNum;
       $parkSpace->dblParkSpaceSize=$request->txtPArea;;
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
     $result=DB::table("tblParkArea")
     ->join("tblFloor","tblParkArea.intFloorCode","tblFloor.intFloorCode")
     ->join("tblBuilding","tblFloor.intBuilCode","tblBuilding.intBuilCode")
     ->leftJoin('tblParkSpace','tblParkArea.intParkAreaCode','=','tblParkSpace.intParkAreaCode')
     ->where("tblParkArea.intParkAreaCode",$id)
     ->select("tblBuilding.*","tblFloor.*","tblParkArea.*",DB::raw("COUNT(tblParkSpace.intParkSpaceCode) as current, COALESCE(SUM(tblParkSpace.dblParkSpaceSize),0) as size"))
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
       $parkArea=parkAreaModel::find($id);
       $parkArea->intNumOfSpace=$request->txtPNum;
       $parkArea->dblParkAreaSize=$request->txtArea;
       $parkArea->save();
       $result=DB::table("tblParkArea")
       ->join("tblFloor","tblParkArea.intFloorCode","tblFloor.intFloorCode")
       ->join("tblBuilding","tblFloor.intBuilCode","tblBuilding.intBuilCode")
       ->where("tblBuilding.boolIsDeleted","=",0)
       ->where("tblParkArea.intFloorCode",$parkArea->intParkAreaCode)
       ->select("tblBuilding.*","tblFloor.*","tblParkArea.*")
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
       $parkArea=parkAreaModel::find($id);
       $val=1;
       if($parkArea->boolIsActive)
        $val=0;
    $parkArea->boolIsActive=$val;
    $parkArea->save();
    return Response::json("success");
}

public function getLatest($id)
{
    $query = DB::table('tblParkArea')
    ->leftJOIN('tblParkSpace','tblParkArea.intParkAreaCode','=','tblParkSpace.intParkAreaCode')
    ->WHERE('tblParkArea.intParkAreaCode','=',$id)
    ->select('tblParkArea.intParkAreaCode',DB::raw("tblParkArea.intNumOfSpace as ceiling,COALESCE(MAX(tblParkSpace.intParkSpaceNumber),0) + 1 as number, (COALESCE(tblParkArea.dblParkAreaSize,0) - COALESCE(SUM(tblParkSpace.dblParkSpaceSize),0)) as max"))
    ->first();
    return Response::json($query);
}
}
