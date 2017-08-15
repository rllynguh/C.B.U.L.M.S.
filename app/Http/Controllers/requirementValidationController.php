<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Datatables;

class requirementValidationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('transaction.requirementValidation.index');
    }


    public function data()
    {
        $result=DB::table('registration_headers')
        ->select(DB::Raw('registration_headers.id,registration_headers.code,tenants.description as tenant,business_types.description as business,count(registration_requirements.is_fulfilled) as req_total,count(case when registration_requirements.is_fulfilled = 1 then 1 else null end) as fulfilled'))
        ->join('registration_requirements','registration_headers.id','registration_requirements.registration_header_id')
        ->join('tenants','registration_headers.tenant_id','tenants.id')
        ->join('business_types','tenants.business_type_id','business_types.id')
        ->leftjoin('registration_details','registration_headers.id','registration_details.registration_header_id')
        ->leftjoin('offer_sheet_details',
            'registration_details.id',
            'offer_sheet_details.registration_detail_id')
        ->where('registration_details.is_forfeited','0')
        ->where('registration_details.is_rejected','0')
        ->groupby('registration_headers.id')
        ->havingRaw('count(registration_details.id) =count(case when offer_sheet_details.status = 1 then 1 else null end)')
        ->get()
        ;   
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return '<button id="btnAddRequirement" type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-content-add"></i></button>
            <button id="btnEditRequirement" type="button" class="btn bg-brown btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button>';
        })
        ->addColumn('progress', function ($data) {
            $percentage=($data->fulfilled/$data->req_total)*100;
            return "  <div class='progress'>
            <div class='progress-bar progress-bar-warning progress-bar-striped active' role='progressbar' aria-valuenow='$data->fulfilled' aria-valuemin='0' aria-valuemax='100' style='width: $percentage%;'>
               $data->fulfilled / $data->req_total
           </div>
       </div>";
   })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        }) 
        ->rawColumns(['action','progress'])
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
