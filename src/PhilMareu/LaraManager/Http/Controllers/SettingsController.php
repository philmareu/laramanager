<?php namespace PhilMareu\LaraManager\Http\Controllers;

use PhilMareu\LaraManager\Http\Requests\CreateSettingRequest;
use PhilMareu\LaraManager\Http\Requests\UpdateSettingRequest;
use PhilMareu\LaraManager\Models\LaramanagerSetting;

class SettingsController extends Controller {

    protected $setting;

    public function __construct(LaramanagerSetting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        $settings = $this->setting->all();

        return view('laramanager::settings.index', compact('settings'));
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function show()
    {

    }

    public function edit($settingId)
    {
        $setting = $this->setting->findOrFail($settingId);

        return view('laramanager::settings.edit', compact('setting'));
    }

    public function update(UpdateSettingRequest $request, $settingId)
    {
        $setting = $this->setting->findOrFail($settingId);
        $setting->update($request->only('value'));

        return redirect('admin/settings');
    }

    public function destroy()
    {

    }
}