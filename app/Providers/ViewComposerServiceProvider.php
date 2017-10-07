<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;

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
        $user = Auth::user();
        $view->withUser($user);
    });
 }
}
