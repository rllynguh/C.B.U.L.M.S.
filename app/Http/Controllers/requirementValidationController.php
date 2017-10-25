<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Datatables;
use App\RegistrationRequirement;

class requirementValidationController extends Controller
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
        return view('transaction.requirementValidation.index');
    }


    public function data()
    {
        $result=DB::table('registration_headers')
        ->select(DB::Raw('registration_headers.id,registration_headers.code,tenants.description as tenant,count(registration_requirements.is_fulfilled) as req_total,count(case when registration_requirements.is_fulfilled = 1 then 1 else null end) as fulfilled,count(Distinctrow registration_details.id) as unit_count '))
        ->join('registration_requirements','registration_headers.id','registration_requirements.registration_header_id')
        ->join('tenants','registration_headers.tenant_id','tenants.id')
        ->join('business_types','tenants.business_type_id','business_types.id')
        ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
        ->where('registration_details.is_forfeited','0')
        ->where('registration_details.is_rejected','0')
        ->where('registration_headers.status','1')
        ->groupby('registration_headers.id')
        ->havingRaw('count( registration_requirements.id)>count( Case when registration_requirements.is_fulfilled =1 then 1 else null end )')
        ->get()
        ;   
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return '<button id="btnShowPendingRequirements" type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-content-add"></i></button>';
        })
        ->addColumn('progress', function ($data) {
            $fulfilled=($data->fulfilled/$data->unit_count);
            $total=($data->req_total/$data->unit_count);
            $percentage=($fulfilled/$total)*100;
            return "  <div class='progress'>
            <div class='progress-bar progress-bar-warning progress-bar-striped active' role='progressbar' aria-valuenow='$data->fulfilled' aria-valuemin='0' aria-valuemax='100' style='width: $percentage%;'>
            $fulfilled / $total
            </div>
            </div>";
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        }) 
        ->rawColumns(['action','progress'])
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
   $requirements=DB::table('requirements')
   ->join('registration_requirements','requirements.id','registration_requirements.requirement_id')
   ->where('requirements.is_active',1)
   ->select('registration_requirements.id','requirements.description','is_fulfilled')
   ->where('registration_requirements.registration_header_id',$id)
   ->get();

   return response::json($requirements);
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
    db::begintransaction();
    try
    {
        $requirements=DB::table('registration_requirements')
        ->where('registration_header_id',$id)
        ->select('id')
        ->get();
        if(count($request->checkboxReq)==0)
            $request->checkboxReq=[];
        foreach ($requirements as $requirement) {
            if(in_array($requirement->id, $request->checkboxReq))
            {
                $registration_requirement=RegistrationRequirement::find($requirement->id);
                $registration_requirement->is_fulfilled=1;
            }
            else
            {
                $registration_requirement=RegistrationRequirement::find($requirement->id);
                $registration_requirement->is_fulfilled=0;
            }
            $registration_requirement->save();
        }
        db::commit();
        return response::json('yepp');
        $request->session()->flash('green', 'Requirement Validated.');
    }
    catch(\Exception $e)
    {
       db::rollback();
       return($e);
   }
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

public function showPendingRequirements($id)
{
        //
}
}
