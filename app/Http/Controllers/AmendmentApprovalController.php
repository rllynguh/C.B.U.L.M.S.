<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
class AmendmentApprovalController extends Controller
{
    public function index(){
    	return view('transaction.amendmentApproval.amendmentApproval');
    }
    public function data(){
    	$result = DB::table('amendment')
    	->where('amendment.status',0)
    	->join('contract_headers','contract_headers.id','amendment.contract_header_id')
    	->join('registration_headers','registration_headers.id','contract_headers.registration_header_id')
    	->join('tenants','tenants.id','registration_headers.tenant_id')
    	->join('users','users.id','tenants.user_id')
    	->select('amendment.id as id','amendment.code as code',DB::raw('CONCAT(users.first_name," ",users.middle_name," ",users.last_name) as name'))
    	->get();
    	//dd($result);
    	return Datatables::of($result)
    	->addColumn('num_of_forfeit',function($data){
    		$count = DB::table('amendment_forfeit')
    		->where('amendment_forfeit.amendment_id',$data->id)
    		->count();
    		return $count;
    	})
    	->addColumn('num_of_units',function($data){
    		$count = DB::table('registration_details')
    		->where('registration_details.amendment_id',$data->id)
    		->count();
    		return $count;
    	})
    	->addColumn('original_units',function($data){
    		$count = DB::table('contract_details')
    		->join('current_contracts','current_contracts.id','contract_details.current_contract_id')
    		->join('contract_headers','contract_headers.id','current_contracts.contract_header_id')
    		->join('amendment','amendment.contract_header_id','contract_headers.id')
    		->where('amendment.id',$data->id)
    		->count();
    		return $count;
    	})
    	->addColumn('action', function ($data) {
		return "<button type='button' class='btn btn-primary btnShowContractDetails' data-toggle='modal' data-id ='".$data->id."'data-target='#contractDetailsModal'>View Details</button>
		<button type='button' class='btn btn-primary btnAlterContract' data-toggle='modal' data-id ='".$data->id."'data-target='#modal-alter-contract'>Alter Contract</button>   
		";
		})
		->setRowId(function ($data) {
		return $data = 'id'.$data->id;
		})
		->rawColumns(['action'])
		->make(true);
    	
    }
}
