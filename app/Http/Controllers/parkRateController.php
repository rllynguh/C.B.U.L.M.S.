<?php

namespace App\Http\Controllers;
use App\parkRateModel;
use Datatables;
use DB;
use Illuminate\Http\Request;
use Response;

class parkRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $result=DB::table("tblBuilding")
        ->leftJoin("tblParkRate","tblBuilding.intBuilCode","tblParkRate.intBuilCode")
        ->groupBy("tblBuilding.intBuilCode")
        ->whereRaw("tblParkRate.dtmParkRateDate=(SELECT MAX(tblParkRate.dtmParkRateDate) from tblParkRate where intBuilCode=tblBuilding.intBuilCode) or isnull(tblParkRate.dtmParkRateDate)")
        ->select("tblParkRate.*","tblBuilding.*",DB::raw("COALESCE(tblParkRate.dblParkRate,0) as rate"))
        ->orderBy("tblBuilding.strBuilDesc")
        ->get();
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return '<button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->intBuilCode.'"><i class="mdi-editor-border-color"></i></button>';
        })
        ->editColumn('rate', function ($data) {
          $rate = 'NOT SET';
          if($data->rate!="0"){
            $rate="PHP $data->rate/sqm/month";
        }
        return $rate;
    })
        ->editColumn('dtmParkRateDate', function ($data) {
            $date = 'N/A';
            if($data->rate!="0"){
                $time = strtotime($data->dtmParkRateDate);
                $myDate = date( 'm-d-y', $time );
                $date=$myDate;
            }
            return $date;
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->intBuilCode;
        })
        ->rawColumns(['action'])
        ->make(true);

    }
    public function index()
    {
        //
        return view("maintenance.parkRate.index");
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
        $parkRate=new parkRateModel();
        $parkRate->intBuilCode=$request->myId;
        $parkRate->dtmParkRateDate=date("Y-m-d H:i:s");
        $parkRate->dblParkRate=$request->txtRate;
        $parkRate->save();
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
     $result=DB::table("tblParkRate")
     ->select("tblParkRate.*",DB::raw("COALESCE(tblParkRate.dblParkRate,0) as rate"))
     ->where("tblParkRate.intBuilCode",$id)
     ->orderBy("tblParkRate.dtmParkRateDate","desc")
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
}
