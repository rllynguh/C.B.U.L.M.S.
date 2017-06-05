<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\parkSpaceModel;
use Response;
use Datatables;
use DB;

class parkSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data()
    {
        $result=DB::table("tblParkSpace")
        ->join("tblParkArea","tblParkSpace.intParkAreaCode","tblParkArea.intParkAreaCode")
        ->join("tblFloor","tblParkArea.intFloorCode","tblFloor.intFloorCode")
        ->join("tblBuilding","tblFloor.intBuilCode","tblBuilding.intBuilCode")
        ->select("tblBuilding.*","tblFloor.*","tblParkArea.*","tblParkSpace.*")
        ->where("tblBuilding.boolIsDeleted",0)
        ->where("tblBuilding.boolIsActive",1)
        ->get();
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return '<button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->intParkSpaceCode.'"><i class="mdi-editor-border-color"></i></button>';
        })
        ->editColumn('boolIsActive', function ($data) {
          $checked = '';
          if($data->boolIsActive==1){
            $checked = 'checked';
        }
        return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->intParkSpaceCode.'"><span class="lever switch-col-blue"></span>On</label></div>';
    })
        ->editColumn('dblParkSpaceSize', function ($data) {

            return "$data->dblParkSpaceSize sqm";
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->intParkSpaceCode;
        })
        ->rawColumns(['boolIsActive','action'])
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
     $parkSpace=new parkSpaceModel();
     $parkSpace->strParkSpaceDesc=$request->txtPNum;
     $parkSpace->intParkAreaCode=$request->comParkArea;
     $parkSpace->intParkSpaceNumber=$request->txtPNum;
     $parkSpace->dblParkSpaceSize=$request->txtArea;;
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
     $result=DB::table("tblParkSpace")
     ->join("tblParkArea","tblParkSpace.intParkAreaCode","tblParkArea.intParkAreaCode")
     ->join("tblFloor","tblParkArea.intFloorCode","tblFloor.intFloorCode")
     ->join("tblBuilding","tblFloor.intBuilCode","tblBuilding.intBuilCode")
     ->select("tblBuilding.*","tblFloor.*","tblParkArea.*","tblParkSpace.*")
     ->where("tblBuilding.boolIsDeleted",0)
     ->where("tblParkSpace.intParkSpaceCode",$id)
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
        $parkSpace=parkSpaceModel::find($id);
        $parkSpace->dblParkSpaceSize=$request->txtArea;
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
        $parkSpace=parkSpaceModel::find($id);
        $val=1;
        if($parkSpace->boolIsActive)
            $val=0;
        $parkSpace->boolIsActive=$val;
        $parkSpace->save();
        return Response::json("success");
    }

    public function destroy($id)
    {
        //
    }
    public function getBuilding()
    {
        $result=DB::table("tblBuilding")
        ->select("tblParkArea.intNumOfSpace","tblBuilding.*",DB::raw("COUNT(tblParkSpace.intParkSpaceCode), (tblParkArea.dblParkAreaSize - COALESCE(SUM(tblParkSpace.dblParkSpaceSize),0)) as max"))
        ->where("tblBuilding.boolIsActive","=",1)
        ->where("tblBuilding.boolIsDeleted","=",0)
        ->where("tblParkArea.boolIsActive","=",1)
        ->leftJoin("tblFloor","tblBuilding.intBuilCode","tblFLoor.intBuilCode")
        ->leftJoin("tblParkArea","tblFloor.intFloorCode","tblParkArea.intFloorCode")
        ->leftJoin("tblParkSpace","tblParkArea.intParkAreaCode","tblParkSpace.intParkAreaCode")
        ->groupBy("tblBuilding.intBuilCode")
        ->havingRaw("tblParkArea.intNumOfSpace > COUNT(tblParkSpace.intParkSpaceCode)")
        ->get();
        return Response::json($result);
    }
    public function getParkArea($id)
    {
        $result=db::table("tblParkArea")
        ->select("tblFloor.*","tblParkArea.intNumOfSpace","tblParkArea.*",DB::raw("COUNT(tblParkSpace.intParkSpaceCode)"))
        ->where("tblBuilding.boolIsActive","=",1)
        ->where("tblBuilding.boolIsDeleted","=",0)
        ->where("tblParkArea.boolIsActive","=",1)
        ->where("tblBuilding.intBuilCode","=",$id)
        ->join("tblFloor","tblParkArea.intFloorCode","tblFloor.intFloorCode")
        ->join("tblBuilding","tblFloor.intBuilCode","tblBuilding.intBuilCode")
        ->leftJoin("tblParkSpace","tblParkArea.intParkAreaCode","tblParkSpace.intParkAreaCode")
        ->groupBy("tblFloor.intFloorCode")
        ->havingRaw("tblParkArea.intNumOfSpace > COUNT(tblParkSpace.intParkSpaceCode)")
        ->get();
        return Response::json($result);
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
