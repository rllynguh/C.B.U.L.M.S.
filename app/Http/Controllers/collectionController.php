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
use PDF;
use App\UserBalance;
use App\PostDatedCheck;
use App\FundTransfer;
use App\DatedCheck;
use App\Notification;
use App\BillingHeader;
use App\BillingDetail;
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
        return view('transaction.collection.index');
    }
    public function data()
    {
        $bills=db::table('billing_headers')
        ->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
        ->where('current_contracts.status',1)
        ->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
        ->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
        ->JOIN('tenants','registration_headers.tenant_id','tenants.id')
        ->LEFTJOIN('payments','billing_headers.id','payments.billing_header_id')
        ->GROUPBY('billing_headers.id')
        ->HAVINGRAW('cost>coalesce(sum(payments.payment),0)')
        ->WHERERAW('MONTH(billing_headers.date_issued) <= MONTH(CURRENT_DATE()) AND YEAR(billing_headers.date_issued) = YEAR(CURRENT_DATE())')
        ->select(db::raw('billing_headers.code,billing_headers.id,cost,coalesce(sum(payments.payment),0) as amount_paid,tenants.description'))
        ->get();

        return Datatables::of($bills)
        ->addColumn('action', function ($data) {
            return '<button id="btnCollection'.$data->id.'" type="button" class="btnCollection btn bg-blue btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button>';
        })
        ->editColumn('cost',function ($data) {
            return $data = '₱ '.number_format($data->cost,2);
        })
        ->editColumn('amount_paid',function ($data) {
            return $data = '₱ '.number_format($data->amount_paid,2);
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
        // DB::begintransaction();
        //
        // try{
        $billing_details=DB::table('billing_details')
        ->where('billing_header_id',$request->myId)
        ->join('billing_items','billing_details.billing_item_id','billing_items.id')
        ->select('billing_items.description','price')
        ->get();


        $full_name=Auth::user()->first_name." ".Auth::user()->last_name;

        $summary=DB::TABLE('billing_headers')
        ->leftjoin('payments','billing_headers.id','payments.billing_header_id')
        ->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
        ->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
        ->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
        ->JOIN('tenants','registration_headers.tenant_id','tenants.id')
        ->JOIN('users','tenants.user_id','users.id')
        ->JOIN('representatives','representatives.user_id','users.id')
        ->JOIN('representative_positions','representatives.representative_position_id','representative_positions.id')
        ->SELECT('billing_headers.date_issued','tenants.description as tenant','representative_positions.description as position','contract_headers.code as contract','users.id as user_id','billing_headers.code as billing','billing_headers.cost', DB::RAW('CONCAT(first_name," ",last_name) as representative,cost,(cost - COALESCE(sum(payment),0)) as balance, COALESCE(sum(payment),0) as payment'))
        ->FIRST()
        ;
        $summary->date_issued=new Carbon($summary->date_issued);
        $summary->date_issued=$summary->date_issued->toFormattedDateString();

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
        $payment->mode=$request->mode;
        $payment->code=$pk;
        $payment->date_issued=Carbon::now(Config::get('app.timezone'));
        $payment->date_collected=$request->dateCollected;
        $payment->user_id=$summary->user_id;//here
        $payment->payment=$request->txtAmount;
        $payment->save();

        $summary->mode="Cash";
        $summary->bank=null;
        $summary->mode_code=null;
        

        if($request->mode==1) //if paid via pdc
        {
            $pdc=PostDatedCheck::FINDORFAIL($request->pdc_id);
            $pdc->is_accepted=1;
            $pdc->payment_id=$payment->id;
            $pdc->save();
            $summary->mode="POST-DATED CHECK";
            $summary->mode_code=$pdc->code;
        }
          if($request->mode==2) //if paid via fund transfer
          {
            $fund_transfer=new FundTransfer();
            $fund_transfer->bank_id=$request->bank;
            $fund_transfer->payment_id=$payment->id;
            $fund_transfer->save();
            $bank=DB::TABLE('banks')
            ->JOIN('fund_transfers','banks.id','fund_transfers.bank_id')
            ->WHERE('fund_transfers.id',$fund_transfer->id)
            ->SELECT('description')
            ->FIRST()->description;
            $summary->mode="Fund Transfer";
            $summary->bank=$bank;
        }
          if($request->mode==3) //if paid via dated check
          {
            $dated_check=new DatedCheck();
            $dated_check->bank_id=$request->bank;
            $dated_check->payment_id=$payment->id;
            $dated_check->save();
            $bank=DB::TABLE('banks')
            ->JOIN('dated_checks','banks.id','dated_checks.bank_id')
            ->WHERE('dated_checks.id',$dated_check->id)
            ->SELECT('description')
            ->FIRST()->description;
            $summary->mode="Dated Check";
            $summary->bank=$bank;
        }

        $user_id=DB::TABLE('billing_headers')
        ->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
        ->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
        ->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
        ->JOIN('tenants','registration_headers.tenant_id','tenants.id')
        ->SELECT('tenants.user_id')
        ->FIRST()->user_id;
        $pdf = PDF::loadView('transaction.collection.pdf',compact('billing_details', 'summary','payment','full_name'));
        $date_issued=date_format($payment->date_issued,"Y-m-d");
        $pdfName="$payment->code($date_issued).pdf";
        $location=public_path("docs/$pdfName");
        $pdf->save($location);
        $payment->pdf=$pdfName;
        $payment->save();

        $notification=new Notification;
        $notification->user_id=$user_id;
        $notification->title="$payment->code has been added to your receipts.";
        $notification->description="A receipt has been generated for your account";
        $notification->link=route('docs.collection-receipt',$payment->id);
        $notification->date_issued=Carbon::now();
        $notification->save();
        DB::commit();
    // }
    // catch(\Exception $e)
    // {
    //     DB::rollBack();
    //     return response::json($e);
    // }
        return response::json(number_format($request->change,2));
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
        //validate if bill item has rent and cusa in it to be sure that it can be paid with pdc
        $forPDC=false;
        foreach ($bill_items as &$bill_item) {
            # code...
            if($bill_item->description=='Rent')
                $forPDC=true;
            $bill_item->price=number_format($bill_item->price,2);
        }

// query to check if the user still has pdc
        $pdc=DB::TABLE('post_dated_checks')
        ->JOIN('current_contracts','post_dated_checks.current_contract_id','current_contracts.id')
        ->JOIN('billing_headers','current_contracts.id','billing_headers.current_contract_id')
        ->WHERE('billing_headers.id',$id)
        ->WHERE('is_accepted',0)
        ->WHERE('post_dated_checks.status',1)
        ->WHERERAW('MONTH(for_date)=MONTH(CURRENT_DATE()) AND YEAR(for_date)=YEAR(CURRENT_DATE())')
        ->SELECT('post_dated_checks.code','post_dated_checks.id','amount')
        ->FIRST();


        $for_fund_transfer=DB::TABLE('post_dated_checks')
        ->JOIN('current_contracts','post_dated_checks.current_contract_id','current_contracts.id')
        ->JOIN('billing_headers','current_contracts.id','billing_headers.current_contract_id')
        ->WHERE('billing_headers.id',$id)
        ->WHERE('is_accepted',0)
        ->WHERERAW('MONTH(for_date)=MONTH(CURRENT_DATE()) AND YEAR(for_date)=YEAR(CURRENT_DATE())')
        ->WHERE('post_dated_checks.status',2)
        ->SELECT('post_dated_checks.code','post_dated_checks.id','amount')
        ->FIRST();
        if(is_null($for_fund_transfer))
            $for_fund_transfer=false;
        else
            $for_fund_transfer=true;


        $summary=db::table('billing_headers')
        ->join('current_contracts','billing_headers.current_contract_id','current_contracts.id')
        ->join('contract_headers','current_contracts.contract_header_id','contract_headers.id')
        ->join('registration_headers','contract_headers.registration_header_id','registration_headers.id')
        ->join('tenants','registration_headers.tenant_id','tenants.id')
        ->leftjoin('payments','billing_headers.id','payments.billing_header_id')
        ->select(DB::raw('cost,cost - coalesce(sum(payment),0) as balance,tenants.user_id'))
        ->where('billing_headers.id',$id)
        ->first();
        $summary->cost=number_format($summary->cost,2); //for formating to peso sign
        $summary->forPDC=$forPDC;
        $summary->for_fund_transfer=$for_fund_transfer;
        if(!is_null($pdc)) //check if the user still has pdc
        {
            $summary->pdc_amount=$pdc->amount;
            $summary->pdc_id=$pdc->id;
            $summary->pdc_code=$pdc->code;
        }
        $balance=number_format($summary->balance,2);
        return response::json([$bill_items,$summary,$balance]);
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
        //my shit
        $latest=DB::table("billing_headers")
        ->select("billing_headers.*")
        ->orderBy('code',"DESC")
        ->first();
        $code="BILL001";
        if(!is_null($latest))
        $code=$latest->code;
        $sc= new smartCounter();
        $code=$sc->increment($code);

        $billheader = new BillingHeader;
        $billheader->code = $code;
        $billheader->cost = -$request->balance;
        $billheader->user_id = $request->user;
        $billheader->date_issued =Carbon::now(Config::get('app.timezone'));
        $billheader->save();

        $billing_detail=new BillingDetail();
        $billing_detail->billing_header_id=$billheader->id;
        $billing_detail->billing_item_id=11;
        $billing_detail->description='Tenant Deposit';
        $billing_detail->price=-$request->balance;
        $billing_detail->save();


        $latest=DB::table("payments")
        ->select("payments.*")
        ->orderBy('code',"DESC")
        ->first();
        $code="COLLECTION001";
        if(!is_null($latest))
        $code=$latest->code;
        $sc= new smartCounter();
        $code=$sc->increment($code);

        $payment = new Payment;
        $payment->code = $code;
        $payment->billing_header_id = $billheader->id;
        $payment->mode = 0;
        $payment->date_issued = Carbon::now(Config::get('app.timezone'));
        $payment->date_collected = Carbon::now(Config::get('app.timezone'));
        $payment->user_id = $request->user;
        $payment->payment = -$request->balance;
        $payment->save();

        //for handling balances
        $current_balance=DB::TABLE('user_balances')
        ->SELECT('balance')
        ->WHERE('user_id',$request->user)
        ->ORDERBY('id','desc')
        ->FIRST();
        if(!IS_NULL($current_balance))
            $prev_balance=$current_balance->balance;
        else
            $prev_balance=0;
        $final_balance=$prev_balance+$request->balance;
        $balance=new UserBalance;
        $balance->user_id=$request->user;
        $balance->date_as_of=Carbon::now(Config::get('app.timezone'));
        $balance->balance=$final_balance;
        $balance->payment_id= $payment->id;
        $balance->save();
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
