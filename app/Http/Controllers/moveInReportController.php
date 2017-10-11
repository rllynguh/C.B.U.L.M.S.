<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Config;
use DB;

class moveInReportController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('admin');
		$this->middleware('auth');
	}
	public function index()
	{
		return view('report.moveIn.index');
	}
	public function document(Request $request)
	{
		if($request->groupBy=='tenants.id')
			$category_description='tenants.description';
		else
			$category_description='date_moved_in';
		$categories=DB::TABLE('move_in_headers')
		->JOIN('move_in_details','move_in_headers.id','move_in_details.move_in_header_id')
		->JOIN('contract_details','move_in_details.contract_detail_id','contract_details.id')
		->JOIN('current_contracts','contract_details.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHEREBETWEEN('move_in_headers.date_moved_in',[$request->from,$request->to])
		->SELECT("$request->groupBy as id","$category_description as description")->GROUPBY($request->groupBy)->GET();

		if($request->groupBy=='tenants.id')
		{
			$subcategory_column='date_moved_in';
			$subcategory_description='CONCAT("Date: ",date_moved_in) as description';
		}
		else
		{
			$subcategory_column='tenants.id';
			$subcategory_description='CONCAT("Tenant: ",tenants.description) as description';

		}
		$subcategories=DB::TABLE('move_in_headers')
		->JOIN('move_in_details','move_in_headers.id','move_in_details.move_in_header_id')
		->JOIN('contract_details','move_in_details.contract_detail_id','contract_details.id')
		->JOIN('current_contracts','contract_details.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHEREBETWEEN('move_in_headers.date_moved_in',[$request->from,$request->to])
		->SELECT("$request->groupBy as category_id","$subcategory_column as subcategory_id",'move_in_headers.code',DB::RAW($subcategory_description))->GROUPBY("$subcategory_column")->GET();

		$details=DB::TABLE('move_in_details')
		->JOIN('move_in_headers','move_in_details.move_in_header_id','move_in_headers.id')
		->JOIN('contract_details','move_in_details.contract_detail_id','contract_details.id')
		->JOIN('current_contracts','contract_details.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->JOIN('units','contract_details.unit_id','units.id')
		->JOIN('floors','units.floor_id','floors.id')
		->JOIN('buildings','floors.building_id','buildings.id')
		->WHEREBETWEEN('move_in_headers.date_moved_in',[$request->from,$request->to])
		->SELECT("$subcategory_column as subcategory_id",'units.code','units.type','buildings.description as building','units.type','floors.number','units.size')
		->ORDERBY($request->orderUnitsBy)
		->GET();

		$pdf_details = array('today' => Carbon::today() );
		$pdf = PDF::loadView('report.moveIn.document', compact('pdf_details','details','categories','subcategories'));
		return $pdf->stream();
	}
}
