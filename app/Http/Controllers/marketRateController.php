<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use App\marketRateModel;
use Datatables;


class marketRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("maintenance.marketRate.index");
    }
    public function data()
    {
        $result=DB::table("tblCity")
        ->leftJoin("tblMarketRate","tblCity.intCityCode","tblMarketRate.intCityCode")
        ->groupBy("tblCity.intCityCode")
        ->whereRaw("tblMarketRate.dtmDateAsOf=(SELECT MAX(dtmDateAsOf) from tblMarketRate where intCityCode=tblCity.intCityCode) or isnull(tblMarketRate.dtmDateAsOf)")
        ->select("tblMarketRate.*","tblCity.*",DB::raw("COALESCE(tblMarketRate.dblRate,0) as rate"))
        ->orderBy("tblCity.strCityDesc")
        ->get();   
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
          return '<button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->intCityCode.'"><i class="mdi-editor-border-color"></i></button>';
      })
        ->editColumn('rate', function ($data) {
          $rate = 'NOT SET';
          if($data->rate!="0"){
            $rate="PHP $data->rate/sqm/month";
        }
        return $rate;
    })
        ->editColumn('dtmDateAsOf', function ($data) {
          $date = 'N/A';
          if($data->rate!="0"){
            $time = strtotime($data->dtmDateAsOf);
            $myDate = date( 'm-d-y', $time );
            $date=$myDate;
        }
        return $date;
    })
        ->setRowId(function ($data) {
          return $data = 'id'.$data->intCityCode;
      })
        ->rawColumns(['action'])
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
     $marketRate=new marketRateModel();
     $marketRate->intCityCode=$request->myId;
     $marketRate->dtmDateAsOf=date("Y-m-d H:i:s");
     $marketRate->dblRate=$request->txtRate;
     $marketRate->save();
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
        $result=DB::table("tblMarketRate")
        ->select("tblMarketRate.*",DB::raw("COALESCE(tblMarketRate.dblRate,0) as rate"))
        ->where("tblMarketRate.intCityCode",$id)
        ->orderBy("tblMarketRate.dtmDateAsOf","desc")
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
