<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Auth;
use App\ExtensionRequest;
class ContractExtensionApprovalController extends Controller
{
    public function index(){
    	return view('transaction.extensionApproval.extensionApproval');
    }
    public function data(){
    	$result = DB::table('extension_request')
    	->join('current_contracts','current_contracts.id','extension_request.current_contract_id')
    	->join('contract_headers','contract_headers.id','current_contracts.contract_header_id')
    	->select('contract_headers.code as code','current_contracts.end_of_contract as time_end','extension_request.type as type','extension_request.duration as duration','extension_request.id as id');
    	return Datatables::of($result)
		->addColumn('action', function ($data) {
		$type = $data->type=='Renewal'?'Renew':'Extend';
		return "<button type='button' class='btn btn-success btnShowContractDetails' data-toggle='modal' data-id ='".$data->id."'data-target='#contractDetailsModal'>View Details</button>
		<button type='button' class='btn btn-primary btnApproval' data-toggle='modal' data-target = '#accept-reject-modal' data-id ='".$data->id."'>Accept/Reject</button>
		";
		})
		->setRowId(function ($data) {
		return $data = 'id'.$data->id;
		})
		->rawColumns(['action'])
		->make(true);
    	return response()->json($result);
    }
}
