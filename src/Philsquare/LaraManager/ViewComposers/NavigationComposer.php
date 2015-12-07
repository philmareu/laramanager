<?php

namespace Philsquare\LaraManager\ViewComposers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NavigationComposer
{
    protected $auth;

    protected $request;

    public function __construct(Request $request, Guard $auth)
    {
        $this->request = $request;
        $this->auth = $auth;
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

        $view->with(compact('segment', 'segments', 'user'));
    }
}