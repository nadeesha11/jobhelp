<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\PackageInterface',
            'App\Repositories\PackageRepositor'
        );

        $this->app->bind(
            'App\Contracts\adsTypesInterface',
            'App\Repositories\AdsTypesRepositor'
        );

        $this->app->bind(
            'App\Contracts\AdsInterface',
            'App\Repositories\AdsRepositor'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
