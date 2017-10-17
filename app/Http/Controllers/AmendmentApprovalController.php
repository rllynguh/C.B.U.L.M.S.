<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use App\Amendment;
use App\RegistrationHeader;
use App\OfferSheetDetail;
use App\OfferSheetHeader;
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
    	->join('current_contracts','current_contracts.contract_header_id','contract_headers.id')
    	->join('tenants','tenants.id','registration_headers.tenant_id')
    	->join('users','users.id','tenants.user_id')
    	->select('amendment.id as id','amendment.code as code',DB::raw('CONCAT(users.first_name," ",users.middle_name," ",users.last_name) as name'),'current_contracts.id as contract_header_id','amendment.duration_change as duration')
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
		return "<button type='button' class='btn btn-primary btnShowAmendmentModal' data-toggle='modal' data-id ='".$data->id."'data-contractId = '".$data->contract_header_id."' data-duration = '".$data->duration. "'data-target='#amendmentApprovalModal'>View Details</button>
		";
		})
		->setRowId(function ($data) {
		return $data = 'id'.$data->id;
		})
		->rawColumns(['action'])
		->make(true);
    }
    public function getAmendmentForfeits($id){
    	$result = DB::table('amendment')
    	->where('amendment.id',$id)
    	->leftjoin('amendment_forfeit','amendment_forfeit.amendment_id','amendment.id')
    	->groupBy('amendment_forfeit.id')
    	->join('units','units.id','amendment_forfeit.unit_id')
    	->join('floors','floors.id','units.floor_id')
    	->select('units.type as unit_type','units.code as unit_code','floors.number as unit_floorNum','units.id as unit_id','amendment.duration_change as duration')
    	->get();
    	return response()->json($result);
    	dd($result);
    }
    public function getUnits($id){
    	$result = DB::table('tenants')
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
    public function getRequests($id){
    	$result = DB::table('registration_details')
    	->where('registration_details.amendment_id',$id)
    	->join('building_types','building_types.id','registration_details.building_type_id')
    	->select('building_types.description as building_description',
    		'registration_details.unit_type as unit_type','registration_details.floor as floor_num',DB::raw('CONCAT(registration_details.size_from,"-",registration_details.size_to) as size'),'registration_details.tenant_remarks as remarks')
    	->get();
    	return response()->json($result);
    }

    public function postAction(Request $request){
    	$result = Amendment::where('id',$request->id)->first();
    	if(!is_null($result)){
    		$result->status = $request->status;
    		$result->admin_remarks = $request->admin_remarks;
    		$result->save();
    	}
        
    	/*offersheets
        db::beginTransaction();
      try
     {   //
       $query=DB::table("offer_sheet_headers")
       ->select("code")
       ->orderBy("id","desc")
       ->first();
       $pk="Offer Sheet ";
       if(!is_null($query))
         $pk=$query->code;
       $sc= new smartCounter();
       $pk=$sc->increment($pk);  
       $offerheader=new OfferSheetHeader;
       $offerheader->code=$pk;
       $offerheader->user_id=Auth::user()->id;
       $offerheader->date_issued=Carbon::now(Config::get('app.timezone'));
       $offerheader->isAmendment = 1;
       $offerheader->contract_header_id = $result->contract_header_id;
       $offerheader->save();

       $unitRequests = DB::table('registration_details')
       ->where('amendment_id',$request->id)
       ->get();
       foreach($unitRequests as $r){
        $offerdetail=new OfferSheetDetail;
        $offerdetail->offer_sheet_header_id=$offerheader->id;
        $offerdetail->registration_detail_id = $r->id;
        $offerdetail->
       }


       
       for($x=0;$x<count($request->detail_id);$x++)
       { 
         $offerdetail=new OfferSheetDetail;
         $offerdetail->offer_sheet_header_id=$offerheader->id;
         $offerdetail->registration_detail_id=$request->detail_id[$x];
         $offerdetail->unit_id=$request->offer_id[$x];
         $offerdetail->save();
       }
       db::commit();
       $request->session()->flash('green', 'Offer Sheet Successfully Generated!');
       return redirect(route('offersheets.index'));
     }
     catch(\Exception $e)
     {
      db::rollback();
      return dd($e);
    }
    */
    	//billing
    }
}
