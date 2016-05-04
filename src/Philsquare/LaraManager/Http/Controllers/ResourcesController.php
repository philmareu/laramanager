<?php

namespace Philsquare\LaraManager\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Philsquare\LaraManager\Form\FormProcessor;
use Philsquare\LaraManager\Fields\FieldProcessor;
use Philsquare\LaraManager\Models\File;
use Philsquare\LaraManager\Models\Object;
use Philsquare\LaraManager\Models\Resource;
use Philsquare\LaraManager\Repositories\EntityRepository;
use Philsquare\LaraManager\Repositories\ResourceRepository;

class ResourcesController extends Controller
{
    protected $slug;

    protected $resourceRepository;

    protected $entityRepository;

    public function __construct(Request $request, ResourceRepository $resourceRepository, EntityRepository $entityRepository)
    {
        $this->slug = $request->segment(2);
        $this->resourceRepository = $resourceRepository;
        $this->entityRepository = $entityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resource = $this->resourceRepository->getBySlug($this->slug);

        return view('laramanager::resource.index.index')
            ->with('resource', $resource)
            ->with('entities', $this->entityRepository->getList($resource));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resource = $this->resource->with('fields')->where('slug', $this->slug)->first();

        $hasWysiwyg = $hasHTML = false;

        foreach($resource->fields as $field)
        {
            if($field->type == 'wysiwyg') $hasWysiwyg = true;

            if($field->type == 'html') $hasHTML = true;

            if($field->type == 'relational')
            {
                $model = $field->data('model');
                $options[$field->slug] = $model::all()->lists($field->data('title'), $field->data('key'));
            }
        }

        return view('laramanager::resource.create', compact('resource', 'hasWysiwyg', 'options', 'hasHTML'));
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
        $fieldProcessor = new FieldProcessor($request, $resource);

        $this->validate($request, $this->validationRules($resource));

        $model = $this->getModel($resource);
        $entity = new $model;
        $request = $fieldProcessor->processAttributes();

        $entity = $entity->create($request->all());

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
        $resource = $this->resource->with('fields')->where('slug', $this->slug)->first();
        $model = $this->getModel($resource);
        $entity = $model::with('objects')->where('id', $resourceId)->first();
        $objects = Object::all();

        return view('laramanager::resource.show', compact('resource', 'entity', 'objects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($entityId)
    {
        $resource = $this->resource->with('fields')->where('slug', $this->slug)->first();
        $model = $this->getModel($resource);
        $entity = $model::find($entityId);
        $hasWysiwyg = $hasHTML= false;

        foreach($resource->fields as $field)
        {
            if($field['type'] == 'wysiwyg') $hasWysiwyg = true;

            if($field->type == 'html') $hasHTML = true;

            if($field->type == 'relational')
            {
                $model = $field->data('model');
                $options[$field->slug] = $model::all()->lists($field->data('title'), $field->data('key'));
            }
        }

        return view('laramanager::resource.edit', compact('resource', 'hasWysiwyg', 'entity', 'options', 'hasHTML'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $entityId)
    {
        $resource = $this->resource->with('fields')->where('slug', $this->slug)->first();
        $fieldProcessor = new FieldProcessor($request, $resource);
        $model = $this->getModel($resource);

        $entity = $model::findOrFail($entityId);

        $this->validate($request, $this->validationRules($resource, $entity));

        $request = $fieldProcessor->processAttributes();

        $entity->update($request->all());

        if(method_exists($model, 'objects')) return redirect('admin/' . $resource->slug . '/' . $entity->id)->with('success', 'Updated');

        return redirect()->back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($entityId)
    {
        $resource = $this->resource->with('fields')->where('slug', $this->slug)->first();
        $model = $this->getModel($resource);
        $entity = $model::findOrFail($entityId);
        
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
        $output['data']['html'] = view('laramanager::partials.elements.form.displays.file', compact('file'))->render();

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
}
