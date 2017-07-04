<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;
use Datatables;

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
        $result=DB::table("registration_headers")
        ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
        ->select('registration_details.*')
        ->get();

//         select registration_headers.id as regi_header,
// registration_details.id as regi_detail,
// registration_details.building_type_id as ordered_building_type,
// building_types.id as proposed_building_types,
// units.type as proposed_unit_type,
// registration_details.unit_type as ordered_unit_type

// from `registration_details` 
// inner join `registration_headers` on `registration_details`.`registration_header_id` = `registration_headers`.`id`
// inner join units on units.type=registration_details.unit_type
// inner join floors on units.floor_id=floors.id
// inner join buildings on buildings.id=floors.building_id
// inner join building_types on building_types.id=buildings.building_type_id
// where building_types.id=registration_details.building_type_id
// or (floors.number=registration_details.floor or registration_details.size=units.size)
// ;



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
