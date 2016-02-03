<?php namespace Philsquare\LaraManager\Http\Controllers; 

use Illuminate\Http\Request;
use Philsquare\LaraManager\Models\Resource;
use Philsquare\LaraManager\Models\ResourceField;

class ResourceFieldController extends Controller {

    protected $fields = [
        '0' => 'Select Field',
        'text' => 'Text',
        'email' => 'Email',
        'slug' => 'Slug'
    ];

    protected $resource;

    protected $resourceField;

    public function __construct(Resource $resource, ResourceField $resourceField)
    {
        $this->resource = $resource;
        $this->resourceField = $resourceField;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($resourceId)
    {
        $resource = $this->resource->with('fields')->where('id', $resourceId)->first();

        return view('laramanager::resources.fields.index', compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($resourceId)
    {
        $resource = $this->resource->find($resourceId);

        return view('laramanager::resources.fields.create', ['resource' => $resource, 'fields' => $this->fields]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $resourceId)
    {
        $resource = $this->resource->find($resourceId);

        $this->validate($request, [
            'title' => 'required|max:255',
            'slug' => 'required|max:255',
            'validation' => '',
            'is_unique' => 'boolean',
            'is_required' => 'boolean',
            'type' => 'required',
            'data' => 'array'
        ]);

        $resource->fields()->create($request->all());

        return redirect('admin/resources/' . $resourceId . '/fields')->with('success', 'Field added');
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
    public function edit($resourceId, $fieldId)
    {
        $resource = $this->resource->find($resourceId);
        $field = $this->resourceField->find($fieldId);

        return view('laramanager::resources.fields.edit', [
            'resource' => $resource,
            'fields' => $this->fields,
            'field' => $field
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $resourceId, $fieldId)
    {
        $field = $this->resourceField->find($fieldId);

        $this->validate($request, [
            'title' => 'required|max:255',
            'slug' => 'required|max:255',
            'validation' => '',
            'is_unique' => 'boolean',
            'is_required' => 'boolean',
            'type' => 'required',
            'data' => 'array'
        ]);

        $attributes = $request->all();
        $attributes['is_required'] = $request->has('is_required') ? 1 : 0;
        $attributes['is_unique'] = $request->has('is_unique') ? 1 : 0;

        $field->update($attributes);

        return redirect('admin/resources/' . $resourceId . '/fields/' . $field->id . '/edit')->with('success', 'Field updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($fieldId)
    {
        $field = $this->resourceField->find($fieldId);

        $field->delete();

        return response()->json(['status' => 'ok']);
    }

    public function getOptions($type)
    {
        $view = '';

        if(view()->exists('laramanager::fields.' . $type . '.options')) $view = view('laramanager::fields.' . $type . '.options')->render();

        return response()->json(['data' => ['html' => $view]]);
    }

}