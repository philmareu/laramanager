<?php

namespace Philsquare\LaraManager\Http\Controllers;


use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    protected $request;

    protected $resource;

    protected $fields;

    protected $title;

    protected $modelsNamespace;

    protected $model;

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

        $hasWysiwyg = false;

        foreach($fields as $field)
        {
            if($field['type'] == 'wysiwyg') $hasWysiwyg = true;
        }

        return view('laramanager::resource.create', compact('resource', 'title', 'fields', 'hasWysiwyg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules($this->fields, 'store'));

        $model = $this->modelsNamespace . config('laramanager.resources.' . $this->resource . '.model');

        if((new $model)->create($request->all())) return redirect('admin/' . $this->resource)->with('success', 'Added');

        return redirect()->back()->with('failed', 'Unable to save.')->withInput();
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
        $hasWysiwyg = false;
        $title = $this->title;
        $fields = $this->fields;
        $resource = $this->resource;
        $model = $this->modelsNamespace . config('laramanager.resources.' . $this->resource . '.model');
        $entity = $model::find($resourceId);

        foreach($fields as $field)
        {
            if($field['type'] == 'wysiwyg') $hasWysiwyg = true;
        }

        return view('laramanager::resource.edit', compact('title', 'fields', 'resource', 'entity', 'hasWysiwyg'));
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
        $this->validate($request, $this->validationRules($this->fields, 'update'));

        $model = $this->modelsNamespace . config('laramanager.resources.' . $this->resource . '.model');

        $entity = (new $model)->findOrFail($id);
        if($entity->update($request->all())) return redirect()->back()->with('success', 'Updated');

        return redirect()->back()->with('failed', 'Unable to update.')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->modelsNamespace . config('laramanager.resources.' . $this->resource . '.model');

        $entity = (new $model)->findOrFail($id);
        if($entity->delete()) return response()->json(['status' => 'ok']);

        return response()->json(['status' => 'failed']);
    }

    private function validationRules($fields, $operation)
    {
        foreach($fields as $settings)
        {
            $rules[$settings['name']] = $settings['validation'][$operation];
        }

        return isset($rules) ? $rules : [];
    }
}
