<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;
use Datatables;
use App\RegistrationHeader;

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
            'count(registration_details.id) as regi_count'
            ))
        ->join('tenants','registration_headers.tenant_id','tenants.id')
        ->join('business_types','tenants.business_type_id','business_types.id')
        ->join('users','tenants.user_id','users.id')
        ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
        ->leftJoin('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
        ->whereRaw('offer_sheet_details.is_accepted is null or 0' )
        ->groupBy('registration_headers.id')
        ->get();
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return "<a href=".route('offersheets.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a> <button id='btnDelete' class='btn bg-red btn-circle waves-effect waves-circle waves-float' ><i class='mdi-action-delete'></i></button>";
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
        ->join('tenants','registration_headers.tenant_id','tenants.id')
        ->select('tenants.description','registration_headers.code')
        ->where('registration_headers.id','=',$id)
        ->first();
        $result=DB::table('registration_details')
        ->join('registration_headers','registration_headers.id','registration_details.registration_header_id')
        ->join('building_types','building_types.id','registration_details.building_type_id')
        ->select(DB::Raw('CONCAT(registration_details.size_from,"-",registration_details.size_to) as size_range,registration_details.*,building_types.description'))
        ->where('registration_headers.id','=',$id)
        ->get();
        return view('transaction.offerSheet.show')
        ->withTenant($tenant)
        ->withResult($result);
    }
    public function showOptions($id)
    {
        $result=DB::table('registration_details')
        ->select(DB::Raw('registration_details.id as order_number, offered_unit.code as unit_offered,  registration_details.unit_type as ordered_unit, offered_unit.type as offered_unit, 
            CONCAT(registration_details.size_from,'-',registration_details.size_to) as ordered_range,
            offered_unit.size as offered_exact_size,
            ordered_building_type.description as ordered_building_type,
            offered_building_type.description as offered_building_type,
            registration_details.floor as ordered_floor,
            offered_floor.number as offered_floor'))
        ->leftjoin('registration_headers','registration_details.registration_header_id','registration_headers.id')
        ->leftjoin('building_types as ordered_building_type','registration_details.building_type_id','ordered_building_type.id')
        ->leftjoin('units as offered_unit','registration_details.unit_type','offered_unit.type and offered_unit.size between registration_details.size_from and registration_details.size_to')
        ->leftjoin('floors as ordered_floor','registration_details.floor','ordered_floor.number')
        ->join('floors as offered_floor','offered_unit.floor_id','offered_floor.id')
        ->join('buildings as offered_building','offered_floor.building_id','offered_building.id')
        ->groupBy('registration_details.id')
        ->orderBy('registration_details.id')
        ->get();

        dd($result);
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
       try
       {
        $result = RegistrationHeader::findorfail($id);
        try
        {
            $result->is_active=0;
            return Response::json($result);
        }
        catch(\Exception $e) {
            if($e->errorInfo[1]==1451)
              return Response::json(['true',$result]);
          else
              return Response::json(['true',$result,$e->errorInfo[1]]);
      }
  } 
  catch(\Exception $e) {
      return "Deleted";
  }
}
}
