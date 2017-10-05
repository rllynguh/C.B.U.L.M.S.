<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use DB;
use Response;
use Datatables;

class pdcValidationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
          //
        $banks=bank::WHERE('is_active','=','1')
        ->SELECT('description','id')
        ->ORDERBY('description')
        ->PLUCK('description','id');
        return view('transaction.pdcValidation.index')
        ->withBanks($banks)
        ;
    }
    public function data()
    {
        $results=DB::TABLE('current_contracts')
        ->LEFTJOIN('post_dated_checks','current_contracts.id','post_dated_checks.current_contract_id')
        ->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
        ->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
        ->JOIN('tenants','registration_headers.tenant_id','tenants.id')
        ->SELECT('current_contracts.id','contract_headers.code','tenants.description','current_contracts.date_issued',DB::RAW('COUNT(distinctrow post_dated_checks.id) as pdc_count'))
        ->WHERE('current_contracts.status',1)
        ->WHERE('post_dated_checks.status','0')
        ->WHERE('post_dated_checks.is_accepted','0')
        ->GROUPBY('current_contracts.id')
        ->GET();
        return Datatables::of($results)
        ->ADDCOLUMN('action', function ($data) {
            return '<button id="btnPdc" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float" value= "'.route('pdcCollection.show',$data->id).'"><i class="mdi-action-visibility"></i></button>';
        })
        ->SETROWID(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->EDITCOLUMN('date_issued',function($data)
        {
            $time = strtotime($data->date_issued);
            return $myDate = date( 'M d,Y', $time );
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
