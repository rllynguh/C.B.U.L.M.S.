<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Response;
use App\UserBalance;
use Carbon\Carbon;
use Config;

class myAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('tenant');
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $balance=DB::TABLE('user_balances')
        ->WHERE('user_id',Auth::user()->id)
        ->ORDERBY('date_as_of','desc')
        ->SELECT('balance','balance as formatted_balance')
        ->FIRST();
        if(is_null($balance) ||$balance->balance==0)
            $balance = (object)['balance' => 0, 'formatted_balance' => 'You currently have 0 remaining balance'];
        else
            $balance->formatted_balance="PHP ".number_format($balance->formatted_balance,2);
        return view('transaction.myAccount.index')->withBalance($balance);
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
        $currentValue=$request->txtBalance-$request->txtAmount;
        $user_balance=new UserBalance;
        $user_balance->user_id=Auth::user()->id;
        $user_balance->date_as_of=Carbon::now(Config::get('app.timezone'));
        $user_balance->balance=$currentValue;
        $user_balance->save();
        if($currentValue<=0){
            $currentValue = (object)['balance' => 0, 'formatted_balance' => 'You currently have 0 remaining balance'];
        }
        else{
            $currentValue="PHP ".number_format($currentValue,2);
        }
        return response::json(['value'=>$currentValue]);
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
}
