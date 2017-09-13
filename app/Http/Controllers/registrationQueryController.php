<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Response;

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
    		'count(registration_details.id) as regi_count'
    		))
    	->join('tenants','registration_headers.tenant_id','tenants.id')
    	->join('business_types','tenants.business_type_id','business_types.id')
    	->join('users','tenants.user_id','users.id')
    	->join('registration_details','registration_headers.id','registration_details.registration_header_id')
    	->where('registration_headers.status','0')
    	->where('registration_headers.is_forfeited','0')
    	->where('registration_details.is_forfeited','0')
    	->where('registration_details.is_rejected','0')
    	->groupBy('registration_headers.id')
    	->orderBy('registration_headers.id')
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

    public function index(Request $request)
    {
    	return view('query.registration.index')->withStatus($request->status);
    }

}

