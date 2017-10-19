<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SizeRange;
use Datatables;
use Response;
use DB;

class sizeRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {   
        $result = SizeRange::all();
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return '<button id="btnEdit" type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button> <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float deleteRecord" value= "'.$data->id.'"><i class="mdi-action-delete"></i></button>';
        })
        ->editColumn('is_active', function ($data) {
            $checked = '';
            if($data->is_active==1){
              $checked = 'checked';
          }
          return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->id.'"><span class="lever switch-col-blue"></span>On</label></div>';
      })
        ->editColumn('size_from', function ($data) {
            return number_format($data->size_from,2)." sqm";
        })
        ->editColumn('size_to', function ($data) {
            return number_format($data->size_to,2)." sqm";
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['is_active','action'])
        ->make(true);
    }
    public function index()
    {
        //
        return view('maintenance.sizeRange.index');
    }
    public function softDelete($id)
    {
        $result=SizeRange::find($id);
        if($result->is_active==1)
          $val=0;
      else
          $val=1;
      $result->is_active=$val;
      $result->save(); 
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
            //
       try
       {
        $result=new SizeRange();
        $result->size_from=$request->txtFrom;
        $result->size_to=$request->txtFrom;
        $result->save();
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
      {$result=SizeRange::findOrFail($id);
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
            $result=SizeRange::find($id);
            $result->size_from=$request->txtFrom;
            $result->size_to=$request->txtTo;
            $result->save(); 
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
        $result=SizeRange::destroy($id);
    }
}
