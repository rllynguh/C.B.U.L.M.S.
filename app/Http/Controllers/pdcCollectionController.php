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
        for($request->txtPDC;$request->txtPDC>0;$request->txtPDC--)
        {
            $latest=DB::TABLE("post_dated_checks")
            ->SELECT('code')
            ->ORDERBY('code',"DESC")
            ->FIRST();
            $pk="PDC001";
            if(!is_null($latest))
                $pk=$latest->code;
            $sc= new smartCounter();
            $pk=$sc->increment($pk);  
            $pdc=new PostDatedCheck();
            $pdc->current_contract_id=$request->myId;
            $pdc->code=$pk;
            $pdc->bank_id=$request->bank;
            $pdc->user_id=Auth::user()->id;
            $pdc->amount=$request->amount;
            $pdc->date_accepted=Carbon::now(Config::get('app.timezone'));
            $pdc->save();
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
        $bill_details=DB::table('billing_details')
        ->join('billing_items','billing_details.billing_item_id','billing_items.id')
        ->join('billing_headers','billing_details.billing_header_id','billing_headers.id')
        ->SELECT('price','billing_items.description')
        ->WHERE('billing_items.description','Cusa Fee')
        ->OrWHERE('billing_items.description','Rent')
        ->WHERE('billing_headers.current_contract_id',$id)
        ->get();
        $count=DB::TABLE('post_dated_checks')
        ->SELECT(DB::RAW('12 - (count(distinctrow post_dated_checks.id)) as pdc_count'))
        ->WHERE('current_contract_id',$id)
        ->FIRST();
        $total=0;
        foreach ($bill_details as $key => &$bill_detail) {
            $total+=$bill_detail->price;
            $bill_detail->price="₱ ".number_format($bill_detail->price,2);
        }
        $totalDisplay="₱ ".number_format($total,2);
        $result = array('total' => $total,
            'totalDisplay' => $totalDisplay,
            'max' =>$count->pdc_count,
            'id' => $id
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
