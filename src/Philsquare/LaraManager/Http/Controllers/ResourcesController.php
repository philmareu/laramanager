<?php

namespace Philsquare\LaraManager\Http\Controllers;

use Illuminate\Http\Request;

use Laradev\Http\Requests;
use Laradev\Http\Controllers\Controller;

class ResourcesController extends Controller
{
    protected $request;

    protected $resource;

    protected $fields;

    protected $title;

    protected $modelsNamespace;

    public function __construct(Request $request)
    {
        $this->resource = $request->segment(2);
        $this->fields = config('laramanager.resources.' . $this->resource . '.fields');
        $this->title = config('laramanager.resources.' . $this->resource . '.title');
        $this->modelsNamespace = config('laramanager.models_namespace') . '\\';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->title;
        $fields = $this->fields;
        $resource = $this->resource;
        $model = $this->modelsNamespace . config('laramanager.resources.' . $this->resource . '.model');
        $entities = $model::all();

        return view('laramanager::resource.index', compact('resource', 'entities', 'fields', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->title;
        $fields = $this->fields;
        $resource = $this->resource;

        return view('laramanager::resource.create', compact('resource', 'title', 'fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules($this->fields));
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
        $title = $this->title;
        $fields = $this->fields;
        $resource = $this->resource;
        $model = $this->modelsNamespace . config('laramanager.resources.' . $this->resource . '.model');
        $entity = $model::find($resourceId);

        return view('laramanager::resource.edit', compact('title', 'fields', 'resource', 'entity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    private function validationRules($fields)
    {
        foreach($fields as $name => $settings)
        {
            $rules[$name] = $settings['validation'];
        }

        return isset($rules) ? $rules : [];
    }
}
