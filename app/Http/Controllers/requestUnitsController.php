<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Auth;
use Carbon\Carbon;
use Config;
use App\RegistrationHeader;
use App\RegistrationDetail;
use App\RegistrationRequirement;
class requestUnitsController extends Controller
{
    public function index(){
    	return view('tenant.requestUnits');
    }

    public function store(Request $request){
    	DB::begintransaction();
    	$header_query=DB::table("registration_headers")
          ->select("registration_headers.code")
          ->orderBy("id","desc")
          ->first();
          $regi_header_pk="Registration";
          if(!is_null($header_query))
            $regi_header_pk=$header_query->code;
          $sc= new smartCounter();
          $regi_header_pk=$sc->increment($regi_header_pk);
          $regi_header=new RegistrationHeader;
          $regi_header->code=$regi_header_pk;
          $tenant_id = DB::table("tenants")
          ->select("id as id")
          ->where("user_id",Auth::id())
          ->first();
          $regi_header->tenant_id=$tenant_id->id;
          $regi_header->date_issued=Carbon::now(Config::get('app.timezone'));
          $regi_header->tenant_remarks=$request->header_remarks;
          $regi_header->duration_preferred=$request->duration;
          $regi_header->is_existing_tenant = '1';
          $regi_header->save();
          for($x=0;$x<count($request->builtype); $x++)
          { 
            $result=explode('|',$request->size[$x]);
            $regi_detail=new RegistrationDetail;
            $regi_detail->registration_header_id=$regi_header->id;
            $regi_detail->building_type_id=$request->builtype[$x];
            $regi_detail->unit_type=$request->utype[$x];
            $regi_detail->size_from=$result[0];
            $regi_detail->size_to=$result[1];
            $regi_detail->floor=$request->floor[$x];
            $regi_detail->tenant_remarks=$request->remarks[$x];
            $regi_detail->save();
          }
          $businessType = DB::table('tenants')
          ->select('business_type_id as typeid')
          ->where('user_id',Auth::id())
          ->first();
          $requirements=DB::table('business_type_requirements')
          ->select('requirements.id')
          ->join('requirements','business_type_requirements.requirement_id','requirements.id')
          ->where('requirements.is_active',1)
          ->where('business_type_requirements.business_type_id',$businessType->typeid)
          ->get();
          foreach ($requirements as $requirement) {
            $regi_require=new RegistrationRequirement();
            $regi_require->registration_header_id=$regi_header->id;
            $regi_require->requirement_id=$requirement->id;
            $regi_require->save();
          }
          DB::commit();
          $request->session()->flash('green', 'Registration Successful!');
    	//return response('testa');
    }
}
