<?php

namespace Philsquare\LaraManager\Http\Controllers;


use Philsquare\LaraManager\Http\Requests\StoreNavigationSectionRequest;
use Philsquare\LaraManager\Http\Requests\UpdateNavigationSectionRequest;
use Philsquare\LaraManager\Models\LaramanagerNavigationSection;

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

    public function delete(LaramanagerNavigationSection $section)
    {
        $section->delete();

        return redirect()->route('admin.laramanager-navigation-sections.index')->with('success', 'Section deleted');
    }
}