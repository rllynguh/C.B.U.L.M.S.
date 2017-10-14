<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Bank;

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
        $bank=new Bank();
        $bank->description='kurusha';
        $bank->save();
    }
}
