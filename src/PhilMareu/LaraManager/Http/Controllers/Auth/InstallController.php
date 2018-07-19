<?php

namespace PhilMareu\LaraManager\Http\Controllers\Auth;


use Illuminate\Support\Facades\Auth;
use PhilMareu\LaraManager\Http\Controllers\Controller;
use PhilMareu\LaraManager\Http\Requests\SubmitInstallSettingsRequest;
use PhilMareu\LaraManager\Models\LaramanagerObject;
use PhilMareu\LaraManager\Models\LaramanagerSetting;

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

        LaramanagerObject::create([
            'title' => 'Text',
            'slug' => 'text',
            'description' => 'Basic text field'
        ]);

        LaramanagerObject::create([
            'title' => 'WYSIWYG',
            'slug' => 'wysiwyg',
            'description' => 'Full editor'
        ]);

        LaramanagerObject::create([
            'title' => 'Photo Gallery',
            'slug' => 'photo_gallery',
            'description' => 'Capture photos for the use in a gallery, slider, etc.'
        ]);

        LaramanagerObject::create([
            'title' => 'Embed',
            'slug' => 'embed',
            'description' => 'Embed something...'
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