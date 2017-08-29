<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use Response;
use DB;
use App\Payment;
use Carbon\Carbon;
use Config;
use Auth;

class collectionController extends Controller
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
        $banks=DB::table('banks')
        ->where('banks.is_active',1)
        ->select('id','description')
        ->pluck('description','id');

        return view('transaction.collection.index')
        ->withBanks($banks);
    }
    public function data()
    {
        $bill=db::table('billing_headers')
        ->leftjoin('payments','billing_headers.id','payments.billing_header_id')
        ->havingRaw('cost>coalesce(sum(payments.payment),0)')
        ->groupby('billing_headers.id')
        ->select(db::raw('billing_headers.code,billing_headers.id,cost,coalesce(sum(payments.payment),0) as amount_paid'))
        ->get();

        return Datatables::of($bill)
        ->addColumn('action', function ($data) {
            return '<button id="btnCollection" type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button>';
        })
        ->editColumn('cost',function ($data) {
            return $data = '₱ '.$data->cost;
        })
        ->editColumn('amount_paid',function ($data) {
            return $data = '₱ '.$data->amount_paid;
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['is_active','action'])
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
        DB::begintransaction();
        //
        try{

          $latest=DB::table("payments")
          ->select('code')
          ->orderBy('code',"DESC")
          ->first();
          $pk="COLLECTION001";
          if(!is_null($latest))
            $pk=$latest->code;
        $sc= new smartCounter();
        $pk=$sc->increment($pk);
        $payment=new Payment();
        $payment->billing_header_id=$request->myId;
        $payment->bank_id=$request->bank;
        $payment->code=$pk;
        $payment->date_issued=Carbon::now(Config::get('app.timezone'));
        $payment->date_collected=$request->dateCollected;
        $payment->user_id=Auth::user()->id;
        $payment->payment=$request->txtAmount;
        $payment->save();

        DB::commit();
    }
    catch(\Exception $e)
    {
        return response::json($e);
        DB::rollBack();
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
        $bill_items=DB::table('billing_headers')
        ->join('billing_details','billing_headers.id','billing_details.billing_header_id')
        ->join('billing_items','billing_details.billing_item_id','billing_items.id')
        ->select('billing_items.description','billing_details.price')
        ->where('billing_headers.id',$id)
        ->get()
        ;
        $summary=db::table('billing_headers')
        ->leftjoin('payments','billing_headers.id','payments.billing_header_id')
        ->select(DB::raw('cost,cost - coalesce(sum(payment),0) as balance'))
        ->where('billing_headers.id',$id)
        ->first();
        return response::json([$bill_items,$summary]);
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
