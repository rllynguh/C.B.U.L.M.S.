<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;
use Carbon\Carbon;
use Config;
use Artisan;
class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //
        Auth::user()->last_log_at=Carbon::now(Config::get('app.timezone'));
        Auth::user()->save();
        $command = Artisan::call('billing_interest:update');
    }
}
