<?php

namespace OpenResourceManager\Laravel;

use Illuminate\Support\ServiceProvider;

class ORMClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['ORMClient'] = $this->app->share(function($app) {
            return new ORMClient;
        });
    }
}
