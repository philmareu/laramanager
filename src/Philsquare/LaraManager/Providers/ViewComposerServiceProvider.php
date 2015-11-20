<?php

namespace Philsquare\LaraManager\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('laramanager::navigations.top.index', 'Philsquare\LaraManager\ViewComposers\NavigationComposer');
        view()->composer('laramanager::navigations.primary.index', 'Philsquare\LaraManager\ViewComposers\NavigationComposer');
    }

    public function register()
    {

    }
}