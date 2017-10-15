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
use App\RegistrationDetail;
use App\Amendment;
use App\AmendmentForfeit;
use Exception;
class contractAmendmentController extends Controller
{

	public function index(){
		return view('tenant.contractAmendment');
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
		return view('tenant.contractAmendmentRequest')->with('units',$result);
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
    public function storeRequest(Request $request){
    	//return $requests->contract_id;
    	$returnData;
    	DB::begintransaction();
    	try{
    		$result = DB::table("tenants")
	    	->where('tenants.user_id',Auth::id())
	    	->join('registration_headers','registration_headers.tenant_id','tenants.id')
	        ->join ('contract_headers','registration_headers.id','contract_headers.registration_header_id')
	        ->join('current_contracts','contract_headers.id','current_contracts.contract_header_id')
	        ->where('current_contracts.id',$request->contract_id)
	        ->select('current_contracts.id as id','registration_headers.id as registration_headers_id')
	        ->first();
	        $regi_id = $result->registration_headers_id;
	        //check if valid contract
	        if(!is_null($result)){
	        	$returnData = array(
				    'status' => 'okay',
				    'message' => 'all fine'
				);
				$num = 1;
				//check if user made a unit request
				if(count($request->builtype)>0){
					$header_query=DB::table("amendment")
					->select("amendment.code")
					->orderBy("id","desc")
					->first();
					//generation of code
					$amendment_header_pk="Amendment";
					if(!is_null($header_query)){
						$amendment_header_pk=$header_query->code;
					}
					$sc= new smartCounter();
					$amendment_header_pk=$sc->increment($amendment_header_pk);
					//end code
					$amendment_header=new Amendment();
					$amendment_header->code=$amendment_header_pk;
					$true_id = DB::table("current_contracts")
					->select("current_contracts.contract_header_id as id")
					->where("id",$request->contract_id)
					->first();
					$amendment_header->contract_header_id=$true_id->id;
					//$amendment_header->date_issued=Carbon::now(Config::get('app.timezone'));
					$amendment_header->tenant_remarks=$request->header_remarks;
					if(!is_null($request->duration_change)){
						$amendment_header->duration_change=$request->duration_change;
					}
					//$regi_header->is_existing_tenant = '1';
					$amendment_header->save();
					for($x=0;$x<count($request->builtype); $x++){ 
						$num++;
						$result=explode('|',$request->size[$x]);
						$regi_detail=new RegistrationDetail;
						$regi_detail->amendment_id=$amendment_header->id;
						$regi_detail->building_type_id=$request->builtype[$x];
						$regi_detail->unit_type=$request->utype[$x];
						$regi_detail->size_from=$result[0];
						$regi_detail->size_to=$result[1];
						$regi_detail->floor=$request->floor[$x];
						$regi_detail->tenant_remarks=$request->remarks[$x];
						$regi_detail->is_amendment = 1;
						$regi_detail->save();
					}
					$num=1;
					for($x=0;$x<count($request->discard_code);$x++){
						$num++;
						$toDiscard = new AmendmentForfeit;
						$toDiscard->amendment_id = $amendment_header->id;
						$toDiscard->unit_id = $request->discard_code[$x];
						$toDiscard->save();
					}
				}
				
		          if($num==1){
			          $returnData = array(
					   'status' => 'Error',
					    'message' => 'Shit doesnt save'
					  );
		          }
		          DB::commit();
	        }else{
	        	$returnData = array(
				    'status' => 'Error',
				    'message' => 'Invalid contract please try again'
				);
	        }
    	}catch(Exception $e){
    		DB::rollback();
    		$var = $e->getMessage();
    		$returnData = array(
			    'status' => $var,
			    'message' => $var
			);
    	}
    	return response()->json($returnData);
    	//$request->session()->flash('green', 'Offer Sheet Successfully Generated!');
    }
    public function test(){
    	$result = DB::table("tenants")
	    	->where('tenants.user_id',Auth::id())
	    	->join('registration_headers','registration_headers.tenant_id','tenants.id')
	        ->join ('contract_headers','registration_headers.id','contract_headers.registration_header_id')
	        ->join('current_contracts','contract_headers.id','current_contracts.contract_header_id')
	        ->where('current_contracts.id',1)
	        ->select('current_contracts.id as id','registration_headers.id as registration_headers_id')
	        ->get();
	        dd($result);
    }
}
