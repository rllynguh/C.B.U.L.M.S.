<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\utilitiesModel;
use DB;
use Response;

class utilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result=DB::table("tblUtilities")
        ->orderBy("dtmDateAsOf","desc")
        ->select("tblUtilities.*")
        ->first();
        return view("utilities.index")
        ->withResult($result)
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
     $util=new utilitiesModel();
     $util->dblCusa=$request->txtCUSA;
     $util->intSecurityDeposit=$request->txtSec;
     $util->dblVat=$request->txtVAT;
     $util->dblEwt=$request->txtEWT;
     $util->dblEscalation=$request->txtEsca;
     $util->dblVettingFee=$request->txtVet;
     $util->dtmDateAsOf=date("Y-m-d H:i:s");
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
