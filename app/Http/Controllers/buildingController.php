<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Controller\smartCounter;
use Response;
use Datatables;
use App\addressModel;
use App\buildingModel;
use App\floorModel;

class buildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
       $result=DB::table("tblbuilding")
       ->select("tblAddress.*","tblCity.*", 'tblProvince.*' ,'tblbuilding.*')
       ->join('tblAddress','tblbuilding.intAddrCode','tblAddress.intAddrCode')
       ->join('tblCity','tblAddress.intCityCode',"tblCity.intCityCode")
       ->join('tblProvince','tblCity.intProvinceCode',"tblProvince.intProvinceCode")
       ->where("tblBuilding.boolIsDeleted",0)
       ->get();
       return Datatables::of($result)
       ->addColumn('action', function ($data) {
        return '<button id="btnAddFloor" type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" value="'.$data->intBuilCode.'"><i class="mdi-content-add"></i></button> <button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float open-modal" value="'.$data->intBuilCode.'"><i class="mdi-editor-border-color"></i></button> <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float deleteRecord" value= "'.$data->intBuilCode.'"><i class="mdi-action-delete"></i></button>';
    })
       ->editColumn('boolIsActive', function ($data) {
          $checked = '';
          if($data->boolIsActive==1){
            $checked = 'checked';
        }
        return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->intBuilCode.'"><span class="lever switch-col-blue"></span>On</label></div>';
    })
       ->setRowId(function ($data) {
        return $data = 'id'.$data->intBuilCode;
    })
       ->rawColumns(['boolIsActive','action'])
       ->make(true);
   }

   public function index()
   {
        //
    $btype=Db::table('tblBuildingType')
    ->where("boolIsActive",1)
    ->where("boolIsDeleted",0)
    ->select("tblBuildingType.*")
    ->get();
    $province=Db::table('tblProvince')
    ->where("boolIsActive",1)
    ->select("tblProvince.*")
    ->get();
    return view("maintenance.building.index")
    ->withBtype($btype)
    ->withProvince($province)
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
    public function storefloor(Request $request)
    {
       $floor=new floorModel();
       $floor->intFloorNum=$request->txtFNum;
       $floor->intBuilCode=$request->comBuilding;
       $floor->intNumOfUnit=$request->txtUNum;
       $floor->save();
       return Response::json("success store");
   }
   public function store(Request $request)
   {
        //
     $latest=DB::table("tblBuilding")
     ->select("tblBuilding.*")
     ->orderBy('tblbuilding.strBuilCode',"DESC")
     ->join('tblBuildingType','tblbuilding.intBuilTypeCode','tblBuildingType.intBuilTypeCode')
     ->join('tblAddress','tblbuilding.intAddrCode','tblAddress.intAddrCode')
     ->where('tblBuilding.intBuilTypeCode',$request->comBuilType)
     ->first();
     $btype=buildingTypeModel::find($request->comBuilType);
     $pk="BLDG".strtoupper(substr($btype->strBuilTypeDesc, 0, 3));
     if(!is_null($latest))
        $pk=$latest->strBuilCode;
    $sc= new smartCounter();
    $pk=$sc->increment($pk);
    $address=new addressModel();
    $address->strAddrNum=$request->txtSNum;
    $address->strAddrStreet=$request->txtStreet;
    $address->strAddrDistrict=$request->txtDistrict;
    $address->intCityCode=$request->comCity;
    $address->save();
    try
    {
        $result=new buildingModel();
        $result->strBuilCode=$pk;
        $result->strBuilDesc=$request->txtBuilDesc;
        $result->intBuilTypeCode=$request->comBuilType;
        $result->intBuilNumOfFloor=$request->txtBFNum;
        $result->intAddrCode=$address->intAddrCode;
        $result->save();
        return Response::json("success store");
    }
    catch(\Exception $e) {
      if($e->errorInfo[1]==1062)
        return "This Data Already Exists";
    else if($e->errorInfo[1]==1452)
        return "Already Deleted";
    else
        return var_dump($e->errorInfo[1]);
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
    public function getFloor($id)
    {
        $result=DB::table("tblFloor")
        ->join("tblBuilding","tblFloor.intBuilCode","tblBuilding.intBuilCode")
        ->orderBy("tblFloor.intFloorNum","desc")
        ->select(DB::raw("tblBuilding.intBuilNumOfFloor as max,COALESCE(MAX(intFloorNum) + 1,1) as current, count(*) as count"))
        ->where("tblBuilding.intBuilCode",$id)
        ->first();
        return Response::json($result);
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
        $result = DB::table('tblBuilding')
        ->select('tblAddress.*','tblCity.*','tblfloor.*','tblProvince.*','tblBuildingType.*','tblBuilding.*',DB::raw('COUNT(tblFloor.intBuilCode) as current'))
        ->leftJoin('tblFloor','tblBuilding.intBuilCode','=','tblFloor.intBuilCode')
        ->join('tblAddress','tblBuilding.intAddrCode','=','tblAddress.intAddrCode')
        ->join('tblCity','tblAddress.intCityCode',"tblCity.intCityCode")
        ->join('tblProvince','tblCity.intProvinceCode',"tblProvince.intProvinceCode")
        ->join('tblBuildingType','tblBuilding.intBuilTypeCode','=','tblBuildingType.intBuilTypeCode')
        ->where('tblBuilding.intBuilCode','=',$id)
        ->groupBy('tblBuilding.intBuilCode')
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
         //
        try
        {
            try
            {
                $result=buildingModel::find($id);
                $result->strBuilDesc=$request->txtBuilDesc;
                $result->intBuilNumOfFloor=$request->txtBFNum;
                $result->save();
            }catch(\Exception $e)
            {
               if($e->errorInfo[1]==1062)
                return "This Data Already Exists";
            else
                return var_dump($e->errorInfo[1]);
        }
    }
    catch(\Exception $e)
    {
     return "Deleted";
 }
 $address=addressModel::find($result->intAddrCode);
 $address->strAddrNum=$request->txtSNum;
 $address->strAddrStreet=$request->txtStreet;
 $address->strAddrDistrict=$request->txtDistrict;
 $address->intCityCode=$request->comCity;
 $address->save();
 return Response::json("success update");
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softdelete($id)
    {
      $result=buildingModel::find($id);
      if($result->boolIsActive==1)
        $val=0;
    else
        $val=1;
    $result->boolIsActive=$val;
    $result->save();
}
public function destroy($id)
{
        //
   try
   {
    $result = buildingModel::findorfail($id);
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
}
