<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class documentController extends Controller
{
	public function __construct()
	{
		$this->middleware('tenant');
		$this->middleware('auth');
	}
    //
	public function ReservationFee($id)
	{
		$document=DB::TABLE('registration_headers')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHERE('tenants.user_id',Auth::user()->id)
		->SELECT('registration_headers.id','pdf','registration_headers.code')
		->WHERE('registration_headers.id',$id)
		->FIRST();
		return VIEW('document.index')
		->withDocument($document);
	}
}
