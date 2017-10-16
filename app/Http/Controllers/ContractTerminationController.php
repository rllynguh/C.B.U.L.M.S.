<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use App\UserBalance;
use App\BillingDetail;
use App\BillingHeader;
use App\CurrentContract;
use Carbon\Carbon;
use Config;
use Auth;
class ContractTerminationController extends Controller
{
    public function index(){
    	return view('transaction.contractTermination');
    }
    public function data(){
    	$contracts=DB::table('current_contracts')
    	->where('current_contracts.status',0)
		->join('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->join('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->join('tenants','registration_headers.tenant_id','tenants.id')
		->join('users as tenant','tenants.user_id','tenant.id')
		->join('users as admin','current_contracts.user_id','admin.id')
		->join('contract_details','current_contracts.id','contract_details.current_contract_id')
		->select(DB::raw('current_contracts.id as id,current_contracts.date_issued, contract_headers.code,CONCAT(tenant.first_name," ",tenant.last_name) as full_name,count(distinctrow contract_details.id) as unit_count'))
		->whereRaw('current_contracts.date_issued=(Select Max(date_issued) from current_contracts where contract_header_id=contract_headers.id)')
		->groupBy('current_contracts.id')
		->join('billing_headers','billing_headers.current_contract_id','current_contracts.id')
    	->join('billing_details','billing_details.billing_header_id','billing_headers.id')
    	->where('billing_details.billing_item_id',3)
    	->addSelect('billing_details.price as price')
		->get();

		return Datatables::of($contracts)
		->addColumn('security_deposit', function ($data) {
			return $data->price;
		})
		->addColumn('action', function ($data) {
		return "<button type='button' class='btn btn-primary btnShowContractDetails' data-toggle='modal' data-id ='".$data->id."'data-target='#contractDetailsModal''>View Details</button>
		<button type='button' class='btn btn-primary btnShowTerminateModal' data-toggle='modal' data-id ='".$data->id."'data-target='#contractTerminationModal' data-security='".$data->price."'>Terminate Contract</button>   
		";
		})
		->setRowId(function ($data) {
		return $data = 'id'.$data->id;
		})
		->rawColumns(['action'])
		->make(true);
    }

    public function terminateContract(Request $request){
    	$security_deposit = DB::table('current_contracts')
    	->where('current_contracts.id',$request->id)
    	->join('billing_headers','billing_headers.current_contract_id','current_contracts.id')
    	->join('billing_details','billing_details.billing_header_id','billing_headers.id')
    	->where('billing_details.billing_item_id',3)
    	->addSelect('billing_details.price as price')
		->first()->price;

		$userBalance = DB::table('current_contracts')
		->where('current_contracts.id',$request->id)
		->join('contract_headers','contract_headers.id','current_contracts.contract_header_id')
		->join('registration_headers','registration_headers.id','contract_headers.registration_header_id')
		->join('tenants','tenants.id','registration_headers.tenant_id')
		->join('users','users.id','tenants.user_id')
		->join('user_balances','user_balances.user_id',
			'users.id')
		->select('user_balances.balance as balance','user_balances.user_id as id')
		->orderBy('user_balances.id','desc')
		->first();

		$newBalance = new UserBalance();
		$newBalance->date_as_of=Carbon::now(Config::get('app.timezone'));
		$newBalance->user_id = $userBalance->id;
		$total = $security_deposit - $request->total;
		$output = $userBalance->balance +  $total;
		$newBalance->balance = $output;
		$newBalance->save();
		

		$latest=DB::table("billing_headers")
		->select("billing_headers.*")
		->orderBy('code',"DESC")
		->first();

		$code="BILL001";
		if(!is_null($latest)){
			$code=$latest->code;
		}
		$sc= new smartCounter();
		$code=$sc->increment($code);


		$billing_header=new BillingHeader();
		$billing_header->user_id=Auth::user()->id;
		$billing_header->code=$code;
		$billing_header->date_issued = Carbon::now(Config::get('app.timezone'));
		$billing_header->current_contract_id= $request->id;
		$billing_header->cost = $total;
		$billing_header->save();

		$billing_detail = new BillingDetail();
		$billing_detail->billing_header_id = $billing_header->id;
		$billing_detail->price = $total;
		$billing_detail->description = "Reimbursed Reservation Fee";
		//too lazy for proper query. 9 = reservation fee return
		$billing_detail->billing_item_id = 9;
		$billing_detail->status=1;
		$billing_detail->save();


		$current_contract = CurrentContract::where('id',$request->id)
		->update(['status'=>2]);


		return response()->json(['price'=>$output]);
    }
}
