<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;
use Datatables;
use App\MoveInDetail;
use App\MoveInHeader;
use Carbon\Carbon;
use Config;
use Auth;

class moveInController extends Controller
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
        return view('transaction.moveIn.index');
    }
    public function data()
    {
        $contracts=DB::table('current_contracts')
        ->join('contract_headers','current_contracts.contract_header_id','contract_headers.id')
        ->join('registration_headers','contract_headers.registration_header_id','registration_headers.id')
        ->join('tenants','registration_headers.tenant_id','tenants.id')
        ->join('business_types','tenants.business_type_id','business_types.id')
        ->join('users as tenant','tenants.user_id','tenant.id')
        ->join('users as admin','current_contracts.user_id','admin.id')
        ->join('contract_details','current_contracts.id','contract_details.current_contract_id')
        ->select(DB::raw('current_contracts.id, contract_headers.code,CONCAT(tenant.first_name," ",tenant.last_name) as full_name,count(distinctrow contract_details.id) as unit_count, tenants.description as tenant_description,business_types.description as business_type_description'))
        ->whereRaw('current_contracts.date_issued=(Select Max(date_issued) from current_contracts where contract_header_id=contract_headers.id)')
        //commented that out bc idk when that's supposed to be set
        //->where('current_contracts.status',1)
        ->whereRaw('contract_details.id not in (Select contract_detail_id from move_in_details)')
        ->groupBy('current_contracts.id')
        ->get();
        return Datatables::of($contracts)
        ->addColumn('action', function ($data) {
            return "<a href=".route('move-in.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>";
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['action'])
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
        DB::begintransaction();
        try
        {
            //
            $latest=DB::table("move_in_headers")
            ->select("code")
            ->orderBy('code',"DESC")
            ->first();
            $pk="Move_In_001";
            if(!is_null($latest))
                $pk=$latest->code;
            $sc= new smartCounter();
            $pk=$sc->increment($pk);
            $move_in_header=new MoveInHeader();
            $move_in_header->code=$pk;
            $move_in_header->date_issued=Carbon::now(Config::get('app.timezone'));
            $move_in_header->date_moved_in=$request->dateMovedIn;
            $move_in_header->user_id=Auth::user()->id;
            $move_in_header->remarks=$request->remarks;
            $move_in_header->save();
            if(!is_null($request->units))
            {
                foreach ($request->units as $unit) 
                {
                    $move_in_detail=new MoveInDetail();
                    $move_in_detail->move_in_header_id=$move_in_header->id;
                    $move_in_detail->contract_detail_id=$unit;
                    $move_in_detail->save();
                }
            }
            DB::commit();
            $request->session()->flash('green', 'Move in form successfully generated.');
            return redirect(route('move-in.index'));
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            $request->session()->flash('red', 'Oops, something went wrong.');
            return dd($e);
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
        $contract=DB::table('current_contracts')
        ->join('contract_headers','current_contracts.contract_header_id','contract_headers.id')
        ->join('registration_headers','contract_headers.registration_header_id','registration_headers.id')
        ->join('tenants','registration_headers.tenant_id','tenants.id')
        ->join('users','tenants.user_id','users.id')
        ->join('representatives','users.id','representatives.user_id')
        ->join('representative_positions','representatives.representative_position_id','representative_positions.id')
        ->join('addresses','representatives.address_id','addresses.id')
        ->join('cities','addresses.city_id','cities.id')
        ->join('provinces','cities.province_id','provinces.id')
        ->join('business_types','tenants.business_type_id','business_types.id')
        ->where('current_contracts.id',$id)
        ->select('current_contracts.id','tenants.description as tenant','business_types.description as business','tenants.code',DB::raw('CONCAT(year(current_contracts.end_of_contract) - year(current_contracts.start_of_contract)) as duration'),DB::Raw('Concat(addresses.number," ",addresses.street," ",addresses.district," ",cities.description, ", ", provinces.description) as address'),'representative_positions.description as position','contract_headers.code as contract_header_code',DB::RAW('concat(first_name," ", last_name) as name'),'users.picture')
        ->first();
        $units=DB::table('units')
        ->join('contract_details','units.id','contract_details.unit_id')
        ->join('floors','units.floor_id','floors.id')
        ->join('buildings','floors.building_id','buildings.id')
        ->join('building_types','buildings.building_type_id','building_types.id')
        ->join('addresses','buildings.address_id','addresses.id')
        ->join('cities','addresses.city_id','cities.id')
        ->join('provinces','cities.province_id','provinces.id')
        ->where('current_contract_id',$id)
        ->whereRaw('contract_details.id not in (Select contract_detail_id from move_in_details)')
        ->select('contract_details.id','units.code',DB::RAW('Concat(cities.description, ", ", provinces.description) as address'),'buildings.description as building','floors.number as floor','building_types.description as building_type','units.size as unit_size','units.type as unit_type')
        ->get();
        foreach ($units as &$unit) {
            # code...
            $value='Raw';
            if($unit->unit_type==1)
                $value='Shell';
            $unit->unit_type=$value;
            $unit->unit_size=number_format($unit->unit_size,2)." sqm"; 
        }
        return view('transaction.moveIn.show')
        ->withContract($contract)
        ->withUnits($units);
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
