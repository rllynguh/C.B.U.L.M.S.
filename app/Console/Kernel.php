<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Bank;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    	'App\Console\Commands\UpdateBillingInterest',
        'App\Console\Commands\NotifyContractStatus',
        'App\Console\Commands\DailyNotificationHandler'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    	$schedule->command('billing_interest:update')->everyMinute()->sendOutputTo(storage_path('logs/output.log'));
        $schedule->command('notfication:handle')->daily();
        $schedule->command('contract_status:notify')->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
    	$this->load(__DIR__.'/Commands');
    	require base_path('routes/console.php');
    }
}
