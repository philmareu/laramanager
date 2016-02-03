<?php

namespace Philsquare\LaraManager\ViewComposers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Philsquare\LaraManager\Models\Resource;

class NavigationComposer
{
    protected $auth;

    protected $request;

    protected $resources;

    public function __construct(Request $request, Guard $auth, Resource $resource)
    {
        $this->request = $request;
        $this->auth = $auth;
        $this->resources = $resource;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = $this->auth->user();
        $segment = $this->request->segment(1);
        $segments = $this->request->segments();
        $resources = $this->resources->all();

        $view->with(compact('segment', 'segments', 'user', 'resources'));
    }
}