<?php

namespace Philsquare\LaraManager\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class LaraManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__ . '/../Http/routes.php';
        }

        $router->middleware('admin', \Philsquare\LaraManager\Http\Middleware\AdminMiddleware::class);
        $router->middleware('guest.admin', \Philsquare\LaraManager\Http\Middleware\RedirectIfAuthenticated::class);

        $this->loadViewsFrom(__DIR__.'/../../../views', 'laramanager');

        $this->assetsToPublish();

        $this->setViewComposers();

        $this->loadTranslationsFrom(__DIR__.'/../../../lang', 'laramanager');

        $this->setCustomValidation();
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
            __DIR__ . '/../../../assets/' => public_path('vendor/laramanager/'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/../../../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }

    private function setViewComposers()
    {
        view()->composer('laramanager::navigations.top.index', 'Philsquare\LaraManager\ViewComposers\NavigationComposer');
        view()->composer('laramanager::navigations.primary.*', 'Philsquare\LaraManager\ViewComposers\NavigationComposer');
        view()->composer('layouts.*', 'Philsquare\LaraManager\ViewComposers\LayoutsViewComposer');
    }

    private function setCustomValidation()
    {
        Validator::extend(
            'unique_except_this_id', 'Philsquare\LaraManager\Validators\Validator@validateUniqueExceptThisId',
            trans('laramanager::validation.unique_except_this_id')
        );
    }
}
