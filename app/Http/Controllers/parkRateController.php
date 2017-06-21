<?php

namespace App\Http\Controllers;
use App\ParkRate;
use Datatables;
use DB;
use Illuminate\Http\Request;
use Response;
use Carbon\Carbon;
use Config;

class parkRateController extends Controller
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
        $result=DB::table("buildings")
        ->leftJoin("park_rates","buildings.id","park_rates.building_id")
        ->groupBy("buildings.id")
        ->whereRaw("park_rates.date_as_of=(SELECT MAX(park_rates.date_as_of) from park_rates where building_id=buildings.id) or isnull(park_rates.date_as_of)")
        ->select("park_rates.*","buildings.*",DB::raw("COALESCE(park_rates.rate,0) as rate"))
        ->orderBy("buildings.description")
        ->get();
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return '<button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button>';
        })
        ->editColumn('rate', function ($data) {
          $rate = 'NOT SET';
          if($data->rate!="0"){
            $rate="PHP $data->rate/sqm/month


            ";
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
            return $data = 'id'.$data->building_id;
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
        $parkRate=new ParkRate();
        $parkRate->building_id=$request->myId;
        $parkRate->date_as_of=Carbon::now(Config::get('app.timezone'));
        $parkRate->rate=$request->txtRate;
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
       $result=DB::table("park_rates")
       ->select("park_rates.*",DB::raw("COALESCE(park_rates.rate,0) as rate"))
       ->where("park_rates.building_id",$id)
       ->orderBy("park_rates.date_as_of","desc")
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
