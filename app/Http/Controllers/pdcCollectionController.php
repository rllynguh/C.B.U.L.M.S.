<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Response;
use App\Bank;
use App\PostDatedCheck;
use Auth;
use Config;
use Carbon\Carbon;

class pdcCollectionController extends Controller
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
        $banks=bank::WHERE('is_active','=','1')
        ->SELECT('description','id')
        ->ORDERBY('description')
        ->PLUCK('description','id');
        return VIEW('transaction.pdcCollection.index')
        ->withBanks($banks)
        ;
    }
    public function data()
    {
        $results=DB::TABLE('current_contracts')
        ->LEFTJOIN('post_dated_checks','current_contracts.id','post_dated_checks.current_contract_id')
        ->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
        ->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
        ->JOIN('tenants','registration_headers.tenant_id','tenants.id')
        ->SELECT('current_contracts.id','contract_headers.code','tenants.description','current_contracts.date_issued',DB::RAW('COUNT(distinctrow post_dated_checks.id) as pdc_count'))
        ->HAVINGRAW('COUNT(distinctrow post_dated_checks.id) < 12')
        ->WHERE('current_contracts.status',1)
        ->GROUPBY('current_contracts.id')
        ->GET();
        return Datatables::of($results)
        ->ADDCOLUMN('action', function ($data) {
            return '<button id="btnPdc" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float" value= "'.route('pdcCollection.show',$data->id).'"><i class="mdi-action-visibility"></i></button>';
        })
        ->SETROWID(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->EDITCOLUMN('date_issued',function($data)
        {
            $time = strtotime($data->date_issued);
            return $myDate = date( 'M d,Y', $time );
        })
        ->ADDCOLUMN('progress', function ($data) {
            $total=12; //total count of pdc
            $percentage=($data->pdc_count/$total)*100;
            return "  <div class='progress'>
            <div class='progress-bar progress-bar-warning progress-bar-striped active' role='progressbar' aria-valuenow='$data->pdc_count' aria-valuemin='0' aria-valuemax='100' style='width: $percentage%;'>
            <center>$data->pdc_count / $total</center>
            </div>
            </div>";
        })
        ->rawColumns(['action','progress'])
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
     $count=DB::TABLE('post_dated_checks')
     ->SELECT(DB::RAW('(count(distinctrow post_dated_checks.id)) as pdc_count'))
     ->WHERE('current_contract_id',$request->myId)
     ->FIRST()->pdc_count;
     $bill_date=DB::TABLE('current_contracts')
     ->SELECT(DB::RAW('date_of_billing'))
     ->WHERE('id',$request->myId)
     ->FIRST()->date_of_billing;
     $pk="";
     for($x=0;$x<$request->txtPDC;$x++)
     {
        if($x==0)
            $pk=$request->txtCode;
        else
        {
            $latest=DB::TABLE("post_dated_checks")
            ->SELECT('code')
            ->ORDERBY('code',"DESC")
            ->where('current_contract_id',$request->myId)
            ->FIRST();
            if($pk=="")
                $pk='0-120-12-1';
            $sc= new smartCounter();
            $pk=$sc->increment($pk);  
        }
        $pdc=new PostDatedCheck();
        $pdc->current_contract_id=$request->myId;
        $pdc->code=$pk;
        $pdc->bank_id=$request->bank;
        $pdc->user_id=Auth::user()->id;
        $pdc->for_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($bill_date)) . " + ".($x+$count)." month"));
        $pdc->amount=$request->amount;
        $pdc->date_accepted=Carbon::now(Config::get('app.timezone'));
        $pdc->save();
    }
    $pdc=DB::table('post_dated_checks')
    ->join('banks','post_dated_checks.bank_id','banks.id')
    ->select('post_dated_checks.id','date_accepted','for_date','code','banks.description as bank')
    ->where('current_contract_id',$request->myId)
    ->get();
    $amount=DB::table('post_dated_checks')
    ->select('amount')
    ->where('current_contract_id',$request->myId)
    ->first()->amount;
    $amount="₱ ".number_format($amount,2);
    return response::json([$pdc,$amount]);
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
        $bill_details=DB::table('billing_details')
        ->join('billing_items','billing_details.billing_item_id','billing_items.id')
        ->join('billing_headers','billing_details.billing_header_id','billing_headers.id')
        ->SELECT('price','billing_items.description')
        ->WHERERAW("billing_headers.current_contract_id=$id and (billing_items.description='Cusa Fee' or billing_items.description = 'Rent')")
        ->get();
        $count=DB::TABLE('post_dated_checks')
        ->SELECT(DB::RAW('12 - (count(distinctrow post_dated_checks.id)) as pdc_count'))
        ->WHERE('current_contract_id',$id)
        ->FIRST();
        $latestPDC=DB::TABLE('post_dated_checks')
        ->SELECT('code')
        ->ORDERBY('id','desc')
        ->FIRST()
        ;
        if(!is_null($latestPDC))
        {
            $sc= new smartCounter();
            $code=$sc->increment($latestPDC->code);  
        }
        else
            $code='0-120-12-1';
        $total=0;
        foreach ($bill_details as $key => &$bill_detail) {
            $total+=$bill_detail->price;
            $bill_detail->price="₱ ".number_format($bill_detail->price,2);
        }
        $totalDisplay="₱ ".number_format($total,2);
        $result = array('total' => $total,
            'totalDisplay' => $totalDisplay,
            'max' =>$count->pdc_count,
            'id' => $id,
            'code'=> $code
        );
        return response::json([$bill_details,$result]);
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
            foreach ($request->codes as $key => $code) {
                $pdc=PostDatedCheck::FINDORFAIL($request->ids[$key]);
                $pdc->code=$code;
                $pdc->save();
            }
        }
        public function updatePDC(Request $request)
        {
        //
            foreach ($request->codes as $key => $code) {
                $pdc=PostDatedCheck::FINDORFAIL($request->ids[$key]);
                $pdc->code=$code;
                $pdc->save();
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
        }
    }
