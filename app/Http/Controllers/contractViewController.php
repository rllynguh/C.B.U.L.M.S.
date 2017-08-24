<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Datatables;
use DB;
use Auth;
use PDF;

class contractViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

     return view('transaction.contractView.index');
 }
 public function data()
 {
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
        return "<a href=".route('contract.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>";
    })
    ->setRowId(function ($data) {
        return $data = 'id'.$data->id;
    })
    ->rawColumns(['action'])
    ->make(true);
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
    $contract=db::table('current_contracts')
    ->join('users','current_contracts.user_id','users.id')
    ->join('contract_headers','current_contracts.contract_header_id','contract_headers.id')
    ->where('current_contracts.id',$id)
    ->select(DB::raw('date_issued,start_of_contract,end_of_contract, Concat(first_name," ",last_name) as full_name,code'))
    ->first();
    $units=db::table('units')
    ->join('contract_details','units.id','contract_details.unit_id')
    ->where('current_contract_id',$id)
    ->select(DB::raw('code,price * size as price'))
    ->get();
    $billing_details=DB::table('billing_details')
    ->join('billing_headers','billing_details.billing_header_id','billing_headers.id')
    ->where('billing_headers.current_contract_id',$id)
    ->select('description','price')
    ->get()
    ;
    $pdf = PDF::loadView('transaction.contractView.show',compact('contract', 'units','billing_details'));
    return $pdf->stream();
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
}
