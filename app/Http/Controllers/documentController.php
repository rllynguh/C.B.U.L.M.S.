<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class documentController extends Controller
{
	public function __construct()
	{
		$this->middleware('tenant');
		$this->middleware('auth');
	}
    //
	public function ReservationFee($id)
	{
		$document=DB::TABLE('registration_headers')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHERE('tenants.user_id',Auth::user()->id)
		->SELECT('registration_headers.id','pdf','registration_headers.code')
		->WHERE('registration_headers.id',$id)
		->FIRST();
		$document->title='Reservation Fee Receipt';
		$document->url=route("docs.reservation-fee-receipt",$document->id);

		return VIEW('document.index')
		->withDocument($document);
	}
	public function BillingNotice($id)
	{
		$document=DB::TABLE('billing_notices')
		->JOIN('billing_headers','billing_notices.billing_header_id','billing_headers.id')
		->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHERE('tenants.user_id',Auth::user()->id)
		->WHERE('billing_notices.id',$id)
		->SELECT('billing_headers.code','billing_notices.id','billing_notices.pdf')
		->FIRST();
		$document->title='Reservation Fee Receipt';
		$document->url=route("docs.billing-notice",$document->id);
		
		return VIEW('document.index')
		->withDocument($document);
	}
	

	public function collectionReceipt($id)
	{
		$document=DB::TABLE('payments')
		->JOIN('billing_headers','payments.billing_header_id','billing_headers.id')
		->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
		->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
		->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
		->JOIN('tenants','registration_headers.tenant_id','tenants.id')
		->WHERE('tenants.user_id',Auth::user()->id)
		->WHERE('payments.id',$id)
		->SELECT('payments.code','payments.id','payments.pdf')
		->FIRST();
		$document->title='Collection Receipt';
		$document->url=route("docs.collection-receipt",$document->id);
		
		return VIEW('document.index')
		->withDocument($document);
	}
}
