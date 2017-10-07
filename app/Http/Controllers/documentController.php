<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class documentController extends Controller
{
    //
	public function ReservationFee($id)
	{
		$document=DB::TABLE('registration_headers')
		->SELECT('id','pdf','code')
		->WHERE('id',$id)
		->FIRST();
		return VIEW('document.index')
		->withDocument($document);
	}
}
