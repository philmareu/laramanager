<?php

namespace Philsquare\LaraManager\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Philsquare\LaraForm\Services\FormProcessor;
use Philsquare\LaraManager\Models\File;
use Philsquare\LaraManager\Models\Object;
use Philsquare\LaraManager\Models\Resource;

class ResourcesController extends Controller
{
    protected $request;

    protected $slug;

    protected $title;

    protected $form;

    protected $resource;

    public function __construct(Request $request, FormProcessor $form, Resource $resource)
    {
        $this->slug = $request->segment(2);
        $this->form = $form;
        $this->resource = $resource;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resource = $this->resource->with('fields')->where('slug', $this->slug)->first();

        $select = ['id'];
        foreach($resource->fields as $field)
        {
            if($field->list) $select[] = $field->slug;
        }

        $model = $this->getModel($resource);
        $entities = $model::select($select)->get();

        $hasObjects = false;
        if(method_exists($model, 'objects')) $hasObjects = true;

        return view('laramanager::resource.index', compact('resource', 'entities', 'hasObjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resource = $this->resource->with('fields')->where('slug', $this->slug)->first();

        $hasWysiwyg = false;

        foreach($resource->fields as $field)
        {
            if($field['type'] == 'wysiwyg') $hasWysiwyg = true;
        }

        return view('laramanager::resource.create', compact('resource', 'hasWysiwyg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resource = $this->resource->with('fields')->where('slug', $this->slug)->first();

        $this->validate($request, $this->validationRules($resource));

        $model = $this->getModel($resource);
        $entity = new $model;
        $attributes= $request->all();

        foreach($resource->fields as $field)
        {
            if($field->type == 'checkbox')
            {
                if(! $request->has($field->slug)) $attributes[$field->slug] = 0;
            }

            if($field['type'] == 'image')
            {
                if($request->hasFile($field->slug))
                {
                    $filename = $this->form->processFile($request->file($field->slug), 'images');
                    $attr[$field->slug] = $filename;
                }
            }

            if($field->type == 'password')
            {
                $attr[$field->slug] = bcrypt($request->get($field->slug));
            }

            if($field->type == 'uploads')
            {
                $attr[$field->slug] = serialize($request->get($field->slug));
            }
        }

        $entity = $entity->create($attributes);

//        foreach(config('laramanager.resources.' . $this->resource . '.objects') as $defaultObject)
//        {
//            $object = Object::where('slug', $defaultObject['type'])->first();
//
//            $entity->objects()->attach($object->id, ['label' => $defaultObject['label']]);
//        }

        if(method_exists($model, 'objects')) return redirect('admin/' . $resource->slug . '/' . $entity->id)->with('success', 'Added');

        return redirect('admin/' . $resource->slug)->with('success', 'Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($resourceId)
    {
        $title = $this->title . ' > View';
        $fields = $this->fields;
        $resource = $this->resource;
        $model = config('laramanager.resources.' . $this->resource . '.model');
        $entity = $model::with('objects')->where('id', $resourceId)->first();
        $objects = Object::all();

        return view('laramanager::resource.show', compact('title', 'fields', 'resource', 'entity', 'objects'));
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
        $model = config('laramanager.resources.' . $this->resource . '.model');
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

        $model = config('laramanager.resources.' . $this->resource . '.model');
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

            if($field['type'] == 'uploads')
            {
                $attributes[$field['name']] = serialize($request->get($field['name']));
            }
        }

        $entity->update($attributes);

        if(method_exists($model, 'objects')) return redirect('admin/' . $this->resource . '/' . $entity->id)->with('success', 'Updated');

        return redirect()->back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = config('laramanager.resources.' . $this->resource . '.model');

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

        $model = config('laramanager.resources.' . $request->resource . '.model');
        $reference = $request->name;

        $filename = $this->form->processFile($request->file('file'), 'files');

        $file = File::create(['filename' => $filename, 'type' => 'image']);

        $entity = (new $model)->findOrFail($request->entityId);
        $entity->photos()->attach($file->id);

        $output['status'] = 'ok';
        $output['data']['html'] = view('laraform::elements.form.displays.file', compact('file'))->render();

        return response()->json($output);
    }

    public function deleteFile(Request $request)
    {
        $model = config('laramanager.resources.' . $request->resource . '.model');
        $entity = (new $model)->findOrFail($request->entityId);

        $entity->photos()->detach($request->id);

        return response()->json(['status' => 'ok']);
    }

    private function validationRules($resource, $entity = null)
    {
        foreach($resource->fields as $field)
        {
            $rule = $field->validation;

            if($field->is_unique)
            {
                $rule .= '|unique:' . $resource->slug . ',' . $field->slug;
                
                if($entity) $rule .=  ',' . $entity->id;
            }
            
            if($field->is_required) $rule .= '|required';
            
            $rules[$field->slug] = $rule;
        }

        return isset($rules) ? $rules : [];
    }

    /**
     * @param $resource
     * @return string
     */
    private function getModel($resource)
    {
        $model = $resource->namespace . '\\' . $resource->model;
        return $model;
    }
}
