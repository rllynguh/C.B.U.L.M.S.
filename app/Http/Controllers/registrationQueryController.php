<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Response;
use App\BusinessType;
use App\City;

class registrationQueryController extends Controller
{
    //
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

    public function data(Request $request)
    {
    	$result=DB::table('registration_headers')
    	->select(DB::raw(
    		'registration_headers.id,'.
    		'registration_headers.code as regi_code,'.
    		'tenants.description as tenant_description,'.
    		'business_types.description as business_type_description,'.  
    		'count(registration_details.id) as regi_count,date_issued'
    		))
    	->join('tenants','registration_headers.tenant_id','tenants.id')
        ->join('addresses','tenants.address_id','addresses.id')
        ->join('cities','addresses.city_id','cities.id')
        ->join('business_types','tenants.business_type_id','business_types.id')
        ->join('users','tenants.user_id','users.id')
        ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
        ->where('registration_headers.status',$request->status)
        ->where('business_types.id',$request->business)
        ->where('cities.id',$request->city)
        ->where('registration_headers.is_forfeited','0')
        ->where('registration_details.is_forfeited','0')
        ->where('registration_details.is_rejected','0')
        ->groupBy('registration_headers.id')
        ->orderBy('registration_headers.id')
        ->get();
        return Datatables::of($result)
        ->setRowId(function ($data) {
          return $data = 'id'.$data->id;
      }) 
        ->editColumn('date_issued',function($data){
            $time = strtotime($data->date_issued);
            return $myDate = date( 'M d, Y', $time );
        })
        ->make(true)
        ;
    }

    public function index()
    {
     $busitype=BusinessType::where('is_active','=',1)
     ->select('id','description')
     ->orderBy('description')
     ->pluck('description','id');

     $city=City::where('is_active','=','1')
     ->select('description','id')
     ->orderBy('description')
     ->pluck('description','id');

     return view('query.registration.index')
     ->withBusiness($busitype)
     ->withCity($city)
     ;
 }

}

