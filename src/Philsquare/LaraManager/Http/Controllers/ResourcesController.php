<?php

namespace Philsquare\LaraManager\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Philsquare\LaraForm\Services\FormProcessor;

class ResourcesController extends Controller
{
    protected $request;

    protected $resource;

    protected $fields;

    protected $title;

    protected $modelsNamespace;

    protected $model;

    protected $form;

    public function __construct(Request $request, FormProcessor $form)
    {
        $this->resource = $request->segment(2);
        $this->fields = config('laramanager.resources.' . $this->resource . '.fields');
        $this->title = config('laramanager.resources.' . $this->resource . '.title');
        $this->modelsNamespace = config('laramanager.models_namespace') . '\\';
        $this->form = $form;
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

        $select = ['id'];
        foreach($this->fields as $field)
        {
            if(isset($field['list']) && $field['list'] === true) $select[] = $field['name'];
        }

        $resource = $this->resource;
        $model = $this->modelsNamespace . config('laramanager.resources.' . $this->resource . '.model');
        $entities = $model::select($select)->get();

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

        $model = $this->modelsNamespace . config('laramanager.resources.' . $this->resource . '.model');
        $entity = (new $model)->create();

        return view('laramanager::resource.create', compact('resource', 'title', 'fields', 'hasWysiwyg', 'entity'));
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
        $entity = new $model;
        $attr = $request->all();

        foreach($this->fields as $field)
        {
            if($field['type'] == 'image')
            {
                if($request->hasFile($field['name']))
                {
                    $filename = $this->form->processFile($request->file($field['name']), 'images');
                    $attr[$field['name']] = $filename;
                }
            }

            if($field['type'] == 'password')
            {
                $attr[$field['name']] = bcrypt($request->get($field['name']));
            }
        }

        if($entity->create($attr)) return redirect('admin/' . $this->resource)->with('success', 'Added');

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

        $attributes = $request->all();

        foreach($this->fields as $field)
        {
            if($field['type'] == 'checkbox')
            {
                if(! $request->has($field['name'])) $attributes[$field['name']] = 0;
            }

            if($field['type'] == 'image')
            {
                if($request->hasFile($field['name']))
                {
                    $filename = $this->form->processFile($request->file($field['name']), 'images', $entity->{$field['name']});
                    $attributes[$field['name']] = $filename;
                }
            }

            if($field['type'] == 'password')
            {
                $attributes[$field['name']] = bcrypt($request->get($field['name']));
            }
        }

        if($entity->update($attributes)) return redirect()->back()->with('success', 'Updated');

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

    public function uploads(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => $request->validation
        ]);

        if($validator->fails()) return response()->json(['status' => 'failed']);

        $model = $this->modelsNamespace . config('laramanager.resources.' . $request->resource . '.model');
        $reference = $request->name;

        $filename = $this->form->processFile($request->file('file'), 'files');

        $file = $this->modelsNamespace . 'File';
        $file = (new $file)->create(['filename' => $filename]);

        $entity = (new $model)->findOrFail($request->entityId);
        $entity->$reference()->save($file);

        $output['status'] = 'ok';
        $output['data']['html'] = view('laraform::elements.form.displays.file', compact('file'))->render();

        return response()->json($output);
    }

    public function deleteFile(Request $request)
    {
        $model = $this->modelsNamespace . 'File';
        $file = (new $model)->findOrFail($request->id);
        $file->delete();

        if(Storage::delete('files/' . $file->filename)) return response()->json(['status' => 'ok']);

        return response()->json(['status' => 'failed']);
    }

    private function validationRules($fields, $operation)
    {
        foreach($fields as $settings)
        {
            $rules[$settings['name']] = is_array($settings['validation']) ? $settings['validation'][$operation] : $settings['validation'];
        }

        return isset($rules) ? $rules : [];
    }
}
