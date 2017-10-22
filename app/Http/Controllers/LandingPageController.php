<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class LandingPageController extends Controller
{
    public function index(){
    	$user = Auth::user();
    	if(!is_null($user)){
    		return view('welcome');
    	}else{
    		return 'fuck u';
    	}
    }
}
