<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\UserBalance;
use Carbon\Carbon;
class SOAController extends Controller
{
    public function index(){
        $result = DB::table('payments')
        ->join('billing_headers','billing_headers.id','payments.billing_header_id')
        ->join('current_contracts','current_contracts.id','billing_headers.current_contract_id')
        ->join('contract_headers','contract_headers.id','current_contracts.contract_header_id')
        ->join('registration_headers','registration_headers.id','contract_headers.registration_header_id')
        ->join('tenants','tenants.id','registration_headers.tenant_id')
        ->join('users','users.id','tenants.user_id')
        ->get();
    	return view('tenant.soa')->with('bill_headers',$result);
    }
    public function data(){
    	/*
        $result = DB::table('registration_headers')
        ->join('tenants','tenants.id','registration_headers.tenant_id')
        ->join('users','users.id','tenants.user_id')
        ->where('users.id',Auth::user()->id)
        ->groupBy('registration_headers.id')
        ->join('contract_headers','contract_headers.registration_header_id','registration_headers.id')
        ->join('current_contracts','current_contracts.contract_header_id','contract_headers.id')
        ->join('billing_headers','billing_headers.current_contract_id','current_contracts.id')
        ->join('billing_details','billing_details.billing_header_id','billing_headers.id')
        ->groupBy('billing_details.id')
        ->sortBy('')
        ->get();
        */
        $result = DB::table('payments')
        ->join('billing_headers','billing_headers.id','payments.billing_header_id')
        ->join('current_contracts','current_contracts.id','billing_headers.current_contract_id')
        ->join('contract_headers','contract_headers.id','current_contracts.contract_header_id')
        ->join('registration_headers','registration_headers.id','contract_headers.registration_header_id')
        ->join('tenants','tenants.id','registration_headers.tenant_id')
        ->join('users','users.id','tenants.user_id')
        ->get();
    	dd($result);
    }
}
