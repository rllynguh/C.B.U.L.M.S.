<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Datatables;

class registrationForfeitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('transaction.registrationForfeit.index');
    }
    public function data()
    {
        $result=DB::table('registration_headers')
        ->select(DB::raw(
            'registration_headers.id,'.
            'registration_headers.code,'. 
            'count(registration_details.id) as regi_count,'.
            'registration_headers.date_issued,'.
            'registration_headers.tenant_remarks,'.
            'registration_headers.duration_preferred'
            ))
        ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
        ->join('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
        ->join('offer_sheet_headers','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id')
        ->where('offer_sheet_headers.status','0')
        ->where('registration_headers.status','!=',2)
        ->groupBy('registration_headers.id')
        ->get();
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return "<a href=".route('registrationForfeit.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>";
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        }) 
        ->rawColumns(['action'])
        ->make(true)
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
