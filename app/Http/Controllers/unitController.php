<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\unit;
use Response;
use DB;
use Datatables;
use Image;
use Config;
use Carbon\Carbon;
use App\UnitPrice;

class unitController extends Controller
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
    public function data()
    {
      $result=DB::table("units")
      ->select(DB::Raw('Coalesce(price,1) as price,buildings.description,floors.number as floor_number,units.code as unit_code,units.type,units.size,units.is_active,units.id'))
      ->join("floors","units.floor_id","floors.id")
      ->join("buildings","floors.building_id","buildings.id")
      ->join("building_types","buildings.building_type_id","building_types.id")
      ->leftJoin('unit_prices','units.id','unit_prices.unit_id')
      ->whereRaw("unit_prices.date_as_of=(SELECT MAX(unit_prices.date_as_of) from unit_prices where unit_id=units.id) or isnull(unit_prices.date_as_of)")
      ->where("buildings.is_active",1)
      ->get();
      return Datatables::of($result)
      ->addColumn('action', function ($data) {
        return '<button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button>';
      })
      ->editColumn('is_active', function ($data) {
        $checked = '';
        if($data->is_active==1){
          $checked = 'checked';
        }
        return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->id.'"><span class="lever switch-col-blue"></span>On</label></div>';
      })
      ->editColumn('size', function ($data) {

        return "$data->size sqm";
      })
      ->editColumn('price', function ($data) {

        return "P $data->price / month";
      })
      ->editColumn('type', function ($data) {
        $value = 'Raw';
        if($data->type==1){
          $value = 'Shell';
        }
        return $value;
      })
      ->setRowId(function ($data) {
        return $data = 'id'.$data->id;
      })
      ->rawColumns(['is_active','action'])
      ->make(true);
    }
    public function index()
    {
        //
      return view("maintenance.unit.index");
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
        $uNum=$request->txtUNum;    
        $result=DB::table("floors")
        ->where("floors.id",$request->comFloor)
        ->join("buildings","floors.building_id","buildings.id")
        ->select("buildings.description","floors.number")
        ->first();
        $pk=strtoupper(substr($result->description, 0, 3)).strtoupper($result->number)."UNIT".strtoupper($uNum) ;
        $image = $request->file('picture');
        $imagename = md5($pk).'.'.$image->getClientOriginalExtension();

        $location=public_path('images/units/'.$imagename);
        $unit=new unit();
        $unit->code=$pk;
        $unit->picture=$imagename;
        $unit->type=$request->comUnitType;
        $unit->size=$request->txtArea;
        $unit->number=$uNum;
        $unit->floor_id=$request->comFloor;
        $unit->save();

        $unit_price=new UnitPrice();
        $unit_price->unit_id=$unit->id;
        $unit_price->price=$request->txtPrice;
        $unit_price->date_as_of=Carbon::now(Config::get('app.timezone'));
        $unit_price->save();
        Image::make($image)->resize(400,400)->save($location);
        return Response::json("success store");


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
        $result=DB::table("units")
        ->select(DB::Raw("Coalesce(price,1) as price,floors.*,buildings.*,units.*"))
        ->join("floors","units.floor_id","floors.id")
        ->join("buildings","floors.building_id","buildings.id")
        ->leftJoin('unit_prices','units.id','unit_prices.unit_id')
        ->where("units.id",$id)
        ->whereRaw("unit_prices.date_as_of=(SELECT MAX(unit_prices.date_as_of) from unit_prices where unit_id=units.id) or isnull(unit_prices.date_as_of)")
        ->first();
        return Response::json($result);
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

      public function updatePOST(Request $request, $id)
      {
        //
        try
        {
          $query=Unit::find($id);
          if($request->file('picture')!=null)
          {
            $image=$request->File('picture');
            $imagename=md5($query->code).$image->getClientOriginalExtension();
            $location=public_path('/images/units/'.$imagename);
            Image::make($image)
            ->resize(400,400)
            ->save($location);
          }
          $unit=unit::find($id);
          if($request->file('picture')!=null)
            $unit->picture=$imagename;
          $unit->type=$request->comUnitType;
          $unit->size=$request->txtArea;
          $unit->number=$request->txtUNum;
          $unit->save();
          $unit_price=new UnitPrice();
          $unit_price->unit_id=$unit->id;
          $unit_price->price=$request->txtPrice;
          $unit_price->date_as_of=Carbon::now(Config::get('app.timezone'));
          $unit_price->save();
          return Response::json("succes update");
        }catch(\Exception $e)
        {
          return Response::json($e);

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
       try
       {
        $result = unit::findorfail($id);
        try
        {
          $result->delete();
          return Response::json($result);
        }
        catch(\Exception $e) {
          if($e->errorInfo[1]==1451)
            return Response::json(['true',$result]);
          else
            return Response::json(['true',$result,$e->errorInfo[1]]);
        }
      } 
      catch(\Exception $e) {
        return "Deleted";
      }
    }
    public function softdelete($id)
    {
      $result=unit::find($id);
      if(!$result->is_active)
        $val=1;
      else
        $val=0;
      $result->is_active=$val;
      $result->save();
      return Response::json("success");
    }

    public function getFloor($id)
    {
      $query = DB::table('floors')
      ->select('floors.*')
      ->leftJoin('units','floors.id','=','units.floor_id')
      ->join('buildings','floors.building_id','=','buildings.id')
      ->where('floors.is_active','=',1)
      ->where('buildings.is_active','=',1)
      ->where('buildings.id','=',$id)
      ->groupBy('floors.id')
      ->havingRaw('floors.num_of_unit > COUNT(units.floor_id)')
      ->get();
      return Response::json($query);
    }
    public function getBuilding()
    {
      $query = DB::table('buildings')
      ->select('buildings.*')
      ->leftJoin('floors','buildings.id','=','floors.building_id')
      ->leftJoin('units','floors.id','=','units.floor_id')
      ->where('buildings.is_active','=',1)
      ->where('floors.is_active','=',1)
      ->groupBy('buildings.id')
      ->havingRaw('SUM(distinctrow floors.num_of_unit) > COUNT(units.id)')
      ->get();
      return Response::json($query);
    }
    public function getLatest($id)
    {
      $query = DB::table('floors')
      ->JOIN('units','floors.id','=','units.floor_id')
      ->WHERE('floors.id','=',$id)
      ->select(DB::raw("floors.num_of_unit as max,COALESCE(MAX(units.number) + 1,1) as number"))
      ->first();
      return Response::json($query);
    }
  }
