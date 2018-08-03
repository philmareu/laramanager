<?php

namespace PhilMareu\Laramanager\Http\Controllers\Auth;


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use PhilMareu\Laramanager\Http\Controllers\Controller;
use PhilMareu\Laramanager\Http\Requests\SubmitInstallSettingsRequest;
use PhilMareu\Laramanager\Models\LaramanagerObject;
use PhilMareu\Laramanager\Models\LaramanagerSetting;
use PhilMareu\Laramanager\Seeders\FieldTypesSeeder;

class InstallController extends Controller
{
    public function showInstallForm()
    {
        return view('laramanager::auth.install');
    }

    public function processInstall(SubmitInstallSettingsRequest $request)
    {
        $userModel = config('auth.providers.users.model');

        $user = $userModel::forceCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => 1
        ]);

        LaramanagerSetting::forceCreate([
            'title' => 'Website Name',
            'slug' => 'site-name',
            'description' => 'The name of the website',
            'type' => 'text',
            'value' => config('app.name'),
            'is_core' => 1
        ]);

        Auth::login($user);

        return redirect('admin');
    }
}