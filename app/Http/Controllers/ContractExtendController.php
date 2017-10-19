<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
class ContractExtendController extends Controller
{
    public function index(){
    	return view('tenant.contractExtend.index');
    }
    public function data(){
    	$result = DB::table('notifications')
    	->join('current_contracts','current_contracts.id','notifications.current_contract_id')
    	->join('contract_headers','contract_headers.id','current_contracts.contract_header_id')
    	->whereIn('notifications.type',array('Extension','Renewal'))
    	->select('contract_headers.code as code','notifications.expires_on as time_left','notifications.type as type','current_contracts.end_of_contract as time_end','current_contracts.id as id')
    	->get();
    	return Datatables::of($result)
		->addColumn('action', function ($data) {
		$type = $data->type=='Renewal'?'Renew':'Extend';
		return "<button type='button' class='btn btn-primary btnShowContractDetails' data-toggle='modal' data-id ='".$data->id."'data-target='#contractDetailsModal'>".$type."</button>
		";
		})
		->setRowId(function ($data) {
		return $data = 'id'.$data->id;
		})
		->rawColumns(['action'])
		->make(true);
    	dd($result);
    }
}
