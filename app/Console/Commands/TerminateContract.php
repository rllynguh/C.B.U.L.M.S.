<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class TerminateContract extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contract:terminate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Terminates contract of unsettled accounts for a period';

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
      $utilities=DB::table('utilities')
      ->whereRaw('date_as_of=(Select Max(date_as_of) from utilities)')
      ->select('utilities.*')
      ->first();

      $gap=$utilities->days_before_termination;

      $contracts=DB::TABLE('contract_headers')
      ->JOIN('current_contracts','contract_headers.id','current_contracts.contract_header_id')
      ->JOIN('billing_headers','current_contracts.id','billing_headers.current_contract_id')
      ->LEFTJOIN('payments','billing_headers.id','payments.id')
      ->SELECT(DB::RAW('SUM(COALESCE(payments.payment,0)) as payment,contract_headers.id as contract_header_id,DATEDIFF(CURRENT_DATE,billing_headers.date_issued) as gap,current_contracts.id as current_contract_id'))
      ->HAVINGRAW("payment=0 and gap>$gap")
      ->GET();

  }
}
