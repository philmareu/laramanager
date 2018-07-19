<?php

namespace PhilMareu\Laramanager\ViewComposers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhilMareu\Laramanager\Models\LaramanagerNavigationSection;
use PhilMareu\Laramanager\Models\LaramanagerResource;
use PhilMareu\Laramanager\Models\LaramanagerSetting;

class NavigationComposer
{
    protected $request;

    protected $laramanagerNavigationSection;

    public function __construct(Request $request, LaramanagerNavigationSection $laramanagerNavigationSection)
    {
        $this->request = $request;
        $this->laramanagerNavigationSection = $laramanagerNavigationSection;
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

        $view->withRequest($this->request)
            ->withNavigationSections($this->laramanagerNavigationSection->with('links')->get())
            ->withUser($user);
    }
}