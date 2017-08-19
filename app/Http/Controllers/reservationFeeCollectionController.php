<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use Response;
use DB;

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
        ->groupby('registration_headers.id')
        ->havingRaw('count(distinctrow registration_details.id) =count(distinctrow case when offer_sheet_details.status = 1 then 1 else null end)')
        ->get();

        return Datatables::of($registration_headers)
        ->addColumn('action', function ($data) {
            return "<a href=".route('registrationApproval.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>";
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
