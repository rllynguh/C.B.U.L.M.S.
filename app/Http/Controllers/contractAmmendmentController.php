<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Datatables;
use DB;
use Auth;
use App\User;
use PDF;
use App\CurrentContract;

class contractAmmendmentController extends Controller
{

	public function index(){
		return view('tenant.contractAmmendment');
	}

	public function data(){
		$contracts=DB::table('current_contracts')
		->join('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->join('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->join('tenants','registration_headers.tenant_id','tenants.id')
		->join('users as tenant','tenants.user_id','tenant.id')
		->join('users as admin','current_contracts.user_id','admin.id')
		->join('contract_details','current_contracts.id','contract_details.current_contract_id')
		->select(DB::raw('current_contracts.id,current_contracts.date_issued, contract_headers.code,CONCAT(admin.first_name," ",admin.last_name) as full_name,count(distinctrow contract_details.id) as unit_count'))
		->where('tenant.id',Auth::user()->id)
		->whereRaw('current_contracts.date_issued=(Select Max(date_issued) from current_contracts where contract_header_id=contract_headers.id)')
		->where('current_contracts.status',1)
		->groupBy('current_contracts.id')
		->get();
		return Datatables::of($contracts)
		->addColumn('action', function ($data) {
		return "<button type='button' class='btn btn-primary'>View Details</button>
		    <button type='button' class='btn btn-primary'>Alter Contract</button>
		";
		})
		->setRowId(function ($data) {
		return $data = 'id'.$data->id;
		})
		->rawColumns(['action'])
		->make(true);
	}
}
