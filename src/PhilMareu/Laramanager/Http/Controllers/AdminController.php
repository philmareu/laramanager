<?php

namespace PhilMareu\Laramanager\Http\Controllers;

class AdminController extends Controller {

    public function index()
    {
        return redirect('admin/dashboard');
    }

    public function dashboard()
    {
        return view('laramanager::dashboard.index');
    }

}