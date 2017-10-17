<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Notification;
use App\BillingNotice;
use PDF;
use Carbon\Carbon;
use Config;
use Auth;

class BillingNoticeGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing_notice:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $billing_headers=DB::TABLE('billing_headers')
        ->HAVINGRAW('MONTH(billing_headers.date_issued) = MONTH(CURRENT_DATE) AND YEAR(billing_headers.date_issued) = YEAR(CURRENT_DATE)')
        ->WHERERAW('billing_headers.id not in(SELECT billing_header_id from billing_notices)')
        ->JOIN('current_contracts','billing_headers.current_contract_id','current_contracts.id')
        ->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
        ->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
        ->JOIN('tenants','registration_headers.tenant_id','tenants.id')
        ->JOIN('users','tenants.user_id','users.id')
        ->JOIN('representatives','representatives.user_id','users.id')
        ->JOIN('representative_positions','representatives.representative_position_id','representative_positions.id')
        ->SELECT('billing_headers.id','billing_headers.date_issued','tenants.description as tenant','representative_positions.description as position','contract_headers.code as contract','users.id as user_id','billing_headers.code as billing','billing_headers.cost', DB::RAW('CONCAT(first_name," ",last_name) as representative'))
        ->GET()
        ;
        $lessor=Auth::user()->first_name." ".Auth::user()->last_name;
        foreach ($billing_headers as $billing_header) {
            # code...
            $details=DB::TABLE('billing_details')
            ->JOIN('billing_items','billing_details.billing_item_id','billing_items.id')
            ->WHERE('billing_header_id',$billing_header->id)
            ->SELECT('billing_details.id','billing_items.description','billing_details.price')
            ->GET()
            ;
            foreach ($details as $detail) {
                # code...
                $detail->price=number_format($detail->price,2);
            }
            $billing_header->date_issued=new Carbon($billing_header->date_issued);
            $billing_header->date_issued=$billing_header->date_issued->toFormattedDateString();
            $billing_header->cost=number_format($billing_header->cost,2);
            


            $pdfName=$billing_header->billing."(".Carbon::now()->toFormattedDateString().").pdf";

            $bill_notice=new BillingNotice;
            $bill_notice->billing_header_id=$billing_header->id;
            $bill_notice->pdf=$pdfName;
            $bill_notice->save();

            $notification=new Notification;
            $notification->user_id=$billing_header->user_id;
            $notification->title="Billing Notice for $billing_header->billing";
            $notification->description="The billing is due on $billing_header->date_issued";
            $notification->link=route("docs.billing-notice",$bill_notice->id);
            $notification->date_issued=Carbon::now();
            $notification->save();
            
            $location=public_path("docs/$pdfName");
            $pdf = PDF::loadView('transaction.billing.pdf',compact('billing_header','details','lessor'));
            $pdf->save($location);
        }



    }
}
