<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use App\Notification;
class DailyNotificationHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:handle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Decrements notifications lifetime by 1 and deletes it if 0';

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
        $data = DB::table('notifications')
        ->where('expires_on','1')
        ->get();
        foreach ($data as $notif) {
            $notif->description = $notif->title + " expired";
            $notif->expires_on = 0;
            $notif->link="#";
            if($notif->type == 'Renewal'){
                $notif->description = "Renewal Period Expired";
            }else if($notif->type = 'Extension'){
                $notif->description = "Extension Period Expired";
            }
            $notif->save();
        }
        DB::table('notifications')
        ->whereIn('type',['Renewal','Extension'])
        ->decrement('expires_on',1);
    }
}
