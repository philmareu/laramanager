<?php

namespace Philsquare\LaraManager\Http\Controllers\Auth;


use Illuminate\Support\Facades\Auth;
use Philsquare\LaraManager\Http\Controllers\Controller;
use Philsquare\LaraManager\Http\Requests\SubmitInstallSettingsRequest;

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

        Auth::login($user);

        return redirect('admin');
    }
}