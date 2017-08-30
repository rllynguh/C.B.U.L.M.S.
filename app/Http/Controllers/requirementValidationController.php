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
        ->select(DB::Raw('registration_headers.id,registration_headers.code,tenants.description as tenant,count(registration_requirements.status) as req_total,count(case when registration_requirements.status = 1 then 1 else null end) as fulfilled,count(Case when registration_requirements.pdf is not null then 1 else null end ) as submitted,count(Distinctrow registration_details.id) as unit_count '))
        ->join('registration_requirements','registration_headers.id','registration_requirements.registration_header_id')
        ->join('tenants','registration_headers.tenant_id','tenants.id')
        ->join('business_types','tenants.business_type_id','business_types.id')
        ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
        ->join('offer_sheet_details',
            'registration_details.id',
            'offer_sheet_details.registration_detail_id')
        ->join('offer_sheet_headers',
            'offer_sheet_details.offer_sheet_header_id',
            'offer_sheet_headers.id')
        ->where('registration_details.is_forfeited','0')
        ->where('registration_details.is_rejected','0')
        ->where('offer_sheet_details.status','1')
        ->where('offer_sheet_headers.status','1')
        ->groupby('registration_headers.id')
        ->havingRaw('count(distinctrow registration_details.id) =count(distinctrow offer_sheet_details.id) and count( registration_requirements.id)>count( Case when registration_requirements.status =1 then 1 else null end )')
        ->get()
        ;   
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return '<button id="btnShowPendingRequirements" type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" value="'.route('requirementValidation.showPendingRequirements',$data->id).'"><i class="mdi-content-add"></i></button>';
        })
        ->editColumn('submitted', function ($data) {
            return $data->submitted/$data->unit_count;
        })
        ->editColumn('submitted', function ($data) {
            return $data->submitted/$data->unit_count;
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
    db::begintransaction();
    try
    {
        $registration_requirement=RegistrationRequirement::find($request->myId);
        $registration_requirement->status=$request->decision;
        $registration_requirement->admin_remarks=$request->modal_remarks;
        $registration_requirement->save();
        db::commit();
        $request->session()->flash('green', 'Requirement Validated.');
    }
    catch(\Exception $e)
    {
        db::rollback();
        dd($e);
    }
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
    $registration_requirement=DB::table('registration_requirements')
    ->join('requirements','registration_requirements.requirement_id','requirements.id')
    ->join('registration_headers','registration_requirements.registration_header_id','registration_headers.id')
    ->join('tenants','registration_headers.tenant_id','tenants.id')
    ->where('requirements.is_active',1)
    ->where('registration_requirements.id',$id)
    ->select(DB::Raw('pdf,requirements.description as requirement,tenants.description as tenant,registration_headers.code'))
    ->first()
    ;
    $pdf="docs/$registration_requirement->pdf";
    return view('transaction.requirementValidation.show')
    ->withPdf($pdf)
    ->withId($id)
    ->withRequirement($registration_requirement)
    ;
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

public function showPendingRequirements($id)
{
        //
    $requirements=DB::table('requirements')
    ->join('registration_requirements','requirements.id','registration_requirements.requirement_id')
    ->where('requirements.is_active',1)
    ->select('registration_requirements.id','requirements.description')
    ->where('registration_requirements.registration_header_id',$id)
    ->where('registration_requirements.status','!=',1)
    ->where('registration_requirements.pdf','!=',null)
    ->get();

    return response::json($requirements);
}
}
