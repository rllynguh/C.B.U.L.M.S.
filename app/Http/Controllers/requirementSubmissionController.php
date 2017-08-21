<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Datatables;
use DB;
use Response;
use App\RegistrationRequirement;

class requirementSubmissionController extends Controller
{
    public function __construct()
    {
      $this->middleware('tenant');
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
        return view('transaction.requirementSubmission.index');
    }

    public function data()
    {
        $result=DB::table('registration_headers')
        ->select(DB::Raw('registration_headers.id,registration_headers.code,business_types.description as business,count(Distinctrow registration_details.id) as unit_count ,CONCAT(lessor_user.first_name," ",lessor_user.last_name) as name,count(case when registration_requirements.status != 1 and distinct registration_requirements.id  then 1 else null end) as pending_items,count(distinctrow Case when registration_requirements.status = 1 then 1 else null end ) as fulfiilled, count(distinctrow Case when registration_requirements.status != 1 then 1 else null end ) as unfulfillesd,offer_sheet_details.status'))
        ->join('users as lessor_user','registration_headers.user_id','lessor_user.id')
        ->join('tenants','registration_headers.tenant_id','tenants.id')
        ->join('users as tenant_user','tenants.user_id','tenant_user.id')
        ->join('business_types','tenants.business_type_id','business_types.id')
        ->join('registration_requirements','registration_headers.id','registration_requirements.registration_header_id')
        ->join('requirements','registration_requirements.requirement_id','requirements.id')
        ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
        ->join('offer_sheet_details',
            'registration_details.id',
            'offer_sheet_details.registration_detail_id')
        ->join('offer_sheet_headers',
            'offer_sheet_details.offer_sheet_header_id',
            'offer_sheet_headers.id')
        ->where('requirements.is_active',1)
        ->where('tenant_user.id',Auth::user()->id)
        ->where('registration_details.is_forfeited','0')
        ->where('registration_details.is_rejected','0')
        ->where('offer_sheet_details.status','1')
        ->where('offer_sheet_headers.status','1')
        ->groupby('registration_headers.id')
        ->havingRaw('count(Distinctrow registration_details.id) =count(Distinctrow offer_sheet_details.id) and count(registration_requirements.id) > count(  Case when registration_requirements.status =1 then 1 else null end ) and offer_sheet_details.status = 1')
        ->get()
        ;   
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return '<button id="btnShowRequirements" class="btn bg-green btn-circle waves-effect waves-circle waves-float" value= "'.route('requirementSubmission.showRequirements',$data->id).'"><i class="mdi-action-visibility"></i></button>
            <button id="btnShowPendingRequirements" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" value= "'.$data->id.'"><i class="mdi-content-add"></i></button>'
            ;
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

        for($x=0;$x<count($request->requirements);$x++)
        {
            if ($request->file("pdf$x")!='')
            {
                $pdf = $request->file("pdf$x");
                $pdfname = md5(Auth::user()->email. time()).'.'.$pdf->getClientOriginalExtension();
                $pdf->move(base_path().'/public/docs/', $pdfname);
                $registration_requirements=
                RegistrationRequirement::find($request->requirements[$x]);
                $registration_requirements->pdf = $pdfname;
                $registration_requirements->save();
            }
        }
        return response::json('success');

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
        //
        $requirements=DB::table('requirements')
        ->join('registration_requirements','requirements.id','registration_requirements.requirement_id')
        ->select('requirements.description','registration_requirements.status')
        ->where('requirements.is_active',1)
        ->where('registration_requirements.registration_header_id',$id)
        ->get();
        return response::json($requirements);
    }

    public function showPendingRequirements($id)
    {
        //
        $requirements=DB::table('requirements')
        ->join('registration_requirements','requirements.id','registration_requirements.requirement_id')
        ->select('registration_requirements.id','requirements.description','registration_requirements.status')
        ->where('requirements.is_active',1)
        ->where('registration_requirements.status','!=',1)
        ->where('registration_requirements.registration_header_id',$id)
        ->get();
        return response::json($requirements);
    }
}
