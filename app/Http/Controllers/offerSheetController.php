<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;
use Datatables;

class offerSheetController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $result=DB::table('registration_headers')
        ->select(
            'registration_headers.id',
            'tenants.description as tenant_description',
            'business_types.description as business_type_description',
            // 'count(registration_details.id) as bilang'
            )
        ->join('tenants','registration_headers.tenant_id','tenants.id')
        ->join('business_types','tenants.business_type_id','business_types.id')
        ->join('users','tenants.user_id','users.id')
        ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
        ->whereRaw('registration_details.id not in (SELECT offer_sheet_details.registration_detail_id from offer_sheet_details)')
        ->groupBy('registration_headers.id')
        ->get();
        return Datatables::of($result)
        ->setRowId(function ($data) {
          return $data = 'id'.$data->id;
      }) ->make(true);
        ;
    }
    public function index()
    {
        //
        return view('transaction.offerSheet.index');
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
