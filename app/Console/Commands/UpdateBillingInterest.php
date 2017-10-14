<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UserBalance;
use Carbon\Carbon;
use Config;

class UpdateBillingInterest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing_interest:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Database for billing interest';

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
        $userbalance=new UserBalance();
        $userbalance->date_as_of=Carbon::now();
        $userbalance->user_id='1';
        $userbalance->balance='1';
        $userbalance->save();
        dd(Carbon::now());
    }
}
