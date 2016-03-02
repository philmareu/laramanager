<?php

namespace Philsquare\LaraManager\ViewComposers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Philsquare\LaraManager\Models\Resource;
use Philsquare\LaraManager\Models\Setting;

class NavigationComposer
{
    protected $request;

    protected $resources;

    protected $setting;

    public function __construct(Request $request, Resource $resource, Setting $setting)
    {
        $this->request = $request;
        $this->resources = $resource;
        $this->setting = $setting;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = Auth::user();
        $segment = $this->request->segment(1);
        $segments = $this->request->segments();
        $resources = $this->resources->all();
        $settings = $this->setting->all()->pluck('value', 'slug')->all();

        $view->with(compact('segment', 'segments', 'user', 'resources', 'settings'));
    }
}