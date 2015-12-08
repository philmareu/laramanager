<?php

namespace Philsquare\LaraManager\Providers;

use Illuminate\Support\Facades\Validator;
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

        $this->assetsToPublish();

        $this->setViewComposers();

        $this->loadTranslationsFrom(
            __DIR__.'/../../../lang',
            'laramanager'
        );

        Validator::extend(
            'unique_except_this_id', 'Philsquare\LaraManager\Validators\Validator@validateUniqueExceptThisId',
            trans('laramanager::validation.unique_except_this_id')
        );

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

    private function assetsToPublish()
    {
        $this->publishes([
            __DIR__.'/../../../assets/css/styles.css' => public_path('vendor/laramanager/css/styles.css'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/../../../assets/css/datatables.css' => public_path('vendor/laramanager/css/datatables.css'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/../../../assets/js/scripts.js' => public_path('vendor/laramanager/js/scripts.js'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/../../../assets/js/datatables.js' => public_path('vendor/laramanager/js/datatables.js'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/../../../assets/fonts/' => public_path('vendor/laramanager/fonts/'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/../../../database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../../../config/config.php' => config_path('laramanager.php'),
        ], 'config');
    }

    private function setViewComposers()
    {
        view()->composer('laramanager::navigations.top.index', 'Philsquare\LaraManager\ViewComposers\NavigationComposer');
        view()->composer('laramanager::navigations.primary.*', 'Philsquare\LaraManager\ViewComposers\NavigationComposer');
    }
}
