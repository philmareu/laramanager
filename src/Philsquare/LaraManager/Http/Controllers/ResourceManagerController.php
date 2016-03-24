<?php

namespace Philsquare\LaraManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Philsquare\LaraManager\Models\Resource;

class ResourceManagerController extends Controller
{
    protected $resource;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = $this->resource->all();

        return view('laramanager::resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laramanager::resources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:resources|max:255',
            'slug' => 'required|unique:resources|max:255',
            'model' => 'required|unique:resources|max:255',
            'namespace' => 'required|max:255',
            'order_column' => 'required|integer',
            'order_direction' => 'required|in:asc,desc',
            'icon' => 'required'
        ]);

        $resource = $this->resource->create($request->all());

        return redirect('admin/resources/' . $resource->id . '/fields');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($resourceId)
    {
        $resource = $this->resource->find($resourceId);

        return view('laramanager::resources.edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $resourceId)
    {
        $resource = $this->resource->find($resourceId);

        $this->validate($request, [
            'title' => 'required|unique:resources,title,' . $resourceId . '|max:255',
            'slug' => 'required|unique:resources,title,' . $resourceId . '|max:255',
            'model' => 'required|unique:resources,title,' . $resourceId . '|max:255',
            'namespace' => 'required|max:255',
            'order_column' => 'required|integer',
            'order_direction' => 'required|in:asc,desc',
            'icon' => 'required'
        ]);

        $resource->update($request->all());

        return redirect()->back()->with('success', 'Resource updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function fields($resourceId)
    {
        $resource = $this->resource->with('fields')->where('id', $resourceId);

        return view('resources.fields.index', compact('resource'));
    }
}
