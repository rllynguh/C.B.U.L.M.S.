<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class AccountController extends Controller
{
    public function index(){
    	$details = DB::table('users')
    	->where('users.id',Auth::user()->id)
    	->select('first_name as first_name','middle_name as middle_name','last_name as last_name','email as email')
    	->first();
    	return view('tenant.profile')->with('detail',$details);
    }
    public function getAccountDetails(){
    	$result = DB::table('users')
    	->where('users.id',Auth::user()->id)
    	->select('first_name as first_name','middle_name as middle_name','last_name as last_name','email as email')
    	->first();
    	return response()->json($result);
    }
    public function setAccountDetails(Request $request){
    	//checks TODO
    	DB::table('users')
    	->where('users.id',Auth::user()->id)
    	->update(['first_name' => $request->firstnameinput
    		,'middle_name'=>$request->middlenameinput
    		,'last_name'=>$request->lastnameinput
    		,'email'=>$request->emailinput]);
    }
}
