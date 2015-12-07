<?php

namespace Philsquare\LaraManager\Providers;

use Illuminate\Support\ServiceProvider;

class LaraManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../../views', 'laramanager');

        $this->publishes([
            __DIR__.'/../../../assets/css/styles.css' => public_path('vendor/laramanager/css/styles.css'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../../../assets/css/datatables.css' => public_path('vendor/laramanager/css/datatables.css'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../../../assets/js/scripts.js' => public_path('vendor/laramanager/js/scripts.js'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../../../assets/js/datatables.js' => public_path('vendor/laramanager/js/datatables.js'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../../../assets/fonts/' => public_path('vendor/laramanager/fonts/'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../../../database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../../../config/config.php' => config_path('laramanager.php'),
        ], 'config');

        if (! $this->app->routesAreCached()) {
            require __DIR__ . '/../Http/routes.php';
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
