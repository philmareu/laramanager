<?php

namespace Philsquare\LaraManager\ViewComposers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Philsquare\LaraManager\Models\LaramanagerNavigationSection;
use Philsquare\LaraManager\Models\LaramanagerResource;
use Philsquare\LaraManager\Models\LaramanagerSetting;

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