<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Config;
use DB;
use DateTime;

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
		$tenants=DB::TABLE('move_in_headers')
		->JOIN('move_in_details','move_in_headers.id','move_in_details.move_in_header_id')
		->JOIN('contract_details','move_in_details.contract_detail_id','contract_details.id')
		->JOIN('current_contracts','contract_details.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHEREBETWEEN('move_in_headers.date_moved_in',[$request->from,$request->to])
		->SELECT("tenants.id as tenant_id","tenants.description")->GROUPBY('tenants.id')->GET();

		$headers=DB::TABLE('move_in_headers')
		->JOIN('move_in_details','move_in_headers.id','move_in_details.move_in_header_id')
		->JOIN('contract_details','move_in_details.contract_detail_id','contract_details.id')
		->JOIN('current_contracts','contract_details.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHEREBETWEEN('move_in_headers.date_moved_in',[$request->from,$request->to])
		->SELECT("tenants.id as tenant_id","move_in_headers.id as header_id",'move_in_headers.code','move_in_headers.date_moved_in','move_in_headers.remarks')->GROUPBY("move_in_headers.id")->GET();
		foreach ($headers as $key => &$header) {
			$date = new DateTime($header->date_moved_in);
			$result = $date->format('F d,Y');
			$header->date_moved_in=$result;
			if(strlen($header->remarks)>10)
				$header->remarks=substr($header->remarks, 0, 20)."...";
			else
				$header->remarks=$header->remarks;

		}


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
		->SELECT("move_in_headers.id as header_id",'units.code','units.type','buildings.description as building','units.type','floors.number','units.size')
		->ORDERBY($request->orderUnitsBy)
		->GET();
		foreach ($details as $key => &$detail) {
			if($detail->type==0)
				$detail->type='Raw';
			else
				$detail->type='Shell';
			$detail->size=number_format($detail->size)." sqm";
		}
		$today = Carbon::today(); 
		$pdf_details = array('today' => $today, );
		$pdf_details = array('today' => Carbon::today() );
		$pdf = PDF::loadView('report.moveIn.document', compact('pdf_details','details','tenants','headers'));
		return $pdf->stream();
	}
}
