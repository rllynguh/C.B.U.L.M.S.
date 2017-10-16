<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
class ContractTerminationController extends Controller
{
    public function index(){
    	return view('transaction.contractTermination');
    }
    public function data(){
    	$contracts=DB::table('current_contracts')
		->join('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->join('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->join('tenants','registration_headers.tenant_id','tenants.id')
		->join('users as tenant','tenants.user_id','tenant.id')
		->join('users as admin','current_contracts.user_id','admin.id')
		->join('contract_details','current_contracts.id','contract_details.current_contract_id')
		->select(DB::raw('current_contracts.id,current_contracts.date_issued, contract_headers.code,CONCAT(tenant.first_name," ",tenant.last_name) as full_name,count(distinctrow contract_details.id) as unit_count'))
		->whereRaw('current_contracts.date_issued=(Select Max(date_issued) from current_contracts where contract_header_id=contract_headers.id)')
		->groupBy('current_contracts.id')
		->get();
		return Datatables::of($contracts)
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
