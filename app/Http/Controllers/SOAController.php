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
        $output = array();
        $result = DB::table('payments')
        ->join('billing_headers','billing_headers.id','payments.billing_header_id')
        ->join('current_contracts','current_contracts.id','billing_headers.current_contract_id')
        ->join('contract_headers','contract_headers.id','current_contracts.contract_header_id')
        ->join('registration_headers','registration_headers.id','contract_headers.registration_header_id')
        ->join('tenants','tenants.id','registration_headers.tenant_id')
        ->join('users','users.id','tenants.user_id')
        ->where('users.id',Auth::user()->id)
        ->select('payments.date_collected as date_collected',
            'payments.id as id','payments.payment as payment','billing_headers.code as code')
        ->get();
        foreach($result as $r){
            $details = DB::table('payments')
            ->where('payments.id',$r->id)
            ->join('billing_headers','billing_headers.id','payments.billing_header_id')
            ->join('billing_details','billing_details.billing_header_id','billing_headers.id')
            ->get();
            array_push($output, array('header' => $r,'detail'=> $details));
        }
    	return view('tenant.soa')->with('bill_headers',$output);
    }
    public function data(){
        $output = array();
        $result = DB::table('payments')
        ->join('billing_headers','billing_headers.id','payments.billing_header_id')
        ->join('current_contracts','current_contracts.id','billing_headers.current_contract_id')
        ->join('contract_headers','contract_headers.id','current_contracts.contract_header_id')
        ->join('registration_headers','registration_headers.id','contract_headers.registration_header_id')
        ->join('tenants','tenants.id','registration_headers.tenant_id')
        ->join('users','users.id','tenants.user_id')
        ->where('users.id',Auth::user()->id)
        ->select('payments.date_collected as date_collected',
            'payments.id as id')
        ->get();
        foreach($result as $r){
            $details = DB::table('payments')
            ->where('payments.id',$r->id)
            ->join('billing_headers','billing_headers.id','payments.billing_header_id')
            ->join('billing_details','billing_details.billing_header_id','billing_headers.id')
            ->get();
            array_push($output, array('header' => $r,'detail'=> $details));
        }
    	dd($output);
    }
}
