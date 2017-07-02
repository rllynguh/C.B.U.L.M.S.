<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;   
use DB;
use Datatables;
use Response;

class userAccountsController extends Controller
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
        $result = User::select([DB::raw("CONCAT(last_name,', ',first_name,' ',IFNULL(middle_name,'')) as strUserName"),'users.*']);
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
          return '<button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float deleteRecord" value= "'.$data->id.'"><i class="mdi-action-delete"></i></button>';
      })
        ->editColumn('is_active', function ($data) {
          $checked = '';
          if($data->is_active==1){
            $checked = 'checked';
        }
        return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->id.'"><span class="lever switch-col-blue"></span>On</label></div>';
    })
        ->editColumn('type', function ($data) {
            $mode='warning';
            $label='Admin';
            if($data->type=='tenant')
            {
                $mode='success';
                $label='Tenant';
            }

            return "<large class='label label-$mode'>$label</large>";
        })
        ->editColumn('last_login', function ($data) {
            if ($data->last_login != null)
                return $data->last_login ? with(new Carbon($data->last_login))->format('M d, Y - h:i A') : '';
            return 'Never Logged In';
        })
        ->editColumn('strUserName', function ($data) {
            $images = url('images/'.$data->picture);
            return "<img src='$images' class='img-circle' alt='data Image' height='40'> $data->last_name, $data->first_name $data->middle_name";
        })
        ->setRowId(function ($data) {
          return $data = 'id'.$data->id;
      })
        ->rawColumns(['is_active','action','type','strUserName'])
        ->make(true);
    }

    public function index()
    {
        //
        return view('maintenance.userAccounts.index');
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
      try
      {
        $result = User::findorfail($id);
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
public function isActive($id)
{
        //
    try
    {
        $result=User::findOrFail($id);
        $value=1;
        if($result->is_active==1)
            $value=0;
        $result->is_active=$value;
        $result->save();
        return Response::json('success');
    }
    catch(\Exception $e)
    {
      return "Deleted";
  }
}
}
