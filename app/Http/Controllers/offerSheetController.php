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
        ->first()
        ;
        $result=DB::table("registration_details")
        ->join('registration_headers','registration_headers.id','registration_details.registration_header_id')
        ->join('tenants','registration_headers.tenant_id','tenants.id')
        ->join('users','tenants.user_id','users.id')
        ->leftjoin('units',function($join)
        {
            $join->on('registration_details.unit_type', '=', 'units.type') ->whereRaw('units.size between registration_details.size_from - 100 AND size_to + 100');
        })
        ->join('floors as f','units.floor_id','f.id')
        ->join('buildings as b','f.building_id','b.id')
        ->leftjoin('floors',function($join)
        {
            $join->on('units.floor_id', '=', 'floors.id') ->whereRaw('registration_details.floor=floors.number');
        })
        ->leftjoin('buildings',function($join)
        {
            $join->on('floors.building_id', '=', 'buildings.id') ->whereRaw('registration_details.building_type_id=buildings.building_type_id');
        })
        ->where('registration_headers.id','=',$id)
        ->where('tenants.is_active','=',1)
        ->where('users.is_active','=',1)
        ->select(DB::Raw("registration_details.id as regi,
            units.id as unit_id,
            units.code as unit_code,
            floors.number as floor,
            buildings.id as building,
            registration_details.unit_type as ordered_unit_type,
            units.type as proposed_unit_type,   
            units.size as proposed_size,
            registration_details.floor as ordered_floor,
            floors.number as proposed_floor,
            registration_details.building_type_id as ordered_building_type,
            buildings.building_type_id as porposed_building_type "))
        ->groupBy('registration_details.id')
        ->get();
        return view('transaction.offerSheet.show')
        ->withResult($result)
        ->withTenant($tenant)
        ;

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
