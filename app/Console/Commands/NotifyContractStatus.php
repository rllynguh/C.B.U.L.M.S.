<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use App\Notification;

class NotifyContractStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contract_status:notify';

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
        $extension_days=360;
        $renewal_days=90;


        $contracts_extension=DB::TABLE('current_contracts')
        ->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
        ->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
        ->JOIN('tenants','registration_headers.tenant_id','tenants.id')
        ->SELECT(DB::RAW('DATEDIFF(end_of_contract,CURRENT_DATE) as gap, end_of_contract,tenants.user_id,contract_headers.code'))
        ->HAVINGRAW("gap <= $extension_days and gap >$renewal_days")
        ->WHERERAW('CONCAT(contract_headers.code," Extension") not in (SELECT description from notifications)')
        ->GET();
        foreach ($contracts_extension as $contract) {
            # code...
            $date=new Carbon($contract->end_of_contract);
            $date=$date->toFormattedDateString();

            $notification=new Notification;
            $notification->user_id=$contract->user_id;
            $notification->title="Your contract will end on $date";
            $notification->description="$contract->code Extension";
            $notification->link="javascript:void(0);";
            $notification->date_issued=Carbon::now();
            $notification->save();
        }


        $contracts_renewal=DB::TABLE('current_contracts')
        ->JOIN('contract_headers','current_contracts.contract_header_id','contract_headers.id')
        ->JOIN('registration_headers','contract_headers.registration_header_id','registration_headers.id')
        ->JOIN('tenants','registration_headers.tenant_id','tenants.id')
        ->SELECT(DB::RAW('DATEDIFF(end_of_contract,CURRENT_DATE) as gap, end_of_contract,tenants.user_id,contract_headers.code'))
        ->HAVING('gap','<=',$renewal_days)
        ->WHERERAW('CONCAT(contract_headers.code," Renewal") not in (SELECT description from notifications)')
        ->GET();
        foreach ($contracts_renewal as $contract) {
            # code...
            $date=new Carbon($contract->end_of_contract);
            $date=$date->toFormattedDateString();

            $notification=new Notification;
            $notification->user_id=$contract->user_id;
            $notification->title="Your contract will end on $date";
            $notification->description="$contract->code Renewal";
            $notification->link="javascript:void(0);";
            $notification->date_issued=Carbon::now();
            $notification->save();
        }

    }
}
