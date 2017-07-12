<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RepresentativePosition;
use Datatables;
use Response;
class representativePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }
    public function data()
    {
        $result=RepresentativePosition::orderby('description');
        return Datatables::of($result)
        ->addColumn('action',function($data)
        {
            return '<button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button> <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float deleteRecord" value= "'.$data->id.'"><i class="mdi-action-delete"></i></button>';
        })
        ->editColumn('is_active',function($data)
        {
           $checked = '';
           if($data->is_active==1){
              $checked = 'checked';
          }
          return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->id.'"><span class="lever switch-col-blue"></span>On</label></div>';
      })
        ->setRowId(function($data)
        {
            return $data='id'.$data->id;
        })
        ->rawColumns(['action','is_active'])
        ->make(true);


    }
    public function index()
    {
        //
        return view('maintenance.representativePosition.index');
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
            $record= new RepresentativePosition;
            $record->description=$request->txtDesc;
            $record->save();
            return response::json('success');
        }
        catch(\Exception $e)
        {
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
        try{
            $result=RepresentativePosition::findorFail($id);
            return response::json($result);
        }
        catch(\Exception $e)
        {
            return 'Deleted';
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
        try
        {
            try
            {
                $result=RepresentativePosition::findorFail($id);
                $result->description=$request->txtDesc;
                $result->save();
                return response::json($result);
            }
            catch(\Exception $e)
            {
             if($e->errorInfo[1]==1062)
              return "This Data Already Exists";
          else
              return var_dump($e->errorInfo[1]);
      }
  }
  catch(\Exception $e)
  {
    return 'Deleted';
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
            $result=RepresentativePosition::FindOrFail($id);
            try
            {
                $result->delete();
                return response('Delete successful');
            }
            catch(\Exception $e)
            {
               if($e->errorInfo[1]==1451)
                  return Response::json(['true',$result]);
              else
                  return Response::json(['true',$result,$e->errorInfo[1]]);
          }
      }
      catch(\Exception $e)
      {
        return "Deleted";
    }
}

public function softDelete($id)
{
    $result=RepresentativePosition::findorFail($id);
    $value=1;
    if($result->is_active==1)
        $value=0;
    $result->is_active=$value;
    $result->save();
}
}
