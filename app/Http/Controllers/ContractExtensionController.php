<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Auth;
use App\ExtensionRequest;
class ContractExtensionController extends Controller
{
    public function index(){
    	return view('tenant.contractExtend.index');
    }
    public function data(){
    	$result = DB::table('notifications')
        ->where('notifications.expires_on','>','0')
    	->join('current_contracts','current_contracts.id','notifications.current_contract_id')
    	->join('contract_headers','contract_headers.id','current_contracts.contract_header_id')
    	->whereIn('notifications.type',array('Extension','Renewal'))
    	->select('contract_headers.code as code','notifications.expires_on as time_left','notifications.type as type','current_contracts.end_of_contract as time_end','current_contracts.id as id')
    	->get();
    	return Datatables::of($result)
		->addColumn('action', function ($data) {
		$type = $data->type=='Renewal'?'Renew':'Extend';
		return "<button type='button' class='btn btn-primary btnShowContractDetails' data-toggle='modal' data-id ='".$data->id."'data-target='#contractDetailsModal'>View Details</button>
		<button type='button' class='btn btn-primary btnExtend'data-id ='".$data->id."'data-type ='".$data->type."'>".$type."</button>
		";
		})
		->setRowId(function ($data) {
		return $data = 'id'.$data->id;
		})
		->rawColumns(['action'])
		->make(true);
    	dd($result);
    }
    public function extendContract(Request $request){
    	$result = DB::table('current_contracts')
    	->where('current_contracts.id',$request->id)
    	->join('notifications','notifications.current_contract_id','current_contracts.id')
    	->select('notifications.type as type','current_contracts.id as id','current_contracts.pdf as pdf')
    	->first();
    	$extension = new ExtensionRequest;
    	$extension->current_contract_id = $result->id;
    	$extension->type = $result->type;
    	$extension->duration=$request->duration;
        $extension->status = 0;
        $extension->tenant_user_id = Auth::user()->id;
    	$extension->save();
    	
    }
}
