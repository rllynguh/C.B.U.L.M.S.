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
        return "<a href=".route('offerSheetApproval.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>";
      })
      ->editColumn('date', function ($data) {
       $time = strtotime($data->date);
       $myDate = date( 'm-d-y', $time );
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
      if($request->header_is_active==1)// if the transaction was accepted
      {
        $offer_head=OfferSheetHeader::find($request->myId);
        $offer_head->status=1;
        $offer_head->tenant_remarks=$request->header_remarks;
        $offer_head->save();
        for($x=0;$x<count($request->offer_id); $x++)
        { 
          $offer_detail=OfferSheetDetail::find($request->offer_id[$x]);
          $offer_detail->status=$request->offer_is_active[$x];
          $offer_detail->tenant_remarks=$request->offer_remarks[$x];
          $offer_detail->save();
        }
      }
      else //if the transaction was rejected
      {
        $offer_head=OfferSheetHeader::find($request->myId);
        $offer_head->status=2;
        $offer_head->tenant_remarks=$request->header_remarks;
        $offer_head->save();
      }
      return redirect(route('offerSheetApproval.index'));
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
   public function showData($id)
   {
     $result=DB::table('offer_sheet_headers')
     ->leftjoin('offer_sheet_details','offer_sheet_details.offer_sheet_header_id','offer_sheet_headers.id'
      )
     ->join('registration_details','offer_sheet_details.registration_detail_id','registration_details.id')
     ->join('registration_headers','registration_details.registration_header_id','registration_headers.id')
     ->join('users','registration_headers.user_id','users.id')
     // ->where('users.id',Auth::user()->id)
     ->join('units','offer_sheet_details.unit_id','units.id')
     ->leftJoin("unit_prices","units.id","unit_prices.unit_id")
     ->whereRaw("unit_prices.date_as_of=(SELECT MAX(date_as_of) from unit_prices where unit_id=units.id)")
     ->join('floors','units.floor_id','floors.id')
     ->join('buildings','floors.building_id','buildings.id')
     ->join('building_types','buildings.building_type_id','building_types.id')
     ->where('registration_headers.status','1')
     ->where('registration_details.is_rejected','0')
     ->where('offer_sheet_headers.id',$id)
     ->select(DB::Raw('registration_details.id as regi_id,offer_sheet_details.id as offer_id, building_types.id as building_type_id,registration_details.building_type_id as ordered_building_type, building_types.description as building_type,units.code as unit_code, units.size as unit_size,registration_details.size_from, registration_details.size_to, units.type as unit_type,registration_details.unit_type as ordered_unit_type,floors.number as floor,registration_details.floor as ordered_floor,unit_prices.price'))
     ->groupBy('registration_details.id')
     ->where('offer_sheet_headers.status','0')
     ->get();
     return Datatables::of($result)
     ->addColumn('action', function ($data) {
      return " <button type='button' id='btnChoose' class='btn bg-blue btn-circle waves-effect waves-circle waves-float btnChoose' value='$data->offer_id'><i class='mdi-action-visibility'></i></button>
      <input type='hidden' value='$data->offer_id' name='offer_id[]'>
      <input type='hidden' name='offer_is_active[]' id='offer$data->offer_id'value='1'><input id='remarks$data->offer_id' type='hidden' name='offer_remarks[]'>";
    })
     ->editColumn('price', function ($data) {
      return "P $data->price";
    })
     ->editColumn('unit_type', function ($data) {
      $value="Raw";
      if($data->unit_type ==1)
        $value="Shell";
      $color='danger';
      if($data->unit_type==$data->ordered_unit_type)
        $color='success';
      $output="<large class='label label-$color'>$value</large>";
      return $output;
    })
     ->editColumn('building_type', function ($data) {
      $color='danger';
      if($data->building_type_id==$data->ordered_building_type)
        $color='success';
      $output="<large class='label label-$color'>$data->building_type</large>";
      return $output;
    })
     ->editColumn('unit_size', function ($data) {
      $color='danger';
      if($data->unit_size<=$data->size_to && $data->unit_size>=$data->size_from)
        $color='success';
      $output="<large class='label label-$color'>$data->unit_size sqm</large>";
      return $output;
    })
     ->editColumn('floor', function ($data) {
      $color='danger';
      if($data->floor==$data->ordered_floor)
        $color='success';
      $output="<large class='label label-$color'>$data->floor</large>";
      return $output;
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
 ->select(DB::Raw('registration_details.admin_remarks as detail_remarks,offer_sheet_details.id as offer_id, building_types.id as building_type_id, building_types.description as building_type,units.code as unit_code, units.size as unit_size,registration_details.size_from, registration_details.size_to, units.type as unit_type,registration_details.unit_type as ordered_unit_type,floors.number as floor'))
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
