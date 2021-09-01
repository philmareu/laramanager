<?php

namespace PhilMareu\Laramanager\Providers;

//use Illuminate\Contracts\Config\Repository as Config;
use Faker\Factory;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Suin\RSSWriter\Feed;

class LaramanagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');

        $this->loadViewsFrom(__DIR__.'/../../../views', 'laramanager');

        $this->assetsToPublish();

        $this->setViewComposers();

        $this->loadTranslationsFrom(__DIR__.'/../../../lang', 'laramanager');

        Validator::extend('unique_filename', 'PhilMareu\Laramanager\Validators\UniqueFilenameValidator@validate');
        Validator::extend('model_must_exist', 'PhilMareu\Laramanager\Validators\ModelMustExistValidator@validate');
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
        $this->app['router']->aliasMiddleware('admin', \PhilMareu\Laramanager\Http\Middleware\AdminMiddleware::class);
        $this->app['router']->aliasMiddleware('guest.admin', \PhilMareu\Laramanager\Http\Middleware\RedirectIfAuthenticated::class);

        $this->mergeConfigFrom(__DIR__.'/../../../config/imagecache/templates.php', 'imagecache.templates');
        $this->mergeConfigFrom(__DIR__.'/../../../config/imagecache/paths.php', 'imagecache.paths');
        config(['imagecache.route' => 'images']);
    }

    private function assetsToPublish()
    {
        $this->publishes([
            __DIR__ . '/../../../assets/' => public_path('vendor/laramanager/'),
        ], 'laramanager-assets');

        $this->publishes([
            __DIR__ . '/../../../database/migrations/' => database_path('migrations')
        ], 'laramanager-migrations');
    }

    private function setViewComposers()
    {
        view()->composer('laramanager::navigations.primary.items', 'PhilMareu\Laramanager\ViewComposers\NavigationComposer');
    }
}
