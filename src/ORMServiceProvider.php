<?php

namespace OpenResourceManager\Laravel;

use Illuminate\Support\ServiceProvider;

class ORMServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/orm.php' => config_path('orm.php'),
        ], 'mongo');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/orm.php', 'orm');

        $this->app->singleton('orm', function ($app) {
            $config = $app->make('config');
            $host = $config->get('orm.host');
            $version = $config->get('orm.version') ?: 1;
            $port = $config->get('orm.port') ?: 80;
            $secret = $config->get('orm.secret');
            $useSSL = $config->get('orm.use_ssl') ?: false;
            return new ORMService($secret, $host, $version, $port, $useSSL);
        });
    }

    public function provides()
    {
        return ['orm'];
    }
}
