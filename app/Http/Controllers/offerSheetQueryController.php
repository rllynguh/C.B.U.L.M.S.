<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Response;

class offerSheetQueryController extends Controller
{
    //
	public function index()
	{
		return view('query.offerSheet.index');
	}

	public function data(Request $request)
	{
		$result=db::table('offer_sheet_headers')
		->join('offer_sheet_details','offer_sheet_headers.id','offer_sheet_details.offer_sheet_header_id')
		->join('registration_details','offer_sheet_details.registration_detail_id','registration_details.id')
		->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
		->join('tenants','registration_headers.tenant_id','tenants.id')
		->join('users','offer_sheet_headers.user_id','users.id')
		->select(DB::raw('offer_sheet_headers.code,tenants.description as tenant,CONCAT(first_name," ",last_name) as full_name,count(offer_sheet_details.id) as unit_offered,offer_sheet_headers.date_issued'))
		->groupby('offer_sheet_headers.id')
		->where('offer_sheet_headers.status',$request->status)
		->get()
		;
		return Datatables::of($result)
		->editColumn('date_issued',function($data){
			$time = strtotime($data->date_issued);
			return $myDate = date( 'M d, Y', $time );
		})
		->make(true)
		;
	}
}
