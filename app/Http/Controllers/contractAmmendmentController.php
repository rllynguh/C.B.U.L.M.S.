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
	public function edit($id){
		$result = DB::table('tenants')
        ->where('tenants.user_id',Auth::id())
        ->join('registration_headers','registration_headers.tenant_id','tenants.id')
        ->join('users','users.id','registration_headers.user_id')
        ->join ('contract_headers','registration_headers.id','contract_headers.registration_header_id')
        ->join('current_contracts','contract_headers.id','current_contracts.contract_header_id')
        ->where('current_contracts.id',$id)
        ->join('contract_details','contract_headers.id','contract_details.current_contract_id')
        ->join('units','units.id','contract_details.unit_id')
        ->join('floors','units.floor_id','floors.id')
        ->join('billing_headers','billing_headers.current_contract_id','current_contracts.id')
        ->groupBy('units.id')
        ->select('units.code as unit_code','units.type as unit_type','floors.number as unit_floorNum','contract_headers.code as contract_code','registration_headers.date_issued as date_issued','current_contracts.start_of_contract as start_date','current_contracts.end_of_contract as end_date',DB::raw('CONCAT(users.first_name," ",users.middle_name," ",users.last_name) as name'),'billing_headers.cost as total_cost,registration_headers.id as id')
        ->get();
		return view('tenant.contractAmmendmentRequest')->with('units',$result);
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
		->groupBy('current_contracts.id')
		->get();
		return Datatables::of($contracts)
		->addColumn('action', function ($data) {
		return "<button type='button' class='btn btn-primary btnShowContractDetails' data-toggle='modal' data-id ='".$data->id."'data-target='#contractDetailsModal'>View Details</button>
		<button type='button' class='btn btn-primary btnAlterContract' data-toggle='modal' data-id ='".$data->id."'data-target='#modal-alter-contract'>Alter Contract</button>
		   
		";
		// <a href=".route('tenant.contractEdit',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>
		})
		->setRowId(function ($data) {
		return $data = 'id'.$data->id;
		})
		->rawColumns(['action'])
		->make(true);
	}
	public function getUnits($id){
    	$result = DB::table('tenants')
        ->where('tenants.user_id',Auth::id())
        ->join('registration_headers','registration_headers.tenant_id','tenants.id')
        ->join('users','users.id','registration_headers.user_id')
        ->join ('contract_headers','registration_headers.id','contract_headers.registration_header_id')
        ->join('current_contracts','contract_headers.id','current_contracts.contract_header_id')
        ->where('current_contracts.id',$id)
        ->join('contract_details','contract_headers.id','contract_details.current_contract_id')
        ->join('units','units.id','contract_details.unit_id')
        ->join('floors','units.floor_id','floors.id')
        ->join('billing_headers','billing_headers.current_contract_id','current_contracts.id')
        ->groupBy('units.id')
        ->select('units.code as unit_code','units.type as unit_type','floors.number as unit_floorNum','contract_headers.code as contract_code','registration_headers.date_issued as date_issued','current_contracts.start_of_contract as start_date','current_contracts.end_of_contract as end_date',DB::raw('CONCAT(users.first_name," ",users.middle_name," ",users.last_name) as name'),'billing_headers.cost as total_cost','registration_headers.id as id',"units.id as unit_id")
        ->get();
        return response()->json($result);
    	dd($result);
    }
    public function test(){
    	$result=DB::table('registration_headers')
       ->where('registration_headers.id',$id)
       ->where('registration_headers.status','1')
       ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
       ->where('registration_details.is_rejected','0')
       ->where('registration_details.is_forfeited','0')
       ->join('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
       ->where('offer_sheet_details.status','1')
       ->join('units','offer_sheet_details.unit_id','units.id')
       ->join('floors','units.floor_id','floors.id')
       ->join('buildings','floors.building_id','buildings.id')
       ->join('addresses','buildings.address_id','addresses.id')
       ->join('cities','addresses.city_id','cities.id')
       ->leftJoin("unit_prices","units.id","unit_prices.unit_id")
       ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=units.id)")
       ->Select(DB::Raw("units.size,units.id,units.code,unit_prices.price as rate,unit_prices.price * units.size as price"))
       ->get();
       dd($result);
    }
}
