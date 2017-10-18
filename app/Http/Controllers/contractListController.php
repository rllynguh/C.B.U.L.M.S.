<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use DB;
use Carbon\Carbon;
use Config;
use App\Bank;
use App\PostDatedCheck;
use Response;

class contractListController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('admin');
		$this->middleware('auth');
	}
	public function data()
	{
		$contracts=DB::TABLE('current_contracts')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->JOIN('business_types','tenants.business_type_id','business_types.id')
		->SELECT('contract_headers.code','tenants.description as tenant','business_types.description as business','start_of_contract','end_of_contract','current_contracts.id')
		->GET();
		foreach ($contracts as $contract) {
			# code...
			$contract->start_of_contract=new Carbon($contract->start_of_contract);
			$contract->start_of_contract=$contract->start_of_contract->toFormattedDateString();
			$contract->end_of_contract=new Carbon($contract->end_of_contract);
			$contract->end_of_contract=$contract->end_of_contract->toFormattedDateString();


			$contract->period="$contract->start_of_contract - $contract->end_of_contract";
		}
		return Datatables::of($contracts)
		->addColumn('action', function ($data) {
			return "<a href=".route('contractList.showPDC',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>";
		})
		->rawColumns(['action'])
		->make(true)
		;
	}
	public function index()
	{
        //
		return view('transaction.contractList.index');
	}

	public function showPDC($id)
	{
		$banks=Bank::where('is_active','=','1')
		->select('description','id')
		->orderBy('description')
		->pluck('description','id');
        //
		$code=DB::TABLE('contract_headers')
		->JOIN('current_contracts','contract_headers.id','current_contracts.contract_header_id')
		->SELECT('contract_headers.code')
		->WHERE('current_contracts.id',$id)
		->FIRST()->code;
		return view('transaction.contractList.show')
		->withCode($code)
		->withId($id)
		->withBanks($banks)
		;
	}

	public function getPDCData($id)
	{
        //

		$pdcs=DB::TABLE('post_dated_checks')
		->JOIN('banks','post_dated_checks.bank_id','banks.id')
		->SELECT('post_dated_checks.id','code','for_date','banks.description','amount')
		->WHERE('post_dated_checks.status',0)
		->WHERE('post_dated_checks.current_contract_id',$id)
		->GET();
		foreach ($pdcs as $pdc) {
			# code...
			$pdc->for_date=new Carbon($pdc->for_date);
			$pdc->for_date=$pdc->for_date->toFormattedDateString();
			$pdc->amount="₱ ".number_format($pdc->amount,2);
		}
		return Datatables::of($pdcs)
		->addColumn('action', function ($data) {
			return "<button id='btnEditPDC' value='$data->id' type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></button>";
		})
		->rawColumns(['action'])
		->make(true)
		;
	}
	public function editPDC($id)
	{
		$pdc=DB::TABLE('post_dated_checks')
		->SELECT('code','for_date','bank_id','amount','post_dated_checks.id')
		->WHERE('post_dated_checks.status',0)
		->WHERE('post_dated_checks.id',$id)
		->FIRST();
		$pdc->for_date=new Carbon($pdc->for_date);
		$pdc->for_date=$pdc->for_date->toFormattedDateString();
		$pdc->amount="₱ ".number_format($pdc->amount,2);
		return response::json($pdc);
	}

	public function updatePDC($id,Request $request)
	{
		$pdc=PostDatedCheck::FINDORFAIL($id);
		$pdc->bank_id=$request->bank;
		$pdc->code=$request->code;
		$pdc->save();
	}

}