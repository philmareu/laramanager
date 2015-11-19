<?php

namespace Philsquare\LaraManager;

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
        $this->loadViewsFrom(__DIR__.'/../views', 'laramanager');

        $this->publishes([
            __DIR__.'/../assets' => public_path('vendor/laramanager'),
        ], 'public');

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/Http/routes.php';
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
