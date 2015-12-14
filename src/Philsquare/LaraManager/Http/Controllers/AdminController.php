<?php

namespace Philsquare\LaraManager\Http\Controllers;

class AdminController extends Controller {

    public function findHome()
    {
        return redirect(config('laramanager.home_uri'));
    }

}