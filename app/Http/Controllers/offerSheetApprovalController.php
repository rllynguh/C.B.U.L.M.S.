<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OfferSheetHeader;
use App\OfferSheetDetail;
use App\RegistrationDetail;
use DB;
use Response;
use Datatables;
use Auth;
class offerSheetApprovalController extends Controller
{
 public function __construct()
 {
  $this->middleware('tenant');
  $this->middleware('auth');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
      $result=DB::table('offer_sheet_headers')
      ->leftjoin('offer_sheet_details','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id'
        )
      ->join('registration_details','offer_sheet_details.registration_detail_id','registration_details.id')
      ->where('registration_details.is_rejected','0')
      ->where('registration_details.is_forfeited','0')
      ->where('registration_headers.is_forfeited','0')
      ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
      ->join('tenants','registration_headers.tenant_id','tenants.id')
      ->join('users as user_tenant','tenants.user_id','user_tenant.id')
      ->where('user_tenant.id','=',Auth::user()->id)
      ->where('registration_headers.status','1')
      ->join('users','registration_headers.user_id','users.id')
      ->where('offer_sheet_headers.status','0')
      ->select(DB::Raw('offer_sheet_headers.id, registration_headers.code as regi_code,offer_sheet_headers.code as offer_code,CONCAT(users.first_name," ",users.last_name) as name,offer_sheet_headers.date_issued as date, COUNT(offer_sheet_details.id) as regi_count'))
      ->groupBy('registration_headers.id')
      ->get();
      return Datatables::of($result)
      ->addColumn('action', function ($data) {
        return "<a href=".route('offerSheetApproval.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>
        ";
      })
      ->editColumn('date', function ($data) {
       $time = strtotime($data->date);
       $myDate = date( 'M d, Y', $time );
       $date=$myDate;
       return $date;
     })
      ->setRowId(function ($data) {
        return $data = 'id'.$data->id;
      })
      ->rawColumns(['action'])
      ->make(true);
    }
    public function index()
    {
      return view('transaction.offerSheetApproval.index');
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
           //
      DB::beginTransaction();
      try
      {
      if($request->header_is_active==1)// if the transaction was accepted
      {
       $offer_head=OfferSheetHeader::find($request->myId);
       $offer_head->status=1;
       $offer_head->tenant_remarks=$request->header_remarks;
       $offer_head->save();
       for($x=0;$x<count($request->offer_id); $x++)
       { 
        $offer_detail=OfferSheetDetail::findorfail($request->offer_id[$x]);
        if($request->offer_is_active[$x]==1)
        {
         $offer_detail->status=$request->offer_is_active[$x];
         $offer_detail->tenant_remarks=$request->offer_remarks[$x];
         $offer_detail->save();
       }
       else
       {
        $registration_details=DB::table('registration_details')
        ->join('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
        ->where('offer_sheet_details.id',$request->offer_id[$x])
        ->select('registration_details.id')
        ->first();
        $regi_detail=RegistrationDetail::findorfail($registration_details->id);
        if(!is_null($request->offer_remarks[$x]))
          $regi_detail->tenant_remarks=$request->offer_remarks[$x];
        else
          $regi_detail->tenant_remarks="";
        $regi_detail->save();
        $offer_detail->delete();
      }

    }
    $request->session()->flash('green', 'Offer Sheet Approved.');
  }
  else //if the transaction was rejected
  {
   $offer_head=OfferSheetHeader::find($request->myId);
   $offer_head->status=2;
   $offer_head->tenant_remarks=$request->header_remarks;
   $offer_head->save();
   $request->session()->flash('green', 'Offer Sheet Rejected.');
 }
 db::commit();
 return redirect(route('offerSheetApproval.index'));
}
catch(\Exception $e)
{
  db::rollBack();
  dd($e);
  $request->session()->flash('red', 'Ooops, something went wrong.');
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
  $results=DB::table('offer_sheet_headers')
  ->where('offer_sheet_headers.id',$id)
  ->where('registration_details.is_forfeited','0')
  ->join('users','offer_sheet_headers.user_id','users.id')
  ->join('offer_sheet_details','offer_sheet_headers.id','offer_sheet_details.offer_sheet_header_id')
  ->join('registration_details','offer_sheet_details.registration_detail_id','registration_details.id')
  ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
  ->select(DB::Raw('offer_sheet_headers.tenant_remarks,offer_sheet_headers.code,registration_headers.code as regi_code, offer_sheet_headers.id, CONCAT(users.first_name," ",users.last_name) as name,picture,registration_headers.date_issued as regi_date,count(distinctrow offer_sheet_details.id ) as unit_count,offer_sheet_headers.date_issued as offer_date'))
  ->first();
  $time = strtotime($results->regi_date);
  $myDate = date( 'M d,Y', $time );
  $results->regi_date=$myDate;
  $time = strtotime($results->offer_date);
  $myDate = date( 'M d,Y', $time );
  $results->offer_date=$myDate;

  $units=DB::table('offer_sheet_details')
  ->join('offer_sheet_headers','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id')
  ->join('registration_details','offer_sheet_details.registration_detail_id','registration_details.id')
  ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
  ->join('units','offer_sheet_details.unit_id','units.id')
  ->join("unit_prices","units.id","unit_prices.unit_id")
  ->join('floors','units.floor_id','floors.id')
  ->join('buildings','floors.building_id','buildings.id')
  ->join('addresses','buildings.address_id','addresses.id')
  ->join('cities','addresses.city_id','cities.id')
  ->join('provinces','cities.province_id','provinces.id')
  ->join('building_types','buildings.building_type_id','building_types.id')
  ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=units.id)")
  ->where('registration_headers.is_forfeited','0')
  ->where('offer_sheet_headers.id',$id)
  ->where('offer_sheet_headers.status','0')
  ->where('registration_details.is_forfeited','0')
  ->select('offer_sheet_details.id','units.type','units.size','units.code','building_types.description as building_type','floors.number as floor','buildings.description as building',DB::raw('units.size * price as price')
    ,DB::raw('CONCAT(cities.description, ", ", provinces.description) as address')
    )
  ->groupby('offer_sheet_details.id')
  ->get();
  foreach ($units as &$unit) {
    $type='Raw';
    if($unit->type==1)
      $type='Shell';
    $unit->type=$type;
    $unit->price="₱".number_format($unit->price,2);
    $unit->size=number_format($unit->size,2)." sqm";

  }

  return view('transaction.offerSheetApproval.show')
  ->withResults($results)
  ->withUnits($units);
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
  $result=DB::table('offer_sheet_details')
  ->join('registration_details','offer_sheet_details.registration_detail_id','registration_details.id')
  ->join('building_types','registration_details.building_type_id','building_types.id')
  ->select('floor as ordered_floor','description as ordered_building_type','unit_type as ordered_unit_type','offer_sheet_details.id','size_from','size_to')
  ->where('offer_sheet_details.id',$id)
  ->first();
  $unit_type='Raw';
  if($result->ordered_unit_type)
    $unit_type='Shell';
  $result->ordered_unit_type=$unit_type;
  $result->ordered_size_range=number_format($result->size_from,2)." sqm -".number_format($result->size_to,2)." sqm";
  $unit=DB::table('units')
  ->join('offer_sheet_details','units.id','offer_sheet_details.unit_id')
  ->join("unit_prices","units.id","unit_prices.unit_id")
  ->join('floors','units.floor_id','floors.id')
  ->join('buildings','floors.building_id','buildings.id')
  ->join('addresses','buildings.address_id','addresses.id')
  ->join('cities','addresses.city_id','cities.id')
  ->join('provinces','cities.province_id','provinces.id')
  ->join('building_types','buildings.building_type_id','building_types.id')
  ->select('units.type as offered_unit_type','floors.number as offered_floor','buildings.description as building','units.size as offered_size','building_types.description as offered_building_type','units.picture','units.code as unit_code',DB::Raw('Concat(cities.description, ", ", provinces.description) as city_province'),DB::Raw('price*size as rate'),DB::Raw('Concat(addresses.number," ",addresses.street," ",addresses.district) as half_address'))
  ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=units.id)")
  ->where('offer_sheet_details.id',$result->id)
  ->first();
  $result->offered_floor=$unit->offered_floor; 
  $result->building=$unit->building;
  $result->offered_size=number_format($unit->offered_size)." sqm";
  $result->offered_building_type=$unit->offered_building_type;
  $result->city_province=$unit->city_province;
  $result->half_address=$unit->half_address;
  $result->picture=$unit->picture;
  $result->unit_code=$unit->unit_code;
  $result->rate="₱".number_format($unit->rate,2);
  $unit_type='Raw';
  if($unit->offered_unit_type)
    $unit_type='Shell';
  $result->offered_unit_type=$unit_type;
  return response::json($result);
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
