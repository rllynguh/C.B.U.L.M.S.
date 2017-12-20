<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use DB;
use Carbon\Carbon;
use Config;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeCoreLayout();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    private function composeCoreLayout()
    {
        view()->composer('layout.*', function($view) {
            $list=DB::TABLE('notifications')
            ->WHERE('user_id',Auth::user()->id)
            ->SELECT('id','title','description','link','date_issued')
            ->WHERE('is_read',0)
            ->GET();
            $count=DB::TABLE('notifications')
            ->WHERE('user_id',Auth::user()->id)
            ->WHERE('is_read',0)
            ->COUNT('id')
            ;
            foreach ($list as $element) {
                # code...
                $myDate=new Carbon($element->date_issued);
                $element->date_issued=$element->date_issued;
            }
            $notification = (object)['count' =>$count, 'list' => $list];
            $user = Auth::user();
            $view->withUser($user)
            ->withNotification($notification)
            ;
        });
    }
}
