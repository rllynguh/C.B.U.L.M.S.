<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\BusinessType;
use App\RegistrationDetail;
use App\RegistrationHeader;
use App\RepresentativePosition;
use Hash;
use Aut;
use App\User;
use App\UserBalance;
use Carbon\Carbon;
use Config;
use App\Representative;
use App\Tenant;
use App\RegistrationRequirement;

class inquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      return view('user.guest.inquiry.index');


    }
    public function units(Request $request)
    {
      $busitype=BusinessType::where('is_active','=',1)
      ->select('id','description')
      ->orderBy('description')
      ->pluck('description','id');
      $position=RepresentativePosition::where('is_active','=',1)
      ->select('id','description')
      ->orderBy('description')
      ->pluck('description','id')
      ;
      $units=DB::TABLE('units')
      ->JOIN('floors','units.floor_id','floors.id')
      ->JOIN('buildings','floors.building_id','buildings.id')
      ->join('addresses','buildings.address_id','addresses.id')
      ->join('cities','addresses.city_id','cities.id')
      ->join('provinces','cities.province_id','provinces.id')
      ->join('building_types','buildings.building_type_id','building_types.id')
      ->JOIN('unit_prices','units.id','unit_prices.unit_id')
      ->WHERERAW("unit_prices.date_as_of=(SELECT MAX(unit_prices.date_as_of) from unit_prices where unit_id=units.id)")
      ->WHERERAW("units.id not in (SELECT unit_id from registration_details where is_reserved=1)")
      ->WHERERAW("units.id not in (SELECT unit_id from contract_details inner join current_contracts on contract_details.current_contract_id where current_contracts.status =1)")
      ->SELECT('units.id','units.code','building_types.description as building_type','units.picture','buildings.description as building','units.type','units.size','floors.number as floor','unit_prices.price',DB::raw('CONCAT(cities.description, ", ", provinces.description) as address'))
      ->HAVINGRAW('address like "%'.$request->txtSearch.'%" ')
      ->GROUPBY('units.id')
      ->GET();
      foreach ($units as $unit) {
        if($unit->type==0)
          $unit->type="Raw";
        else
          $unit->type="Shell";
        $unit->price="₱".number_format($unit->price,2);
        $unit->size=number_format($unit->size,2)." sqm";
      }
      return VIEW('user.guest.inquiry.units')
      ->withUnits($units)
      ->withPosi($position)
      ->withBusitype($busitype)
      ;
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
      $password=Hash::make("password");

      $user=new User;
      $user->first_name=$request->fname;
      $user->middle_name=$request->mname;
      $user->last_name=$request->lname;
      $user->cell_num=$request->cellno;
      $user->type='tenant';
      $user->email=$request->email;
      $user->password=$password;
      $user->save();

      $temp =  new UserBalance();
      $temp->date_as_of=Carbon::now(Config::get('app.timezone'));
      $temp->user_id = $user->id;
      $temp->balance = 0;
      $temp->save();

      $representative=new Representative;
      $representative->user_id=$user->id;
      $representative->representative_position_id=$request->position;
      $representative->tel_num=$request->telno;
      $representative->save();

      $tena_query=DB::table("tenants")
      ->select("tenants.code")
      ->orderBy("id","desc")
      ->first();
      $tena_pk="Tenant";
      if(!is_null($tena_query))
        $tena_pk=$tena_query->code;
      $sc= new smartCounter();
      $tena_pk=$sc->increment($tena_pk);    
      $tenant=new Tenant();
      $tenant->user_id=$user->id;
      $tenant->address=$request->tena_address;
      $tenant->business_type_id=$request->busitype;
      $tenant->description=$request->tenant;
      $tenant->code=$tena_pk;
      $tenant->save();

      $header_query=DB::table("registration_headers")
      ->select("registration_headers.code")
      ->orderBy("id","desc")
      ->first();
      $regi_header_pk="Registration";
      if(!is_null($header_query))
        $regi_header_pk=$header_query->code;
      $sc= new smartCounter();
      $regi_header_pk=$sc->increment($regi_header_pk);
      $regi_header=new RegistrationHeader;
      $regi_header->code=$regi_header_pk;
      $regi_header->tenant_id=$tenant->id;
      $regi_header->date_issued=Carbon::now(Config::get('app.timezone'));
      $regi_header->tenant_remarks=$request->header_remarks;
      $regi_header->duration_preferred=$request->duration;
      $regi_header->save();
      foreach ($request->units as $unit) {
            # code...
        $regi_detail=new RegistrationDetail;
        $regi_detail->registration_header_id=$regi_header->id;
        $regi_detail->unit_id=$unit;
        $regi_detail->tenant_remarks=$unit;
        $regi_detail->save();
      }

      $requirements=DB::table('business_type_requirements')
      ->select('requirements.id')
      ->join('requirements','business_type_requirements.requirement_id','requirements.id')
      ->where('requirements.is_active',1)
      ->where('business_type_requirements.business_type_id',$request->busitype)
      ->get();
      foreach ($requirements as $requirement) {
          # code...
        $regi_require=new RegistrationRequirement();
        $regi_require->registration_header_id=$regi_header->id;
        $regi_require->requirement_id=$requirement->id;
        $regi_require->save();
      }
      DB::commit();
      $request->session()->flash('green', 'Registration Successful! Your account details will be sent to you after the admin has validated your registration.');
      return redirect('/');
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
