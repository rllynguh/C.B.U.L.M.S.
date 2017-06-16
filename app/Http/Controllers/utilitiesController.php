<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\utility;
use DB;
use Response;

class utilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        //
        $result=DB::table("utilities")
        ->orderBy("date_as_of","desc")
        ->select("utilities.*")
        ->first();
        return Response::json($result);
    }
    public function index()
    {
        //
        return view("utilities.index")
        ;
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
        $util=new utility();
        $util->cusa_rate=$request->txtCUSA;
        $util->security_deposit_rate=$request->txtSec;
        $util->vat_rate=$request->txtVAT;
        $util->ewt_rate=$request->txtEWT;
        $util->escalation_rate=$request->txtEsca;
        $util->vetting_fee=$request->txtVet;
        $util->date_as_of=date("Y-m-d H:i:s");
        $util->save();
        return Response::json($util);
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
