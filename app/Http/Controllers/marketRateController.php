<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use App\MarketRate;
use Datatables;
use Carbon\Carbon;
use Config;


class marketRateController extends Controller
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
        return view("maintenance.marketRate.index");
    }
    public function data()
    {
        $result=DB::table("cities")
        ->leftJoin("market_rates","cities.id","market_rates.city_id")
        ->groupBy("cities.id")
        ->whereRaw("market_rates.date_as_of=(SELECT MAX(date_as_of) from market_rates where city_id=cities.id) or isnull(market_rates.date_as_of)")
        ->select("market_rates.*","cities.*",DB::raw("COALESCE(market_rates.rate,0) as rate"))
        ->orderBy("cities.description")
        ->get();   
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return '<button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button>';
        })
        ->editColumn('rate', function ($data) {
          $rate = 'NOT SET';
          if($data->rate!="0"){
            $rate="PHP $data->rate/sqm/month";
        }
        return $rate;
    })
        ->editColumn('date_as_of', function ($data) {
          $date = 'N/A';
          if($data->rate!="0"){
            $time = strtotime($data->date_as_of);
            $myDate = date( 'm-d-y', $time );
            $date=$myDate;
        }
        return $date;
    })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
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
        $marketRate=new MarketRate();
        $marketRate->city_id=$request->myId;
        $marketRate->date_as_of=Carbon::now(Config::get('app.timezone'));
        $marketRate->rate=$request->txtRate;
        $marketRate->save();
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
        $result=DB::table("market_rates")
        ->select("market_rates.*",DB::raw("COALESCE(market_rates.rate,0) as rate"))
        ->where("market_rates.city_id",$id)
        ->orderBy("market_rates.date_as_of","desc")
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
