<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Datatables;
use Auth;
use App\RegistrationDetail;
use App\RegistrationHeader;

class registrationForfeitController extends Controller
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
    public function index()
    {
        //
      return view('transaction.registrationForfeit.index');
    }
    public function data()
    {
      $result=DB::table('registration_headers')
      ->select(DB::raw(
        'registration_headers.id,'.
        'registration_headers.code,'. 
        'count(registration_details.id) as regi_count,'.
        'registration_headers.date_issued,'.
        'registration_headers.tenant_remarks,'.
        'registration_headers.duration_preferred'
        ))
      ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
      ->join('tenants','registration_headers.tenant_id','tenants.id')
      ->join('users','tenants.user_id','users.id')
      ->leftjoin('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
      ->leftjoin('offer_sheet_headers','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id')
      ->where('registration_headers.is_forfeited',0)
      ->where('registration_headers.status','!=',2)
      ->where('users.id',Auth::user()->id)
      ->whereRaw('(offer_sheet_headers.status is null or offer_sheet_headers.status = 0)')
      ->where('registration_details.is_forfeited',0)
      ->where('registration_details.is_rejected','!=',1)
      ->groupBy('registration_headers.id')
      ->get();
      return Datatables::of($result)
      ->addColumn('action', function ($data) {
        return "<a href=".route('registrationForfeit.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>";
      })
      ->editColumn('date_issued',function($data)
      {
        $time = strtotime($data->date_issued);
        $myDate = date( 'M d,Y', $time );
        return $myDate;
      }
      )
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
    public function show($id)
    {
      $registration=DB::table('registration_headers')
      ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
      ->select(DB::Raw('registration_headers.code as regi_code, registration_headers.id,registration_headers.date_issued as regi_date,count(distinctrow registration_details.id ) as unit_count'))
      ->where('registration_headers.id',$id)
      ->where('registration_details.is_forfeited',0)
      ->where('registration_details.is_rejected','!=',1)
      ->first();
      $time = strtotime($registration->regi_date);
      $myDate = date( 'M d,Y', $time );
      $registration->regi_date=$myDate;

      $results=DB::table('registration_details')
      ->join('registration_headers','registration_headers.id','registration_details.registration_header_id')
      ->join('building_types','building_types.id','registration_details.building_type_id')
      ->select(DB::Raw('CONCAT(registration_details.size_from,"-",registration_details.size_to," sqm") as size_range,registration_details.*,building_types.description, registration_details.id as detail_id'))
      ->where('registration_headers.id','=',$id)
      ->where('registration_details.is_forfeited','=',0)
      ->where('registration_details.is_rejected','!=',1)
      ->get();
      foreach ($results as &$result) {
       $value='Raw';
       if($result->unit_type==1)
        $value='Shell';
      $result->unit_type=$value;
    }

    return view('transaction.registrationForfeit.show')
    ->withRegistration($registration)
    ->withResults($results)
    ;

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
      db::beginTransaction();
      try
      { 
        $regi_header=RegistrationHeader::find($request->myId);
        if($request->header_is_active==1)
        {
         $regi_header->is_forfeited=1;
         $request->session()->flash('green', 'Registration Forfeited.');
       }
       else
       {
         $regi_header->is_forfeited=0;
         for($x=0;$x<count($request->regi_id);$x++)
         {
           $regi_detail=RegistrationDetail::find($request->regi_id[$x]);
           $regi_detail->is_forfeited=$request->regi_is_active[$x];
           $regi_detail->save(); 
           $request->session()->flash('green', 'Unit Request Forfeited.');
         }
       }
       $regi_header->save();
       db::commit();
       return redirect(route('registrationForfeit.index'));
     }
     catch(\Exception $e)
     {
      db::rollback();
      $request->session()->flash('red', 'Ooops, something went wrong.');
      dd($e);
    }
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
