<?php

namespace App\Providers;

use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);                        /*Remove this if you are use MySQL v5.7.7 and higher*/
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        SessionGuard::macro('apitoken', function(){
            return Auth::user()->getApiToken();
        });
    }
}
