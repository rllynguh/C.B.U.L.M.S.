<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bankmodel;
use Datatables;
use Response;

class bankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {   
     $result = bankModel::where('boolIsDeleted',0);
     return Datatables::of($result)
     ->addColumn('action', function ($data) {
      return '<button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->intBankCode.'"><i class="mdi-editor-border-color"></i></button> <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float deleteRecord" value= "'.$data->intBankCode.'"><i class="mdi-action-delete"></i></button>';
    })
     ->editColumn('boolIsActive', function ($data) {
      $checked = '';
      if($data->boolIsActive==1){
        $checked = 'checked';
      }
      return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->intBankCode.'"><span class="lever switch-col-blue"></span>On</label></div>';
    })
     ->setRowId(function ($data) {
      return $data = 'id'.$data->intBankCode;
    })
     ->rawColumns(['boolIsActive','action'])
     ->make(true);
   }
   public function index()
   {
    return view('maintenance.bank.index');
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
     try
     {
      $result=new bankModel();
      $result->strBankDesc=$request->txtBankDesc;
      $result->save();
      return Response::json("Success Insert");
    }
    catch(\Exception $e) {
      if($e->errorInfo[1]==1062)
        return "This Data Already Exists";
      else if($e->errorInfo[1]==1452)
        return "Already Deleted";
      else
        return var_dump($e->errorInfo[1]);
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
     try
     {$result=bankModel::findOrFail($id);
      return Response::json($result);
    }
    catch(\Exception $e)
    {
      return "Deleted";
    }
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
      try{
        try{
          $result=bankModel::find($id);
          $result->strBankDesc=$request->txtBankDesc;
          $result->save(); 
          return Response::json("success update");
        }catch(\Exception $e){
         if($e->errorInfo[1]==1062)
          return "This Data Already Exists";
        else
          return var_dump($e->errorInfo[1]);
      }
    }catch(\Exception $e){
      return "Deleted";
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
     try
     {
      $result = bankModel::findorfail($id);
      try
      {
        $result->delete();
        return Response::json($result);
      }
      catch(\Exception $e) {
        if($e->errorInfo[1]==1451)
          return Response::json(['true',$result]);
        else
          return Response::json(['true',$result,$e->errorInfo[1]]);
      }
    } 
    catch(\Exception $e) {
      return "Deleted";
    }
  }
  public function softDelete($id)
  {
    $result=bankModel::find($id);
    if($result->boolIsActive==1)
      $val=0;
    else
      $val=1;
    $result->boolIsActive=$val;
    $result->save(); 
  }
}
