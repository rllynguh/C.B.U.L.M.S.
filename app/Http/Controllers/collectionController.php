<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use Response;
use DB;
use App\PaymentHeader;
use App\PaymentDetail;
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
       $bill=DB::table('billing_headers')
       ->join('billing_details','billing_headers.id','billing_details.billing_header_id')
       ->leftJoin('payment_details','billing_details.id','payment_details.billing_detail_id')
       ->havingRaw('SUM(billing_details.price) > SUM(payment_details.payment) or payment_details.billing_detail_id is null')
       ->groupBy('billing_headers.id')
       ->select(DB::Raw('billing_headers.code,CONCAT("₱ ",SUM(billing_details.price)) as balance,CONCAT("₱ ",COALESCE(SUM(payment_details.payment),0.00)) as amount_paid,payment_details.billing_detail_id,billing_headers.id'))
       ->get();

       return Datatables::of($bill)
       ->addColumn('action', function ($data) {
        return '<button id="btnCollection" type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" value="'.route("collection.show",$data->id).'"><i class="mdi-editor-border-color"></i></button>';
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
            if(!is_null($request->payments))
            { 
                $latest=DB::table("payment_headers")
                ->select("id",'code')
                ->orderBy('code',"DESC")
                ->first();
                $pk="COLLECTION001";
                if(!is_null($latest))
                    $pk=$latest->code;
                $sc= new smartCounter();
                $pk=$sc->increment($pk);
                $payment_header=new PaymentHeader();
                $payment_header->bank_id=$request->bank;
                $payment_header->date_issued=Carbon::now(Config::get('app.timezone'));
                $payment_header->date_collected=$request->dateCollected;
                $payment_header->user_id=Auth::user()->id;
                $payment_header->code=$pk;
                $payment_header->save();
                for($x=0;$x<count($request->billings);$x++)
                {
                   if(!is_null($request->payments[$x]))
                   {
                    $payment_detail=new PaymentDetail();
                    $payment_detail->payment_header_id=$payment_header->id;
                    $payment_detail->billing_detail_id=$request->billings[$x];
                    $payment_detail->payment=$request->payments[$x];
                    $payment_detail->save();
                }
            }
        }
        DB::commit();
        return redirect(route('collection.index'));
    }
    catch(\Exception $e)
    {
        DB::rollBack();
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
        $billing_details=DB::table('billing_details')
        ->join('billing_items','billing_details.billing_item_id','billing_items.id')
        ->leftJoin('payment_details','billing_details.id','payment_details.billing_detail_id')
        ->where('billing_header_id',$id)
        ->havingRaw('billing_details.price > COALESCE(SUM(payment_details.payment),0)')
        ->select(DB::raw('billing_details.price - COALESCE(SUM(payment_details.payment),0) as balance,billing_details.id,billing_items.description,billing_details.price '))
        ->groupby('billing_details.id')
        ->get();
        return response::json($billing_details);
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
