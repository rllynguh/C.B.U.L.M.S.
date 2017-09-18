<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
class requestUnitsController extends Controller
{
    public function index(){
    	return view('tenant.requestUnits');
    }

    public function store(Request $request){
    	return response('testa');
    }
}
