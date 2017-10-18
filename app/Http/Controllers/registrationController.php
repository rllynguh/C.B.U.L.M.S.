<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Bank;
use App\User;
use App\Address;
use App\Representative;
use App\Tenant;
use App\RegistrationHeader;
use App\RegistrationDetail;
use Image;
use Hash;
use Config;
use Auth;
use Carbon\Carbon;
use App\Province;
use App\BusinessType;
use App\RepresentativePosition;
use App\RegistrationRequirement;
use App\UserBalance;
class registrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $province=Province::where('is_active','=','1')
      ->select('description','id')
      ->orderBy('description')
      ->pluck('description','id');
      $busitype=BusinessType::where('is_active','=',1)
      ->select('id','description')
      ->orderBy('description')
      ->pluck('description','id');
      $position=RepresentativePosition::where('is_active','=',1)
      ->select('id','description')
      ->orderBy('description')
      ->pluck('description','id')
      ;
      return view("tenant.registration")
      ->withTenaprov($province)
      ->withReprprov($province)
      ->withBusitype($busitype)
      ->withPosi($position)
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
        $requirements=DB::table('business_type_requirements')
        ->select('requirements.id')
        ->join('requirements','business_type_requirements.requirement_id','requirements.id')
        ->where('requirements.is_active',1)
        ->where('business_type_requirements.business_type_id',1)
        ->first();
        dd($requirements->id);
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
        try
        {
          $password=Hash::make("password");
          $image = $request->file('picture');
          $imagename = md5($request->email. time()).'.'.$image->getClientOriginalExtension();
          $location = public_path('images/users/'.$imagename);

          $user=new User;
          $user->first_name=$request->fname;
          $user->middle_name=$request->mname;
          $user->last_name=$request->lname;
          $user->picture=$imagename;
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

          $repr_address=new Address();
          $repr_address->number=$request->repr_number;
          $repr_address->street=$request->repr_street;
          $repr_address->district=$request->repr_barangay;
          $repr_address->city_id=$request->repr_city;
          $repr_address->save();

          $representative=new Representative;
          $representative->user_id=$user->id;
          $representative->representative_position_id=$request->position;
          $representative->tel_num=$request->telno;
          $representative->address_id=$repr_address->id;
          $representative->save();

          $tena_address=new Address();
          $tena_address->number=$request->tena_number;
          $tena_address->street=$request->tena_street;
          $tena_address->district=$request->tena_barangay;
          $tena_address->city_id=$request->tena_city;
          $tena_address->save();
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
          $tenant->address_id=$tena_address->id;
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
          for($x=0;$x<count($request->builtype); $x++)
          { 
            $result=explode('|',$request->size[$x]);
            $regi_detail=new RegistrationDetail;
            $regi_detail->registration_header_id=$regi_header->id;
            $regi_detail->building_type_id=$request->builtype[$x];
            $regi_detail->unit_type=$request->utype[$x];
            $regi_detail->size_from=$result[0];
            $regi_detail->size_to=$result[1];
            $regi_detail->floor=$request->floor[$x];
            $regi_detail->tenant_remarks=$request->remarks[$x];
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
          Image::make($image)->resize(400,400)->save($location);
          DB::commit();
          $request->session()->flash('green', 'Registration Successful!');
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
