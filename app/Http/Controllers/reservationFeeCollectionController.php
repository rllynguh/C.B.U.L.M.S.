<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use Response;
use DB;
use App\RegistrationDetail;
use PDF;
use Auth;
use App\RegistrationHeader;

class reservationFeeCollectionController extends Controller
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


             //get values of utilities
               $utilities=DB::table('utilities')
               ->whereRaw('date_as_of=(Select Max(date_as_of) from utilities)')
               ->select('utilities.*')
               ->first(); 

             //get value or reservation
               $reservation=DB::table('utilities')
               ->select('reservation_fee as fee')
               ->whereRaw("date_as_of=(SELECT MAX(date_as_of) from utilities) or isnull(date_as_of)")
               ->first(); 

             //get value of total rate of units
               $summary=DB::table('registration_details')
               ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
               ->join('tenants','registration_headers.tenant_id','tenants.id')
               ->join('users','tenants.user_id','users.id')
               ->join('addresses','tenants.address_id','addresses.id')
               ->join('cities','addresses.city_id','cities.id')
               ->join('provinces','cities.province_id','provinces.id')
               ->join('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
               ->join('offer_sheet_headers','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id')
               ->join('units','offer_sheet_details.unit_id','units.id')
               ->leftJoin("unit_prices","units.id","unit_prices.unit_id")
               ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=units.id)")
               ->select(DB::raw("SUM(price * size) as fee,$reservation->fee as month,last_name, first_name,Concat(addresses.number,' ',addresses.street,' ',addresses.district) as address,CONCAT(cities.description, ', ', provinces.description) as city_province"))
               ->where('registration_headers.id',$request->myId)
               ->where('offer_sheet_headers.status',1)
               ->where('offer_sheet_details.status',1)
               ->where('registration_details.is_rejected',0)
               ->where('registration_details.is_forfeited',0)
               ->where('registration_headers.status',1)
               ->where('registration_headers.is_forfeited',0)
               ->first();

             //get units
               $units=DB::table('registration_details')
               ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
               ->join('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
               ->join('offer_sheet_headers','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id')
               ->join('units','offer_sheet_details.unit_id','units.id')
               ->leftJoin("unit_prices","units.id","unit_prices.unit_id")
               ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=units.id)")
               ->select(DB::raw('units.code,(price * size) as price,size'))
               ->where('registration_headers.id',$request->myId)
               ->where('offer_sheet_headers.status',1)
               ->where('offer_sheet_details.status',1)
               ->where('registration_details.is_rejected',0)
               ->where('registration_details.is_forfeited',0)
               ->where('registration_headers.status',1)
               ->where('registration_headers.is_forfeited',0)
               ->get();
               foreach ($units as &$unit) {
                $unit->price="P ".number_format($unit->price,2);
                $unit->size=number_format($unit->size,2)." sqm";
            }
            //get total value
            $total=$summary->fee;
            //get value of vat
            $vat=$total*($utilities->vat_rate/100);
            //subtotal
            $subtotal=$vat+$total;
            //get value of ewt
            $ewt=$total*($utilities->ewt_rate/100);
            //get value of net rent
            $net_rent=($subtotal-$ewt);
            //get value of final
            $final=$net_rent*$reservation->fee;
            $final="P ".number_format( $final,2 );
            $net_rent="P ".number_format( $net_rent,2 );
            $subtotal="P ".number_format($subtotal,2);
            $vat="P ".number_format($vat,2);
            $ewt="P ".number_format($ewt,2);
            $total="P ".number_format($total,2);
            $summary->fee="P ".number_format($summary->fee,2);
            $utilities->vat_rate.=" %";
            $utilities->ewt_rate.=" %";

            //summary to be passed on pdf
            $summary->net_rent=$net_rent;
            $summary->vat=$vat;
            $summary->subtotal=$subtotal;
            $summary->ewt=$ewt;
            $summary->final = $final;
            $summary->base_rent=$total;
            $summary->admin=Auth::user()->first_name." ".Auth::user()->last_name;
            ;
            $regi_header=RegistrationHeader::find($request->myId);
            $pdf=PDF::loadView('transaction.reservationFeeCollection.pdf',compact('units', 'summary'));
            $pdfName="$regi_header->code(ReservationFeeCollection).pdf";
            $location=public_path("docs/$pdfName");
            $pdf->save($location);
            $regi_header->pdf=$pdfName;
            $regi_header->save();
            db::commit();
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
        ->select(DB::raw('SUM(price * size) as fee,'.$reservation->fee.' as month'))
        ->where('registration_headers.id',$id)
        ->where('offer_sheet_headers.status',1)
        ->where('offer_sheet_details.status',1)
        ->where('registration_details.is_rejected',0)
        ->where('registration_details.is_forfeited',0)
        ->where('registration_headers.status',1)
        ->where('registration_headers.is_forfeited',0)
        ->first();

        $units=DB::table('registration_details')
        ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
        ->join('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
        ->join('offer_sheet_headers','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id')
        ->join('units','offer_sheet_details.unit_id','units.id')
        ->leftJoin("unit_prices","units.id","unit_prices.unit_id")
        ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=units.id)")
        ->select(DB::raw('units.code,(price * size) as price,size'))
        ->where('registration_headers.id',$id)
        ->where('offer_sheet_headers.status',1)
        ->where('offer_sheet_details.status',1)
        ->where('registration_details.is_rejected',0)
        ->where('registration_details.is_forfeited',0)
        ->where('registration_headers.status',1)
        ->where('registration_headers.is_forfeited',0)
        ->where('registration_headers.id',$id)
        ->get();
        foreach ($units as &$unit) {
            # code...
            $unit->price="₱ ".number_format($unit->price,2);
            $unit->size=number_format($unit->size,2);
        }
        $total=$regi_detail->fee;
        $vat=$total*($utilities->vat_rate/100);
        $subtotal=$vat+$total;
        $ewt=$total*($utilities->ewt_rate/100);
        $net_rent=($subtotal-$ewt);
        $final=$net_rent*$reservation->fee;
        $final="₱ ".number_format( $final,2 );
        $net_rent="₱ ".number_format( $net_rent,2 );
        $subtotal="₱ ".number_format($subtotal,2);
        $vat="₱ ".number_format($vat,2);
        $ewt="₱ ".number_format($ewt,2);
        $regi_detail->fee="₱ ".number_format($regi_detail->fee,2);
        $utilities->vat_rate.=" %";
        $utilities->ewt_rate.=" %";
        return response::json(
            [$final,$units,$regi_detail,
            //0     //1    //2
                $ewt,$vat,$subtotal,
            //3   //4  //5
                $utilities,$net_rent]
            //6         //7
            );

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
