<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use Response;
use DB;
use App\RegistrationDetail;

class reservationFeeCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('transaction.reservationFeeCollection.index');
    }

    public function data()
    {
        //
        $registration_headers=DB::table('registration_headers')
        ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
        ->join('tenants','registration_headers.tenant_id','tenants.id')
        ->join('business_types','tenants.business_type_id','business_types.id')
        ->leftjoin('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
        ->select(DB::raw('registration_headers.id,registration_headers.code as regi_code,tenants.description as tenant_description,business_types.description as business_type_description,count(registration_details.id) as regi_count'))
        ->where('registration_headers.is_forfeited','0')
        ->where('registration_headers.status','1')
        ->where('registration_details.is_reserved',0)
        ->groupby('registration_headers.id')
        ->havingRaw('count(distinctrow registration_details.id) =count(distinctrow case when offer_sheet_details.status = 1 then 1 else null end)')
        ->get();

        return Datatables::of($registration_headers)
        ->addColumn('action', function ($data) {
            return "<button id='btnReserve' type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float' value='$data->id'><i class='mdi-content-add'></i></button>";
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
        $regi_details=DB::table('registration_details')
        ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
        ->select('registration_details.id')
        ->where('registration_headers.id',$request->myId)
        ->get();
        foreach ($regi_details as $regi_detail)
        {
            $regi_detail_update=RegistrationDetail::find($regi_detail->id);
            $regi_detail_update->is_reserved=1;
            $regi_detail_update->save();
        }
        return response::json('yas');

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
