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
        ->select(DB::raw('registration_headers.id,registration_headers.code as regi_code,tenants.description as tenant_description,business_types.description as business_type_description,count(distinctrow registration_details.id) as regi_count,count(case when offer_sheet_details.status = 1 then 1 else null end)'))
        ->where('registration_headers.is_forfeited','0')
        ->where('registration_headers.status','1')
        ->where('registration_details.is_reserved',0)
        ->where('registration_details.is_forfeited',0)
        ->where('registration_details.is_rejected',0)
        ->groupby('registration_headers.id')
        ->havingRaw('count(distinctrow registration_details.id) =count(case when offer_sheet_details.status = 1 then 1 else null end)')
        ->whereRaw('registration_headers.id not in (Select registration_header_id from contract_headers)') //not yet signing a contract
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
        db::begintransaction();
        try
        {
            $regi_details=DB::table('registration_details')
            ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
            ->select('registration_details.id')
            ->where('registration_headers.id',$request->myId)
            ->get();
            foreach ($regi_details as $regi_detail)
            {
                $regi_detail_update=RegistrationDetail::find($regi_detail->id);
                if(($regi_detail_update->is_rejected==0) && ($regi_detail_update->is_forfeited==0))
                 { $regi_detail_update->is_reserved=1;
                     $regi_detail_update->save();
                 }
             }
             db::commit();
             return response::json('yas');
         }
         catch(\Exception $e)
         {
            db::rollback();
            dd($e);
        }

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
        $utilities=DB::table('utilities')
        ->whereRaw('date_as_of=(Select Max(date_as_of) from utilities)')
        ->select('utilities.*')
        ->first();

        $reservation=DB::table('utilities')
        ->select('reservation_fee as fee')
        ->whereRaw("date_as_of=(SELECT MAX(date_as_of) from utilities) or isnull(date_as_of)")
        ->first();
        $regi_detail=DB::table('registration_details')
        ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
        ->join('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
        ->join('offer_sheet_headers','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id')
        ->join('units','offer_sheet_details.unit_id','units.id')
        ->leftJoin("unit_prices","units.id","unit_prices.unit_id")
        ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=units.id)")
        ->select(DB::raw("SUM(price * size) as fee,$reservation->fee as month"))
        ->where('registration_headers.id',$id)
        ->where('offer_sheet_headers.status',1)
        ->where('offer_sheet_details.status',1)
        ->where('registration_details.is_rejected',0)
        ->where('registration_details.is_forfeited',0)
        ->where('registration_headers.status',1)
        ->where('registration_headers.is_forfeited',0)
        ->where('registration_headers.id',$id)
        ->first();

        $units=DB::table('registration_details')
        ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
        ->join('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
        ->join('offer_sheet_headers','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id')
        ->join('units','offer_sheet_details.unit_id','units.id')
        ->leftJoin("unit_prices","units.id","unit_prices.unit_id")
        ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=units.id)")
        ->select('units.code','price','size')
        ->where('registration_headers.id',$id)
        ->where('offer_sheet_headers.status',1)
        ->where('offer_sheet_details.status',1)
        ->where('registration_details.is_rejected',0)
        ->where('registration_details.is_forfeited',0)
        ->where('registration_headers.status',1)
        ->where('registration_headers.is_forfeited',0)
        ->where('registration_headers.id',$id)
        ->get();

        $total=$regi_detail->fee;
        $vat=$total*($utilities->vat_rate/100);
        $subtotal=$vat+$total;
        $ewt=$total*($utilities->ewt_rate/100);
        $final=($subtotal-$ewt)*$reservation->fee;
        $final=number_format( $final,2 );
        return response::json([$final,$units,$regi_detail]);
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
