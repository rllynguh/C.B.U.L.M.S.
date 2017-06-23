<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Bank;
use App\User;
use Image;
use Hash;
use Config;
use Auth;

class registrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("transaction.tenantRegistration.index")
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
        // foreach ($request->floor as $floor) {
        //     $bank=new Bank();
        //     $bank->description=$floor;
        //     $bank->save();
        // }
        DB::begintransaction();
        try
        {
            $password=Hash::make("password");
            $image = $request->file('picture');
            $imagename = md5($request->email. time()).'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$imagename);
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


            Image::make($image)->resize(400,400)->save($location);
            DB::commit();
            return redirect('/');
        }
        catch(\Exception $e)
        {
           DB::rollBack();
           return dd($e->getMessage());
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
