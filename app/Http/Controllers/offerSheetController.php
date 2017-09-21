<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;
use Datatables;
use App\RegistrationHeader;
use App\OfferSheetDetail;
use App\OfferSheetHeader;
use Carbon\Carbon;
use Config;
use Auth;


class offerSheetController extends Controller
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
    public function data()
    {
      $result=DB::table('registration_headers')
      ->select(DB::raw(
        'registration_headers.id,'.
        'registration_headers.code as regi_code,'.
        'tenants.description as tenant_description,'.
        'business_types.description as business_type_description,'.  
        'count(distinctrow registration_details.id) as regi_count,registration_details.id as regi_detail'
        ))
      ->join('tenants','registration_headers.tenant_id','tenants.id')
      ->join('business_types','tenants.business_type_id','business_types.id')
      ->join('users','tenants.user_id','users.id')
      ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
      ->where('registration_headers.status','1')
      ->whereRaw('registration_details.id not in (Select registration_detail_id from offer_sheet_details)')
      ->where('registration_details.is_rejected','0')
      ->where('registration_details.is_forfeited','0')
      ->groupBy('registration_headers.id')
      ->get();
      return Datatables::of($result)
      ->addColumn('action', function ($data) {
        return "<a href=".route('offersheets.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>
        ";
      })
      ->setRowId(function ($data) {
        return $data = 'id'.$data->id;
      }) 
      ->rawColumns(['action'])
      ->make(true)
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
      db::beginTransaction();
      try
     {   //
       $query=DB::table("offer_sheet_headers")
       ->select("code")
       ->orderBy("id","desc")
       ->first();
       $pk="Offer Sheet ";
       if(!is_null($query))
         $pk=$query->code;
       $sc= new smartCounter();
       $pk=$sc->increment($pk);  
       $offerheader=new OfferSheetHeader;
       $offerheader->code=$pk;
       $offerheader->user_id=Auth::user()->id;
       $offerheader->date_issued=Carbon::now(Config::get('app.timezone'));
       $offerheader->save();
       for($x=0;$x<count($request->detail_id);$x++)
       { 
         $offerdetail=new OfferSheetDetail;
         $offerdetail->offer_sheet_header_id=$offerheader->id;
         $offerdetail->registration_detail_id=$request->detail_id[$x];
         $offerdetail->unit_id=$request->offer_id[$x];
         $offerdetail->save();
       }
       db::commit();
       $request->session()->flash('green', 'Offer Sheet Successfully Generated!');
       return redirect(route('offersheets.index'));
     }
     catch(\Exception $e)
     {
      db::rollback();
      return dd($e);
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
    $tenant=DB::table('registration_headers')
    ->join('tenants','registration_headers.tenant_id','tenants.id')
    ->join('users as tenant','tenant.id','tenants.user_id')
    ->join('users as admin','admin.id','registration_headers.user_id')
    ->join('representatives','tenant.id','representatives.user_id')
    ->join('representative_positions','representatives.representative_position_id','representative_positions.id')
    ->join('addresses','tenants.address_id','addresses.id')
    ->join('cities','addresses.city_id','cities.id')
    ->join('provinces','cities.province_id','provinces.id')
    ->join('business_types','tenants.business_type_id','business_types.id')
    ->select(DB::Raw('registration_headers.tenant_remarks,registration_headers.id,tenants.description as tenant,registration_headers.code, concat(tenant.first_name," ", tenant.last_name) as tenant_name,concat(admin.first_name," ", admin.last_name) as admin_name,representative_positions.description as position,business_types.description as business,Concat(addresses.number," ",addresses.street," ",addresses.district," ",cities.description, ", ", provinces.description) as address,tenant.cell_num,tenant.picture,registration_headers.date_issued,tenant_remarks,duration_preferred,tenant.picture'))
    ->where('registration_headers.is_forfeited','0')
    ->where('registration_headers.id','=',$id)
    ->first();
    $time = strtotime($tenant->date_issued);
    $myDate = date( 'M d,Y', $time );
    $tenant->date_issued=$myDate;

    $results=DB::table('registration_details')
    ->select(DB::Raw('offered_unit.id as unit_id, offered_unit.code as unit_code,ordered_building_type.description,CONCAT(registration_details.size_from,"-",registration_details.size_to) as size_range,registration_details.*,price*size as rate,registration_details.id as  regi_detail'))
    ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
    ->leftJoin('units as offered_unit', function($join)
    {
     $join->on('registration_details.unit_type', '=', 'offered_unit.type');
     $join->on('registration_details.size_from','<=','offered_unit.size');
     $join->on('registration_details.size_to','>=','offered_unit.size');
   })
    ->leftJoin("unit_prices","offered_unit.id","unit_prices.unit_id")
    ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=offered_unit.id)")
    ->whereRaw('offered_unit.id not in (Select unit_id from registration_details inner join offer_sheet_details on registration_details.id=offer_sheet_details.registration_detail_id 
      inner join units on offer_sheet_details.unit_id=units.id
      where units.is_active=1 and
      is_reserved=1)')
    ->where('registration_details.is_rejected','0')
    ->where('registration_details.is_forfeited','0')
    ->leftjoin('building_types as ordered_building_type','registration_details.building_type_id','ordered_building_type.id')
    ->leftjoin('floors as ordered_floor','registration_details.floor','ordered_floor.number')
    ->groupBy('registration_details.id')
    ->orderBy('registration_details.id')
    ->where('registration_headers.status','1')
    ->where('registration_headers.id',$id)
    ->get();
    
    foreach ($results as &$result) {
     $value='Raw';
     if($result->unit_type==1)
      $value='Shell';
    $result->unit_type=$value; 
    $result->rate="₱ ".number_format($result->rate,2 );
  }

  return view('transaction.offerSheet.show')
  ->withTenant($tenant)
  ->withResults($results);
}
public function showOptions($id)
{
  $results=DB::table('registration_details')
  ->select(DB::Raw('registration_details.id as order_number, offered_unit.code as unit_offered, offered_unit.id as unit_id,  registration_details.unit_type as ordered_unit_type, offered_unit.type as offered_unit, 
    registration_details.size_from,registration_details.size_to,
    offered_unit.size as offered_exact_size,
    ordered_building_type.description as ordered_building_type,
    registration_details.floor as ordered_floor,price*size as rate'))
  ->leftjoin('registration_headers','registration_details.registration_header_id','registration_headers.id')
  ->leftJoin('units as offered_unit', function($join)
  {
   $join->on('registration_details.unit_type', '=', 'offered_unit.type');
   $join->on('registration_details.size_from','<=','offered_unit.size');
   $join->on('registration_details.size_to','>=','offered_unit.size');
 })
  ->leftJoin("unit_prices","offered_unit.id","unit_prices.unit_id")
  ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=offered_unit.id)")
  ->where('registration_details.id',$id)
  ->where('registration_headers.status','1')
  ->whereRaw('offered_unit.id not in (Select unit_id from registration_details inner join offer_sheet_details on registration_details.id=offer_sheet_details.registration_detail_id 
   inner join units on offer_sheet_details.unit_id=units.id
   where units.is_active=1 and
   is_reserved=1)')
  ->leftjoin('building_types as ordered_building_type','registration_details.building_type_id','ordered_building_type.id')
  ->leftjoin('floors as ordered_floor','registration_details.floor','ordered_floor.number')
  ->orderBy('registration_details.id')
  ->groupBy('offered_unit.id')
  ->get();
  foreach ($results as &$result) {
    $result->size=$result->offered_exact_size; 
    $result->offered_exact_size=number_format($result->offered_exact_size,2 )." sqm"; 
    $result->rate="₱ ".number_format($result->rate,2 );
    $addQuery=DB::table('units')
    ->join('floors','units.floor_id','floors.id')
    ->join('buildings','floors.building_id','buildings.id','units.type')
    ->join('building_types','buildings.building_type_id','building_types.id')
    ->join('addresses','buildings.address_id','addresses.id')
    ->join('cities','addresses.city_id','cities.id')
    ->join('provinces','cities.province_id','provinces.id')
    ->select('building_types.description','floors.number','units.type as ordered_unit_type','buildings.description as building',DB::Raw('Concat(cities.description, ", ", provinces.description) as address'))
    ->where('units.id',$result->unit_id)
    ->first();
    $offered_unit_type='Raw';
    if($result->ordered_unit_type==1)
      $offered_unit_type='Shell';
    $ordered_unit_type='Raw';
    if($addQuery->ordered_unit_type==1)
      $ordered_unit_type='Shell';
    $result->ordered_unit_type=$ordered_unit_type;
    $result->offered_building_type=$addQuery->description;
    $result->offered_floor=$addQuery->number;
    $result->building=$addQuery->building;
    $result->address=$addQuery->address;
    $result->offered_unit_type=$offered_unit_type;
  }

  return response::json($results);
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
}
}
