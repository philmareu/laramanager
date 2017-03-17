<?php

namespace Philsquare\LaraManager\Providers;

//use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Suin\RSSWriter\Feed;

class LaraManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');

        $router->middleware('admin', \Philsquare\LaraManager\Http\Middleware\AdminMiddleware::class);
        $router->middleware('guest.admin', \Philsquare\LaraManager\Http\Middleware\RedirectIfAuthenticated::class);

        $this->loadViewsFrom(__DIR__.'/../../../views', 'laramanager');

        $this->assetsToPublish();

        $this->setViewComposers();

        $this->loadTranslationsFrom(__DIR__.'/../../../lang', 'laramanager');

        Validator::extend('unique_filename', 'Philsquare\LaraManager\Validators\UniqueFilenameValidator@validate');
        Validator::extend('model_must_exist', 'Philsquare\LaraManager\Validators\ModelMustExistValidator@validate');
        Validator::replacer('model_must_exist', function($message, $attribute, $rule, $parameters) {
            return trans('laramanager::validation.model_must_exist');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../../config/imagecache/templates.php', 'imagecache.templates');
        $this->mergeConfigFrom(__DIR__.'/../../../config/imagecache/paths.php', 'imagecache.paths');
        config(['imagecache.route' => 'images']);
    }

    private function assetsToPublish()
    {
        $this->publishes([
            __DIR__. '/../../../config/config.php' => config_path('laramanager.php'),
        ]);

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
        view()->composer('laramanager::layouts.*', 'Philsquare\LaraManager\ViewComposers\LayoutsViewComposer');
    }
}
