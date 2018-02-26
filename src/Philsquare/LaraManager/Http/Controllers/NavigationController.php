<?php

namespace Philsquare\LaraManager\Http\Controllers;


use Philsquare\LaraManager\Http\Requests\StoreNavigationLinkRequest;
use Philsquare\LaraManager\Http\Requests\UpdateNavigationLinkRequest;
use Philsquare\LaraManager\Models\LaramanagerNavigationLink;
use Philsquare\LaraManager\Models\LaramanagerNavigationSection;

class NavigationController
{
    protected $navigationSection;

    protected $navigationLink;

    public function __construct(LaramanagerNavigationSection $navigationSection, LaramanagerNavigationLink $navigationLink)
    {
        $this->navigationSection = $navigationSection;
        $this->navigationLink = $navigationLink;
    }

    public function index()
    {
        return view('laramanager::navigations.admin.index')
            ->withLinks($this->navigationLink->with('section')->get());
    }

    public function create()
    {
        return view('laramanager::navigations.admin.create')
            ->withSections($this->navigationSection->all());
    }

    public function store(StoreNavigationLinkRequest $request)
    {
        $this->navigationLink->create($request->all());

        return redirect()->route('admin.laramanager-navigation-links.index')->with('success', 'Link added');
    }

    public function edit($navigationLinkId)
    {

        return view('laramanager::navigations.admin.edit')
            ->withLink($this->navigationLink->find($navigationLinkId)->load('section'))
            ->withSections($this->navigationSection->all());
    }

    public function update(UpdateNavigationLinkRequest $request, $navigationLinkId)
    {
        $this->navigationLink->find($navigationLinkId)->update($request->all());

        return redirect()->route('admin.laramanager-navigation-links.index')->with('success', 'Link updated');
    }

    public function delete(LaramanagerNavigationLink $navigationLink)
    {
        $navigationLink->delete();

        return redirect()->route('admin.laramanager-navigation-links.index')->with('success', 'Link deleted');
    }
}