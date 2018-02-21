<?php

namespace Philsquare\LaraManager\Http\Controllers\Auth;


use Illuminate\Support\Facades\Auth;
use Philsquare\LaraManager\Http\Controllers\Controller;
use Philsquare\LaraManager\Http\Requests\SubmitInstallSettingsRequest;
use Philsquare\LaraManager\Models\LaramanagerObject;

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

        Auth::login($user);

        return redirect('admin');
    }
}