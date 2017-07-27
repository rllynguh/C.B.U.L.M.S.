<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;
use Datatables;

class contractCreationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('admin');
      $this->middleware('auth');
    }
    public function data()
    {
      $result=DB::table('registration_headers')
      ->select(DB::Raw('registration_headers.id,registration_headers.code,tenants.description as tenant,business_types.description as business,count(registration_details.id) as unit_count'))
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
        return "<a href=".route('contract-create.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>";
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
      return view('transaction.contractCreation.index');
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
      $tenant=DB::table('registration_headers')
      ->where('registration_headers.id',$id)
      ->join('tenants','registration_headers.tenant_id','tenants.id')
      ->join('business_types','tenants.business_type_id','business_types.id')
      ->select('registration_headers.code','tenants.description as tenant','business_types.description as business_type')
      ->get()
      ;
      $units=DB::table('registration_headers')
      ->where('registration_headers.id',$id)
      ->where('registration_headers.status','1')
      ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
      ->where('registration_details.is_rejected','0')
      ->where('registration_details.is_forfeited','0')
      ->join('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
      ->where('offer_sheet_details.status','1')
      ->join('units','offer_sheet_details.unit_id','units.id')
      ->join('floors','units.floor_id','floors.id')
      ->join('buildings','floors.building_id','buildings.id')
      ->join('addresses','buildings.address_id','addresses.id')
      ->join('cities','addresses.city_id','cities.id')
      ->leftJoin("market_rates","cities.id","market_rates.city_id")
      ->groupBy("cities.id")
      ->whereRaw("market_rates.date_as_of=(SELECT MAX(date_as_of) from market_rates where city_id=cities.id) or isnull(market_rates.date_as_of)")
      ->select(DB::raw("units.code,COALESCE(market_rates.rate,0) as rate"))
      ->orderBy("cities.description")
      ->get();
      dd($units);
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
