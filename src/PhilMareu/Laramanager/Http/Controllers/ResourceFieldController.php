<?php namespace PhilMareu\Laramanager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use PhilMareu\Laramanager\Models\LaramanagerFieldType;
use PhilMareu\Laramanager\Models\LaramanagerResource;
use PhilMareu\Laramanager\Models\LaramanagerResourceField;

class ResourceFieldController extends Controller {

    protected $fieldTypes;

    protected $resource;

    protected $resourceField;

    public function __construct(LaramanagerFieldType $fieldType, LaramanagerResource $resource, LaramanagerResourceField $resourceField)
    {
        $this->fieldTypes = $fieldType->where('active', 1)->orderBy('title')->get();
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

        return view('laramanager::resources.fields.create', ['resource' => $resource, 'fieldTypes' => $this->fieldTypes]);
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
            'validation' => 'required',
            'is_unique' => 'boolean',
            'is_required' => 'boolean',
            'field_type_id' => 'required|in:' . $this->fieldTypes->implode('id', ','),
            'data' => 'array'
        ]);

        $attributes = $this->serializeData($request);

        $resource = $resource->fields()->make($attributes);
        $resource->fieldType()->associate(
            $this->fieldTypes->where('id', $request->field_type_id)->first()
        );
        $resource->save();

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
            'fieldTypes' => $this->fieldTypes,
            'field' => $field,
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
            'field_type_id' => 'required|in:' . $this->fieldTypes->implode('id', ','),
            'data' => 'array'
        ]);

        $attributes = $this->serializeData($request);
        $attributes['is_unique'] = $request->has('is_unique') ? 1 : 0;
        $attributes['list'] = $request->has('list') ? 1 : 0;

        $field->fieldType()->associate(
            $this->fieldTypes->where('id', $request->field_type_id)->first()
        );
        $field->save();

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

    public function getOptions($fieldTypeId)
    {
        $fieldType = $this->fieldTypes->where('id', $fieldTypeId)->first();

        return response()->json(['data' => ['html' => $fieldType->getOptionView()]]);
    }

    public function serializeData(Request $request)
    {
        $attributes = $request->all();

        if($request->has('data')) $attributes['data'] = serialize($request->data);

        return $attributes;
    }
}