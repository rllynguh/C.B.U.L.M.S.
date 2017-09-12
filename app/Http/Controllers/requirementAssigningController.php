<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Datatables;
use App\RegistrationRequirement;

class requirementAssigningController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('transaction.requirementAssigning.index');
    }

    public function data()
    {
        $result=DB::table('registration_headers')
        ->select(DB::Raw('registration_headers.id,registration_headers.code,tenants.description as tenant,business_types.description as business,count(distinctrow registration_details.id) as unit_count'))
        ->join('tenants','registration_headers.tenant_id','tenants.id')
        ->join('business_types','tenants.business_type_id','business_types.id')
        ->leftjoin('registration_details','registration_headers.id','registration_details.registration_header_id')
        ->leftjoin('offer_sheet_details',
            'registration_details.id',
            'offer_sheet_details.registration_detail_id')
        ->leftjoin('registration_requirements','registration_headers.id','registration_requirements.registration_header_id')
        ->where('registration_details.is_forfeited','0')
        ->where('registration_details.is_rejected','0')
        ->groupby('registration_headers.id')
        ->havingRaw('count(distinctrow registration_details.id) =count(distinctrow offer_sheet_details.id) and count( registration_requirements.id)>count( Case when registration_requirements.is_fulfilled =1 then 1 else null end )')
        ->get()
        ;   
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return '<button id="btnAddRequirement" type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-content-add"></i></button>
            <button id="btnEditRequirement" type="button" class="btn bg-brown btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button>';
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        }) 
        ->rawColumns(['action'])
        ->make(true)
        ;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showRequirements($id)
    {
        $requirements=DB::table('requirements')
        ->where('requirements.is_active',1)
        ->whereRaw("requirements.id not in (Select requirement_id from registration_requirements where registration_header_id=$id)")
        ->select('requirements.id','requirements.description')
        ->get();
        return response::json($requirements);

    }

    public function showCurrentRequirements($id)
    {
        $requirements=DB::table('registration_requirements')
        ->join('requirements','registration_requirements.requirement_id','requirements.id')
        ->leftjoin('business_type_requirements','registration_requirements.requirement_id','business_type_requirements.requirement_id')
        ->select('registration_requirements.id','requirements.description','business_type_requirements.id as busi_type_id')
        ->where('registration_requirements.registration_header_id',$id)
        ->get();
        return response::json($requirements);
    }
    public function storeRequirements(Request $request)
    {
        if(!is_null($request->checkboxReq))
        { 
            foreach($request->checkboxReq as $requirement)
            {
                $registration_requirement=new RegistrationRequirement();
                $registration_requirement->registration_header_id=$request->idReg;
                $registration_requirement->requirement_id=$requirement;
                $registration_requirement->save();
            }
            return response::json('yes');
        }
    }
    public function updateRequirements(Request $request)
    {
        $busi_type=DB::table('business_types')
        ->select('business_types.id')
        ->join('tenants','business_types.id','tenants.business_type_id')
        ->join('registration_headers','tenants.id','registration_headers.tenant_id')
        ->where('registration_headers.id',$request->idReg)
        ->first();
        $requirements=DB::table('registration_requirements')
        ->select('registration_requirements.id')
        ->where('registration_header_id',$request->idReg)
        ->join('requirements','registration_requirements.requirement_id','requirements.id')
        ->where('requirements.is_active',1)
        ->whereRaw("requirements.id not in (Select requirement_id from business_type_requirements where business_type_id=$busi_type->id)")
        ->get();
        if(count($request->checkboxReq)==0)
            $request->checkboxReq=[];
        foreach ($requirements as $requirement) {
            # code...
            if(!in_array($requirement->id,$request->checkboxReq))
            {
                $registration_requirement=RegistrationRequirement::find($requirement->id);
                $registration_requirement->delete();
            }
        }
    }
}
