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
        ->where('registration_headers.status','1')
        ->whereRaw('offer_sheet_details.status is null or 0' )
        ->groupBy('registration_headers.id')
        ->get();
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return "<a href=".route('offersheets.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>";
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
        $offerheader=new OfferSheetHeader;
        $offerheader->code="imbento101";
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
        return redirect(route('offersheets.index'));
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
        ->select(DB::Raw('offered_unit.id as unit_id, offered_unit.code as unit_code,ordered_building_type.description,CONCAT(registration_details.size_from,"-",registration_details.size_to) as size_range,registration_details.*'))
        ->leftJoin('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
        ->leftjoin('registration_headers','registration_details.registration_header_id','registration_headers.id')
        ->leftJoin('units as offered_unit', function($join)
        {
           $join->on('registration_details.unit_type', '=', 'offered_unit.type');
           $join->on('registration_details.size_from','<=','offered_unit.size');
           $join->on('registration_details.size_to','>=','offered_unit.size');
       })
        ->whereRaw('offered_unit.id not in (Select units.id from units inner join offer_sheet_details on offer_sheet_details.unit_id=units.id where offer_sheet_details.status != 2)')
        ->leftjoin('building_types as ordered_building_type','registration_details.building_type_id','ordered_building_type.id')
        ->leftjoin('floors as ordered_floor','registration_details.floor','ordered_floor.number')
        ->groupBy('registration_details.id')
        ->orderBy('registration_details.id')
        ->where('registration_headers.status','1')
        ->where('registration_headers.id',$id)
        ->whereRaw('offer_sheet_details.status is null or 0' )
        ->get();
        return view('transaction.offerSheet.show')
        ->withTenant($tenant)
        ->withResult($result);
    }
    public function showOptions($id)
    {
        $result=DB::table('registration_details')
        ->select(DB::Raw('registration_details.id as order_number, offered_unit.code as unit_offered, offered_unit.id as unit_id,  registration_details.unit_type as ordered_unit, offered_unit.type as offered_unit, 
            registration_details.size_from,registration_details.size_to,
            offered_unit.size as offered_exact_size,
            ordered_building_type.description as ordered_building_type,
            registration_details.floor as ordered_floor'))
        ->leftjoin('registration_headers','registration_details.registration_header_id','registration_headers.id')
        ->leftJoin('units as offered_unit', function($join)
        {
           $join->on('registration_details.unit_type', '=', 'offered_unit.type');
           $join->on('registration_details.size_from','<=','offered_unit.size');
           $join->on('registration_details.size_to','>=','offered_unit.size');
       })
        ->where('registration_details.id',$id)
        ->where('registration_headers.status','1')
        ->whereRaw('offered_unit.id not in (Select units.id from units inner join offer_sheet_details on offer_sheet_details.unit_id=units.id where offer_sheet_details.status != 2)')
        ->leftjoin('building_types as ordered_building_type','registration_details.building_type_id','ordered_building_type.id')
        ->leftjoin('floors as ordered_floor','registration_details.floor','ordered_floor.number')
        ->orderBy('registration_details.id')
        ->groupBy('offered_unit.id')
        ->get();

        return response::json($result);
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
