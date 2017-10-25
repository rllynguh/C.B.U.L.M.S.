<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Response;
use App\RegistrationHeader;
use App\RegistrationDetail;
use Auth;
use Route;
class registrationApprovalController extends Controller
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
      return view('transaction.registrationApproval.index')->withTest('registrationApproval.getData')->withRoute( Route::currentRouteName())->withRouteName("Registration Approval");
    }
    public function unitRequests()
    {
      return view('transaction.registrationApproval.index')->withTest('unitRequests.getData')->withRoute( Route::currentRouteName())->withRouteName("Unit Requests");
    }
    public function data()
    {
      $result=DB::table('registration_headers')
      ->SELECT(DB::raw(
        'registration_headers.id,'.
        'registration_headers.code as regi_code,'.
        'tenants.description as tenant_description,'.
        'business_types.description as business_type_description,'.  
        'count(registration_details.id) as regi_count'
      ))
      ->JOIN('tenants','registration_headers.tenant_id','tenants.id')
      ->JOIN('business_types','tenants.business_type_id','business_types.id')
      ->JOIN('users','tenants.user_id','users.id')
      ->JOIN('registration_details','registration_headers.id','registration_details.registration_header_id')
      ->WHERE('registration_headers.status','0')
      ->WHERE('registration_headers.is_forfeited','0')
      ->WHERE('registration_details.is_forfeited','0')
      ->WHERE('registration_details.is_rejected','0')
      ->WHERE('registration_headers.is_existing_tenant','0')
      ->GROUPBY('registration_headers.id')
      ->ORDERBY('registration_headers.id')
      ->get();
      return Datatables::of($result)
      ->addColumn('action', function ($data) {
        return "<a href=".route('registrationApproval.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>";
      })
      ->setRowId(function ($data) {
        return $data = 'id'.$data->id;
      }) 
      ->rawColumns(['action'])
      ->make(true)
      ;
    }
    
    public function data_existing_tenant()
    {
      $result=DB::table('registration_headers')
      ->SELECT(DB::raw(
        'registration_headers.id,'.
        'registration_headers.code as regi_code,'.
        'tenants.description as tenant_description,'.
        'business_types.description as business_type_description,'.  
        'count(registration_details.id) as regi_count'
      ))
      ->JOIN('tenants','registration_headers.tenant_id','tenants.id')
      ->JOIN('business_types','tenants.business_type_id','business_types.id')
      ->JOIN('users','tenants.user_id','users.id')
      ->JOIN('registration_details','registration_headers.id','registration_details.registration_header_id')
      ->WHERE('registration_headers.status','0')
      ->WHERE('registration_headers.is_forfeited','0')
      ->WHERE('registration_details.is_forfeited','0')
      ->WHERE('registration_details.is_rejected','0')
      ->WHERE('registration_headers.is_existing_tenant','1')
      ->GROUPBY('registration_headers.id')
      ->ORDERBY('registration_headers.id')
      ->get();
      return Datatables::of($result)
      ->addColumn('action', function ($data) {
        return "<a href=".route('registrationApproval.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>";
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
      DB::begintransaction();
      try
      {  
          if($request->header_is_active==1)// if the transaction was accepted
          {
            $regi_head=RegistrationHeader::find($request->myId);
            $regi_head->status=1;
            $regi_head->user_id=Auth::user()->id;
            $regi_head->admin_remarks=$request->header_remarks;
            $regi_head->save();
            for($x=0;$x<count($request->regi_id); $x++)
            { 
              $regi_detail=RegistrationDetail::find($request->regi_id[$x]);
              $regi_detail->is_rejected=$request->regi_is_active[$x];
              $regi_detail->admin_remarks=$request->detail_remarks[$x];
              $regi_detail->save();
            }
            DB::commit();
            $request->session()->flash('green', 'Registration Approved.');
            return redirect(route('registrationApproval.index',$request->myId));
          }
          else //if the transaction was rejected
          {
            $regi_head=RegistrationHeader::find($request->myId);
            $regi_head->status=2;
            $regi_head->user_id=Auth::user()->id;
            $regi_head->admin_remarks=$request->header_remarks;
            $regi_head->save();
            DB::commit();
            $request->session()->flash('green', 'Registration Rejected.');
            return redirect(route('registrationApproval.index'));
          }
        }
        catch(\Exception $e)
        {
          DB::rollBack();
          $request->session()->flash('red', 'Ooops, something went wrong.');
          return $e;
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
        $tenant=DB::table('registration_headers')
        ->JOIN('tenants','registration_headers.tenant_id','tenants.id')
        ->JOIN('users','users.id','tenants.user_id')
        ->JOIN('representatives','users.id','representatives.user_id')
        ->JOIN('representative_positions','representatives.representative_position_id','representative_positions.id')
        ->JOIN('business_types','tenants.business_type_id','business_types.id')
        ->SELECT(DB::Raw('registration_headers.tenant_remarks,registration_headers.id,tenants.description as tenant,registration_headers.code, concat(first_name," ", last_name) as name,representative_positions.description as position,business_types.description as business,tenants.address,cell_num,picture,registration_headers.date_issued,tenant_remarks,duration_preferred,users.picture'))
        ->WHERE('registration_headers.status','0')
        ->WHERE('registration_headers.is_forfeited','0')
        ->WHERE('registration_headers.id','=',$id)
        ->first();
        $time = strtotime($tenant->date_issued);
        $myDate = date( 'M d,Y', $time );
        $tenant->date_issued=$myDate;

        $results=DB::table('registration_details')
        ->JOIN('registration_headers','registration_headers.id','registration_details.registration_header_id')
        ->JOIN('units','registration_details.unit_id','units.id')
        ->LEFTJOIN('unit_prices','units.id','unit_prices.unit_id')
        ->WHERERAW("unit_prices.date_as_of=(SELECT MAX(unit_prices.date_as_of) from unit_prices WHERE unit_id=units.id)")
        ->JOIN('floors','units.floor_id','floors.id')
        ->JOIN('buildings','floors.building_id','buildings.id')
        ->JOIN('addresses','buildings.address_id','addresses.id')
        ->JOIN('cities','addresses.city_id',"cities.id")
        ->JOIN('provinces','cities.province_id',"provinces.id")
        ->JOIN('building_types','building_types.id','buildings.building_type_id')
        ->SELECT(DB::Raw('registration_details.id,building_types.description as building_type, floors.number as floor,buildings.description as building,units.type as unit_type,units.size,price,Concat(addresses.number," ",addresses.street," ",addresses.district," ",cities.description, ", ", provinces.description) as address,units.picture,registration_details.tenant_remarks,units.code'))
        ->WHERE('registration_headers.id','=',$id)
        ->WHERE('registration_headers.status','0')
        ->WHERE('registration_headers.is_forfeited','0')
        ->WHERE('registration_details.is_forfeited','=',0)
        ->get();
        foreach ($results as &$result) {
         $value='Raw';
         if($result->unit_type==1)
          $value='Shell';
        $result->unit_type=$value;
        $result->size=number_format($result->size,2)." sqm";
        $result->price="₱ ".number_format($result->price,2);
      }

      return view('transaction.registrationApproval.customShow')
      ->withResults($results)
      ->withTenant($tenant);
      dd($myDate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
