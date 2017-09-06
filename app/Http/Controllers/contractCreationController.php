<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;
use Datatables;
use App\ContractContent;
use App\ContractHeader;
use App\ContractDetail;
use App\CurrentContract;
use App\BillingDetail;
use App\BillingHeader;
use Auth;
use Carbon\Carbon;
use Config;
use PDF;

class contractCreationController extends Controller
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
      $result=DB::table('registration_headers')
      ->select(DB::Raw('registration_headers.id,registration_headers.code,tenants.description as tenant,business_types.description as business,count(distinct registration_details.id) as unit_count'))
      ->join('tenants','registration_headers.tenant_id','tenants.id')
      ->join('business_types','tenants.business_type_id','business_types.id')
      ->join('registration_requirements','registration_headers.id','registration_requirements.registration_header_id')
      ->leftjoin('registration_details','registration_headers.id','registration_details.registration_header_id')
      ->leftjoin('offer_sheet_details',
        'registration_details.id',
        'offer_sheet_details.registration_detail_id')
      ->where('registration_details.is_forfeited','0')
      ->where('registration_details.is_rejected','0')
      ->whereRaw('registration_headers.id not in (Select registration_header_id from contract_headers)')
      ->groupby('registration_headers.id')
      ->havingRaw('count(registration_details.id) =count(case when offer_sheet_details.status = 1 then 1 else null end)')
      ->havingRaw('count( registration_requirements.id)=count( Case when registration_requirements.status =1 then 1 else null end )')
      ->get()
      ;   
      return Datatables::of($result)
      ->addColumn('action', function ($data) {
        return "<a href=".route('contract-create.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>";
    })
      ->setRowId(function ($data) {
        return $data = 'id'.$data->id;
    }) 
      ->rawColumns(['action'])
      ->make(true)
      ;
  }
  public function index()
  {
        //
      return view('transaction.contractCreation.index');
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
      DB::begintransaction();
      try
      {
        $latest=DB::table("contract_headers")
        ->select("contract_headers.*")
        ->orderBy('code',"DESC")
        ->first();
        $code="CONTRACT";     if(!is_null($latest))
        $code=$latest->code;
        $sc= new smartCounter();
        $code=$sc->increment($code);
        $utilities=DB::table('utilities')
        ->whereRaw('date_as_of=(Select Max(date_as_of) from utilities)')
        ->select('utilities.*')
        ->first();

        $contract_header=new ContractHeader();
        $contract_header->registration_header_id=$request->regi_id;
        $contract_header->code=$code;
        $contract_header->escalation_rate=$utilities->escalation_rate;
        $contract_header->save();
        $full_name=Auth::user()->first_name." ".Auth::user()->last_name;

        $date_end = date("Y-m-d", strtotime(date("Y-m-d", strtotime($request->startDate)) . " + $request->txtDuration year"));
            //+ years

        $current_contract=new CurrentContract();
        $current_contract->contract_header_id=$contract_header->id;
        $current_contract->user_id=Auth::user()->id;
        $current_contract->date_issued=Carbon::now(Config::get('app.timezone'));
        $current_contract->start_of_contract=$request->startDate;
        $current_contract->date_of_billing=$request->billingDate;
        $current_contract->end_of_contract=$date_end;
        $current_contract->save();

        $units=DB::table('units')
        ->join('offer_sheet_details','units.id','offer_sheet_details.unit_id')
        ->join('registration_details','offer_sheet_details.registration_detail_id','registration_details.id')
        ->where('registration_header_id',$request->regi_id)
        ->join('unit_prices','units.id','unit_prices.unit_id')
        ->whereRaw('date_as_of=(SELECT Max(date_as_of) from unit_prices where unit_id=units.id)')
        ->select('units.id','price')
        ->where('offer_sheet_details.status',1)
        ->where('registration_details.is_forfeited',0)
        ->where('registration_details.is_rejected',0)
        ->get();
        foreach ($units as $unit) {
          $contract_detail=new ContractDetail();
          $contract_detail->current_contract_id=$current_contract->id;
          $contract_detail->unit_id=$unit->id;
          $contract_detail->price=$unit->price;
          $contract_detail->save();
      }

      $latest=DB::table("billing_headers")
      ->select("billing_headers.*")
      ->orderBy('code',"DESC")
      ->first();
      $code="BILL001";
      if(!is_null($latest))
          $code=$latest->code;
      $sc= new smartCounter();
      $code=$sc->increment($code);


      $cost=$request->net_rent + $request->advance_rent + $request->cusa + $request->security_deposit + $request->vetting_fee + $request->fit_out;
      $billing_header=new BillingHeader();
      $billing_header->user_id=Auth::user()->id;
      $billing_header->code=$code;
      $billing_header->current_contract_id=$current_contract->id;
      $billing_header->date_issued=Carbon::now(Config::get('app.timezone'));
      $billing_header->cost=$cost;
      $billing_header->save();

      $rent=DB::table('billing_items')
      ->select('id')
      ->where('description','Rent')
      ->first()->id
      ;
      $billing_detail=new BillingDetail();
      $billing_detail->billing_header_id=$billing_header->id;
      $billing_detail->billing_item_id=$rent;
      $billing_detail->description="The net rent value.";
      $billing_detail->price=$request->net_rent;
      $billing_detail->save();

      $advance_rent=DB::table('billing_items')
      ->select('id')
      ->where('description','Advance Rent')
      ->first()->id
      ;
      $billing_detail=new BillingDetail();
      $billing_detail->billing_header_id=$billing_header->id;
      $billing_detail->billing_item_id=$advance_rent;
      $billing_detail->description="The advance rent payment. Worth $utilities->advance_rent_rate month(s).";
      $billing_detail->price=$request->advance_rent;
      $billing_detail->save();

      $cusa=DB::table('billing_items')
      ->select('id')
      ->where('description','CUSA Fee')
      ->first()->id
      ;
      $billing_detail=new BillingDetail();
      $billing_detail->billing_header_id=$billing_header->id;
      $billing_detail->billing_item_id=$cusa;
      $billing_detail->description="$utilities->cusa_rate /sqm, plus VAT less 2% withholding tax, per month";
      $billing_detail->price=$request->cusa;
      $billing_detail->save();

      $security_deposit=DB::table('billing_items')
      ->select('id')
      ->where('description','Security Deposit')
      ->first()->id
      ;
      $billing_detail=new BillingDetail();
      $billing_detail->billing_header_id=$billing_header->id;
      $billing_detail->billing_item_id=$security_deposit;
      $billing_detail->description="The security deposit. Worth $utilities->security_deposit_rate month(s) Base Rent.";
      $billing_detail->price=$request->security_deposit;
      $billing_detail->save();

      $vetting_fee=DB::table('billing_items')
      ->select('id')
      ->where('description','Vetting Fee')
      ->first()->id
      ;
      $billing_detail=new BillingDetail();
      $billing_detail->billing_header_id=$billing_header->id;
      $billing_detail->billing_item_id=$vetting_fee;
      $billing_detail->description="$utilities->vetting_fee / sqm exclusive of vat";
      $billing_detail->price=$request->vetting_fee;
      $billing_detail->save();

      $fit_out=DB::table('billing_items')
      ->select('id')
      ->where('description','Fit-out Deposit')
      ->first()->id
      ;
      $billing_detail=new BillingDetail();
      $billing_detail->billing_header_id=$billing_header->id;
      $billing_detail->billing_item_id=$fit_out;
      $billing_detail->description="Fit out Deposit. $utilities->fit_out_deposit month(s) rent";
      $billing_detail->price=$request->fit_out;
      $billing_detail->save();


      foreach ($request->contents as $content) {
          $contract_content=new ContractContent();
          $contract_content->contract_header_id=$contract_header->id;
          $contract_content->content_id=$content;
          $contract_content->save();
      }

      $contract=db::table('current_contracts')
      ->join('users','current_contracts.user_id','users.id')
      ->join('contract_headers','current_contracts.contract_header_id','contract_headers.id')
      ->where('current_contracts.id',$current_contract->id)
      ->select(DB::raw('date_issued,start_of_contract,end_of_contract, Concat(first_name," ",last_name) as full_name,code'))
      ->first();

      $units=db::table('units')
      ->join('contract_details','units.id','contract_details.unit_id')
      ->where('current_contract_id',$current_contract->id)
      ->select(DB::raw('code,CONCAT("PHP ",price * size) as price'))
      ->get();

      $billing_details=DB::table('billing_details')
      ->join('billing_headers','billing_details.billing_header_id','billing_headers.id')
      ->where('billing_headers.current_contract_id',$current_contract->id)
      ->select(DB::RAW('description,CONCAT("PHP ",price) as price'))
      ->get()
      ;
      $contents=DB::table('contents')
      ->join('contract_contents','contents.id','contract_contents.content_id')
      ->join('current_contracts','contract_contents.contract_header_id','current_contracts.id')
      ->select('description')
      ->where('current_contracts.id',$current_contract->id)
      ->get();
      $cost="PHP $cost";

      $res_fee=$utilities->reservation_fee * $request->net_rent;
      $pdf = PDF::loadView('transaction.contractCreation.pdf',compact('contract', 'units','billing_details','contents','cost','request','utilities','full_name','res_fee'));
      $date_issued=date_format($current_contract->date_issued,"Y-m-d");
      $pdfName="$contract_header->code($date_issued).pdf";
      $location=public_path("docs/$pdfName");
      $pdf->save($location);
      $current_contract->pdf=$pdfName;
      $current_contract->save();

      DB::commit();
      $request->session()->flash('green', 'Contract successfully generated.');
      return redirect(route('contract-create.index'));
  }
  catch(\Exception $e)
  {
   DB::rollBack();
   $request->session()->flash('red', 'Oooops something went wrong.');
   dd($e);
}

}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createData($id)
    {

     $tenant=DB::table('registration_headers')
     ->where('registration_headers.id',$id)
     ->join('tenants','registration_headers.tenant_id','tenants.id')
     ->join('business_types','tenants.business_type_id','business_types.id')
     ->select('registration_headers.code','tenants.description as tenant','business_types.description as business_type')
     ->first()
     ;
     $units=DB::table('registration_headers')
     ->where('registration_headers.id',$id)
     ->where('registration_headers.status','1')
     ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
     ->where('registration_details.is_rejected','0')
     ->where('registration_details.is_forfeited','0')
     ->join('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
     ->where('offer_sheet_details.status','1')
     ->join('units','offer_sheet_details.unit_id','units.id')
     ->join('floors','units.floor_id','floors.id')
     ->join('buildings','floors.building_id','buildings.id')
     ->join('addresses','buildings.address_id','addresses.id')
     ->join('cities','addresses.city_id','cities.id')
     ->leftJoin("market_rates","cities.id","market_rates.city_id")
     ->groupBy("cities.id")
     ->whereRaw("market_rates.date_as_of=(SELECT MAX(date_as_of) from market_rates where city_id=cities.id) or isnull(market_rates.date_as_of)")
     ->select(DB::raw("units.id,units.code,COALESCE(market_rates.rate,0) as rate"))
     ->orderBy("cities.description")
     ->get();
     return Datatables::of($units)
     ->editColumn('rate', function ($data) {
      return "$data->rate sqm";
  })
     ->setRowId(function ($data) {
      return $data = 'id'.$data->id;
  }) 
     ->rawColumns(['rate'])
     ->make(true)
     ;

 }
 public function show($id)
 {
        //
     $utilities=DB::table('utilities')
     ->whereRaw('date_as_of=(Select Max(date_as_of) from utilities)')
     ->select('utilities.*')
     ->first();

     $tenant=DB::table('registration_headers')
     ->where('registration_headers.id',$id)
     ->join('tenants','registration_headers.tenant_id','tenants.id')
     ->join('business_types','tenants.business_type_id','business_types.id')
     ->join('users','tenants.user_id','users.id')
     ->join('representatives','users.id','representatives.user_id')
     ->join('addresses','representatives.address_id','addresses.id')
     ->join('cities','addresses.city_id','cities.id')
     ->select(DB::Raw('registration_headers.id,registration_headers.code,tenants.description as tenant,business_types.description as business_type, CONCAT(first_name," ",last_name) as full_name,CONCAT(number," ",street," ",district,", ", cities.description) as address'))
     ->first()
     ;
     $result=DB::table('registration_headers')
     ->where('registration_headers.id',$id)
     ->where('registration_headers.status','1')
     ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
     ->where('registration_details.is_rejected','0')
     ->where('registration_details.is_forfeited','0')
     ->join('offer_sheet_details','registration_details.id','offer_sheet_details.registration_detail_id')
     ->where('offer_sheet_details.status','1')
     ->join('units','offer_sheet_details.unit_id','units.id')
     ->join('floors','units.floor_id','floors.id')
     ->join('buildings','floors.building_id','buildings.id')
     ->join('addresses','buildings.address_id','addresses.id')
     ->join('cities','addresses.city_id','cities.id')
     ->leftJoin("unit_prices","units.id","unit_prices.unit_id")
     ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=units.id)");
     $units=$result->Select(DB::Raw("units.size,units.id,units.code,unit_prices.price as rate,unit_prices.price * units.size as price"))
     ->get();
     $subquery=$result->Select(DB::Raw("sum(unit_prices.price * units.size) as total,sum(units.size) as area,is_reserved"))->first();
     $contents=DB::table('contents')
     ->where('is_active',1)
     ->select('id','description')
     ->get()
     ;
     $area=$subquery->area;
     $total=$subquery->total;
     $vat=$total*($utilities->vat_rate/100);
     $subtotal=$vat+$total;
     $ewt=$total*($utilities->ewt_rate/100);
     $final=$subtotal-$ewt;
     $advance_rent=$utilities->advance_rent_rate*$final;
     if($subquery->is_reserved==1)
      $security_deposit=($utilities->security_deposit_rate*$total) - ($final* $utilities->reservation_fee);
  else
      $security_deposit=$utilities->security_deposit_rate*$total;
     $cusa_size=$area; //tentative cusa size
     $cusa=($utilities->cusa_rate * $cusa_size) - ($utilities->cusa_rate * $cusa_size* 0.02); //tentative 2 %
     $vetting_fee=$utilities->vetting_fee*$area + ($utilities->vetting_fee *$area * ($utilities->vat_rate)/100);
     $fit_out=$utilities->fit_out_deposit*$final;
     return view('transaction.contractCreation.create')
     ->withUnits($units)
     ->withTenant($tenant)
     ->withTotal($total)
     ->withArea($area)
     ->withVat($vat)
     ->withSubtotal($subtotal)
     ->withUtilities($utilities)
     ->withFinal($final)
     ->withEwt($ewt)
     ->withAdvancerent($advance_rent)
     ->withSecuritydeposit($security_deposit)
     ->withCusa($cusa)
     ->withVettingfee($vetting_fee)
     ->withContents($contents)
     ->withFitout($fit_out)
     ->withId($id)
     ;

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
   // isang record lang ang pinapakita sa contract create show
   // dapat 1 ung default value ng status ng details sa offersheet approval
