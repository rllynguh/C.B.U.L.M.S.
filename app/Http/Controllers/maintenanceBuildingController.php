<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Building;
use App\Floor;
use DB;
class maintenanceBuildingController extends Controller
{
     public function manageItemAjax()
    {
        return view('maintenance.test');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=DB::table("buildings")
        ->select("addresses.*","cities.description as city_description", 'provinces.*' ,'buildings.*')
        ->join('addresses','buildings.address_id','addresses.id')
        ->join('cities','addresses.city_id',"cities.id")
        ->join('provinces','cities.province_id',"provinces.id")
        ->select('cities.description as city_name','buildings.code as code','buildings.description as building_name','buildings.is_active as status',
            'buildings.id as id')
        ->paginate(5);
        //$items = Building::latest()->paginate(5);
        return response()->json($result);
    }
    public function getFloors($id){
        $result=DB::table("floors")
        ->where("building_id",$id)
        ->paginate(5);
        //$result = DB::table("floors")
        return response()->json($result);
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
        $create = Building::create($request->all());
        return response()->json($create);
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
        $edit = Building::find($id)->update($request->all());
        return response()->json($edit);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = building::findorfail($id);
        try
            {
                $result->delete();
                return response()->json(['done']);
            }
            catch(\Exception $e) {
                if($e->errorInfo[1]==1451)
                    return Response::json(['true',$result->description]);
                else
                    return Response::json(['true',$result,$e->errorInfo[1]]);
            }
        return response()->json(['done']);
    }
}