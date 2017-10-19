<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Auth;
use App\ExtensionRequest;
use App\Notification;
use Carbon\Carbon;
class ContractExtensionApprovalController extends Controller
{
    public function index(){
    	return view('transaction.extensionApproval.extensionApproval');
    }
    public function data(){
    	$result = DB::table('extension_request')
    	->where('extension_request.status',0)
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
    public function setApproval(Request $request){
    	$query = DB::table('extension_request')
    	->where('extension_request.id',$request->id)
    	->join('current_contracts','current_contracts.id','extension_request.current_contract_id')
    	->select('extension_request.tenant_user_id as id','extension_request.type as type','extension_request.current_contract_id as current_contract_id','current_contracts.end_of_contract as end','extension_request.duration as duration')
    	->first();
    	if($request->action=='accept'){
    		DB::table('extension_request')
    		->where('extension_request.id',$request->id)
    		->update(['status'=>1]);
    		//notify tenant
    		$notification = new Notification;
    		$notification->user_id = $query->id;
    		$notification->title = 'Request Update';
    		$notification->description = 'Your '.$query->type.' request has been accepted';
    		$notification->date_issued=Carbon::now();
    		$notification->type = 'Request update';
    		$notification->link = 'javascript:void(0)';
    		$notification->save();

    		//modify old notification
    		$old = DB::table('notifications')
    		->where('current_contract_id',$query->current_contract_id)
    		->delete();
    		//contract alteration hack
    		$amount = Carbon::createFromFormat('Y-m-d', $query->end);
    		if($query->type=='Renewal'){
    			$amount->addYears($query->duration);
    		}else if($query->type =='Extension'){
    			$amount->addMonths($query->duration);
    		}
    		$final = DB::table('current_contracts')
    		->where('current_contracts.id',$query->current_contract_id)
    		->update(['end_of_contract'=>$amount]);
    		//update billing
    	}else if($request->action=='deny'){
    		$notification = new Notification;
    		$notification->user_id = $query->id;
    		$notification->title = 'Request Update';
    		$notification->description = 'Your '.$query->type.' request has been denied';
    		$notification->date_issued=Carbon::now();
    		$notification->type = 'Request update';
    		$notification->link = 'javascript:void(0)';
    		$notification->save();
    		DB::table('extension_request')
    		->where('extension_request.id',$request->id)
    		->update(['status'=>2]);
    	}
 
    }
}
