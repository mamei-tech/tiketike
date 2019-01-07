<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Locale;

class LocaleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Locale::class, function ($app) {
            return new Locale($app);
        });
    }
}
