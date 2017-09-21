<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OfferSheetHeader;
use App\OfferSheetDetail;
use DB;
use Response;
use Datatables;
use Auth;
class offerSheetApprovalController extends Controller
{
 public function __construct()
 {
  $this->middleware('tenant');
  $this->middleware('auth');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
      $result=DB::table('offer_sheet_headers')
      ->leftjoin('offer_sheet_details','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id'
        )
      ->join('registration_details','offer_sheet_details.registration_detail_id','registration_details.id')
      ->where('registration_details.is_rejected','0')
      ->where('registration_headers.is_forfeited','0')
      ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
      ->join('tenants','registration_headers.tenant_id','tenants.id')
      ->join('users as user_tenant','tenants.user_id','user_tenant.id')
      ->where('user_tenant.id','=',Auth::user()->id)
      ->where('registration_headers.status','1')
      ->join('users','registration_headers.user_id','users.id')
      ->where('offer_sheet_headers.status','0')
      ->select(DB::Raw('offer_sheet_headers.id, registration_headers.code as regi_code,offer_sheet_headers.code as offer_code,CONCAT(users.first_name," ",users.last_name) as name,offer_sheet_headers.date_issued as date, COUNT(offer_sheet_details.id) as regi_count'))
      ->groupBy('registration_headers.id')
      ->get();
      return Datatables::of($result)
      ->addColumn('action', function ($data) {
        return "<a href=".route('offerSheetApproval.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>
        <a href=".route('offerSheetApproval.show2',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>
        ";
      })
      ->editColumn('date', function ($data) {
       $time = strtotime($data->date);
       $myDate = date( 'M d, y', $time );
       $date=$myDate;
       return $date;
     })
      ->setRowId(function ($data) {
        return $data = 'id'.$data->id;
      })
      ->rawColumns(['action'])
      ->make(true);
    }
    public function index()
    {
      return view('transaction.offerSheetApproval.index');
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
      DB::beginTransaction();
      try
      {
      if($request->header_is_active==1)// if the transaction was accepted
      {
       $offer_head=OfferSheetHeader::find($request->myId);
       $offer_head->status=1;
       $offer_head->tenant_remarks=$request->header_remarks;
       $offer_head->save();
       for($x=0;$x<count($request->offer_id); $x++)
       { 
        $offer_detail=OfferSheetDetail::findorfail($request->offer_id[$x]);
        if($request->offer_is_active[$x]==1)
        {
         $offer_detail->status=$request->offer_is_active[$x];
         $offer_detail->tenant_remarks=$request->offer_remarks[$x];
         $offer_detail->save();
       }
       else
         $offer_detail->delete();

     }
     $request->session()->flash('green', 'Offer Sheet Approved.');
   }
           else //if the transaction was rejected
           {
             $offer_head=OfferSheetHeader::find($request->myId);
             $offer_head->status=2;
             $offer_head->tenant_remarks=$request->header_remarks;
             $offer_head->save();
             $request->session()->flash('green', 'Offer Sheet Rejected.');
           }
           db::commit();
           return redirect(route('offerSheetApproval.index'));
         }
         catch(\Exception $e)
         {
          db::rollBack();
          dd($e);
          $request->session()->flash('red', 'Ooops, something went wrong.');
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
     $result=DB::table('offer_sheet_headers')
     ->where('offer_sheet_headers.id',$id)
     ->join('users','offer_sheet_headers.user_id','users.id')
     ->select(DB::Raw('offer_sheet_headers.tenant_remarks,offer_sheet_headers.code, offer_sheet_headers.id, CONCAT(users.first_name," ",users.last_name) as name'))
     ->first();
     return view('transaction.offerSheetApproval.show')
     ->withResult($result);
   }

   public function show2($id)
   {
        //
    $results=DB::table('offer_sheet_headers')
    ->where('offer_sheet_headers.id',$id)
    ->join('users','offer_sheet_headers.user_id','users.id')
    ->join('offer_sheet_details','offer_sheet_headers.id','offer_sheet_details.offer_sheet_header_id')
    ->join('registration_details','offer_sheet_details.registration_detail_id','registration_details.id')
    ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
    ->select(DB::Raw('offer_sheet_headers.tenant_remarks,offer_sheet_headers.code,registration_headers.code as regi_code, offer_sheet_headers.id, CONCAT(users.first_name," ",users.last_name) as name,picture,registration_headers.date_issued as regi_date,count(distinctrow offer_sheet_details.id ) as unit_count,offer_sheet_headers.date_issued as offer_date'))
    ->first();
    $time = strtotime($results->regi_date);
    $myDate = date( 'M d,Y', $time );
    $results->regi_date=$myDate;
    $time = strtotime($results->offer_date);
    $myDate = date( 'M d,Y', $time );
    $results->offer_date=$myDate;

    $units=DB::table('offer_sheet_details')
    ->join('offer_sheet_headers','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id')
    ->join('registration_details','offer_sheet_details.registration_detail_id','registration_details.id')
    ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
    ->join('units','offer_sheet_details.unit_id','units.id')
    ->join("unit_prices","units.id","unit_prices.unit_id")
    ->join('floors','units.floor_id','floors.id')
    ->join('buildings','floors.building_id','buildings.id')
    ->join('addresses','buildings.address_id','addresses.id')
    ->join('cities','addresses.city_id','cities.id')
    ->join('provinces','cities.province_id','provinces.id')
    ->join('building_types','buildings.building_type_id','building_types.id')
    ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=units.id)")
    ->where('registration_headers.is_forfeited','0')
    ->where('offer_sheet_headers.id',$id)
    ->where('offer_sheet_headers.status','0')
    ->select('offer_sheet_details.id','units.type','units.size','units.code','building_types.description as building_type','floors.number as floor','buildings.description as building',DB::raw('units.size * price as price')
      ,DB::raw('CONCAT(cities.description, ", ", provinces.description) as address')
      )
    ->groupby('offer_sheet_details.id')
    ->get();
    foreach ($units as &$unit) {
      $type='Raw';
      if($unit->type==1)
        $type='Shell';
      $unit->type=$type;
      $unit->price="₱".number_format($unit->price,2);
      $unit->size=number_format($unit->size,2)." sqm";

    }

    return view('transaction.offerSheetApproval.show2')
    ->withResults($results)
    ->withUnits($units);
  }
  public function showData($id)
  {
   $result=DB::table('offer_sheet_headers')
   ->leftjoin('offer_sheet_details','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id'
     )
   ->join('registration_details','offer_sheet_details.registration_detail_id','registration_details.id')
   ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
   ->join('users','registration_headers.user_id','users.id')
   ->join('units','offer_sheet_details.unit_id','units.id')
   ->leftJoin("unit_prices","units.id","unit_prices.unit_id")
   ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=units.id)")
   ->join('floors','units.floor_id','floors.id')
   ->join('buildings','floors.building_id','buildings.id')
   ->join('building_types','buildings.building_type_id','building_types.id')
   ->where('registration_headers.status','1')
   ->where('registration_headers.is_forfeited','0')
   ->where('registration_details.is_rejected','0')
   ->where('offer_sheet_headers.id',$id)
   ->select(DB::Raw('registration_details.id as regi_id,offer_sheet_details.id as offer_id, building_types.id as building_type_id,registration_details.building_type_id as ordered_building_type, building_types.description as building_type,units.code as unit_code,CONCAT("₱ ",price * size) as rate'))
   ->groupBy('registration_details.id')
   ->where('offer_sheet_headers.status','0')
   ->get();
   return Datatables::of($result)
   ->addColumn('action', function ($data) {
    return " <button type='button' id='btnChoose' class='btn bg-blue btn-circle waves-effect waves-circle waves-float btnChoose' value='$data->offer_id'><i class='mdi-action-visibility'></i></button>
    <input type='hidden' value='$data->offer_id' name='offer_id[]'>
    <input type='hidden' name='offer_is_active[]' id='offer$data->offer_id'value='1'><input id='remarks$data->offer_id' type='hidden' name='offer_remarks[]'>";
  })
   ->setRowId(function ($data) {
    return $data = 'id'.$data->offer_id;
  })
   ->rawColumns(['action','building_type','unit_type','unit_size','floor'])
   ->make(true);
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
     $result=DB::table('offer_sheet_headers')
     ->leftjoin('offer_sheet_details','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id'
       )
     ->join('registration_details','offer_sheet_details.registration_detail_id','registration_details.id')
     ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
     ->join('users','registration_headers.user_id','users.id')
     ->join('units','offer_sheet_details.unit_id','units.id')
     ->join('floors','units.floor_id','floors.id')
     ->join('buildings','floors.building_id','buildings.id')
     ->join('building_types','buildings.building_type_id','building_types.id')
     ->where('registration_headers.status','1')
     ->where('registration_details.is_rejected','0')
     ->where('offer_sheet_details.id',$id)
     ->select(DB::Raw('registration_details.admin_remarks as detail_remarks,offer_sheet_details.id as offer_id, building_types.id as building_type_id, building_types.description as building_type,units.code as unit_code, units.size as unit_size,registration_details.size_from, registration_details.size_to, units.type as unit_type,registration_details.unit_type as ordered_unit_type,floors.number as floor,units.picture'))
     ->groupBy('registration_details.id')
     ->where('offer_sheet_headers.status','0')
     ->first();
     return response::json($result);
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
