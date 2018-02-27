<?php

namespace Philsquare\LaraManager\Http\Controllers;

use Philsquare\LaraManager\Http\Requests\StoreNavigationLinkRequest;
use Philsquare\LaraManager\Http\Requests\UpdateNavigationLinkRequest;
use Philsquare\LaraManager\Models\LaramanagerNavigationLink;
use Philsquare\LaraManager\Models\LaramanagerNavigationSection;

class NavigationLinksController
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
        return view('laramanager::navigations.admin.links.index')
            ->withLinks($this->navigationLink->with('section')->get());
    }

    public function create()
    {
        return view('laramanager::navigations.admin.links.create')
            ->withSections($this->navigationSection->all());
    }

    public function store(StoreNavigationLinkRequest $request)
    {
        $this->navigationLink->create($request->all());

        return redirect()->route('admin.laramanager-navigation-links.index')->with('success', 'Link added');
    }

    public function edit($navigationLinkId)
    {

        return view('laramanager::navigations.admin.links.edit')
            ->withLink($this->navigationLink->find($navigationLinkId)->load('section'))
            ->withSections($this->navigationSection->all());
    }

    public function update(UpdateNavigationLinkRequest $request, $navigationLinkId)
    {
        $this->navigationLink->find($navigationLinkId)->update($request->all());

        return redirect()->route('admin.laramanager-navigation-links.edit', $navigationLinkId)->with('success', 'Link updated');
    }

    public function destroy($navigationLinkId)
    {
        if($navigationLinkId <= 10) return response()->json(['status' => 'failed', 'message' => 'Core links can not be deleted.']);

        $this->navigationLink->find($navigationLinkId)->delete();

        return response()->json(['status' => 'ok']);
    }
}