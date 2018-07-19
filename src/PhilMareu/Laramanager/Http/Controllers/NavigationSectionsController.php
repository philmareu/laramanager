<?php

namespace PhilMareu\Laramanager\Http\Controllers;


use PhilMareu\Laramanager\Http\Requests\StoreNavigationSectionRequest;
use PhilMareu\Laramanager\Http\Requests\UpdateNavigationSectionRequest;
use PhilMareu\Laramanager\Models\LaramanagerNavigationSection;

class NavigationSectionsController
{
    protected $navigationSection;

    public function __construct(LaramanagerNavigationSection $navigationSection)
    {
        $this->navigationSection = $navigationSection;
    }

    public function index()
    {
        return view('laramanager::navigations.admin.sections.index')
            ->withSections($this->navigationSection->all());
    }

    public function create()
    {
        return view('laramanager::navigations.admin.sections.create')
            ->withSections($this->navigationSection->all());
    }

    public function store(StoreNavigationSectionRequest $request)
    {
        $this->navigationSection->create($request->all());

        return redirect()->route('admin.laramanager-navigation-sections.index')->with('success', 'Section added');
    }

    public function edit($sectionId)
    {

        return view('laramanager::navigations.admin.sections.edit')
            ->withSection($this->navigationSection->find($sectionId));
    }

    public function update(UpdateNavigationSectionRequest $request, $sectionId)
    {
        $this->navigationSection->find($sectionId)->update($request->all());

        return redirect()->route('admin.laramanager-navigation-sections.edit', $sectionId)->with('success', 'Section updated');
    }

    public function destroy($sectionId)
    {
        if($sectionId <= 4) return response()->json(['status' => 'failed', 'message' => 'Core sections can not be deleted.']);

        $this->navigationSection->find($sectionId)->delete();

        return response()->json(['status' => 'ok']);
    }
}