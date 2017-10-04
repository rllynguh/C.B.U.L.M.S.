<?php

namespace App\Http\Controllers;
use DB;
use Datatables;
use Illuminate\Http\Request;
use Auth;
class mergeUnitsController extends Controller
{
	public function __construct()
    {
      $this->middleware('tenant');
      $this->middleware('auth');
    }
    public function index(){
    	$result = DB::table('tenants')
    	->where('tenants.user_id',Auth::id())
    	->join('registration_headers','registration_headers.tenant_id','tenants.id')
    	->join ('contract_headers','registration_headers.id','contract_headers.registration_header_id')
    	->join('contract_details','contract_headers.id','contract_details.current_contract_id')
    	->join('units','units.id','contract_details.unit_id')
    	->join('floors','units.floor_id','floors.id')
    	->select('units.code as unit_code','units.type as unit_type','floors.number as unit_floorNum')
    	->get();
   
    	for($x =0;$x<count($result);$x++){
    		if($result[$x]->unit_type==0){
    			$result[$x]->unit_type = "Raw";
    		}else{
    			$result[$x]->unit_type = "Shell";
    		}
    	}
    	return view('tenant.unitMerge')->with('units',$result);
    }
    public function getShit(){
    	$result = DB::table('tenants')
        ->where('tenants.user_id',Auth::id())
        ->join('registration_headers','registration_headers.tenant_id','tenants.id')
        ->join('users','users.id','registration_headers.user_id')
        ->join ('contract_headers','registration_headers.id','contract_headers.registration_header_id')
        ->join('current_contracts','contract_headers.id','current_contracts.contract_header_id')
        ->join('contract_details','contract_headers.id','contract_details.current_contract_id')
        ->join('units','units.id','contract_details.unit_id')
        ->join('floors','units.floor_id','floors.id')
        ->join('billing_headers','billing_headers.current_contract_id','current_contracts.id')
        ->select('units.code as unit_code','units.type as unit_type','floors.number as unit_floorNum','contract_headers.code as contract_code','registration_headers.date_issued as date_issued','current_contracts.start_of_contract as start_date','current_contracts.end_of_contract as end_date',DB::raw('CONCAT(users.first_name," ",users.middle_name," ",users.last_name) as name'),'billing_headers.cost as total_cost')
        ->get();
        return response()->json($result);
    	//dd($result);
    }
}
