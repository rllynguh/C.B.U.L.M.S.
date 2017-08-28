<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Datatables;
use DB;
use Auth;
use PDF;
use App\CurrentContract;

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
    ->where('current_contracts.status',0)
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
    db::begintransaction();
    try
    {
        $id=$request->myId;
        if(!is_null($request->aggree))
        {
            $current_contract=CurrentContract::find($id);
            $current_contract->status=1;
            $current_contract->save();
        }
        db::commit();
        $request->session()->flash('green', 'Contract accepted.');
        return redirect(route('contract.index'));
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
    $current_contract=DB::table('current_contracts')
    ->select(DB::raw('current_contracts.id,pdf,code,CONCAT(first_name," " ,last_name) as lessor,date_issued'))
    ->join('users','user_id','users.id')
    ->join('contract_headers','current_contracts.contract_header_id','contract_headers.id')
    ->where('current_contracts.id',$id)
    ->first()
    ;
    return view('transaction.contractView.show')
    ->withCurrentcontract($current_contract);
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
