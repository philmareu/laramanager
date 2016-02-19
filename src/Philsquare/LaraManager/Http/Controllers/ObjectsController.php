<?php namespace Philsquare\LaraManager\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Philsquare\LaraManager\Models\File;
use Philsquare\LaraManager\Models\Object;
use Philsquare\LaraManager\Models\Resource;

class ObjectsController extends Controller {

    protected $resource;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    public function create($resource, $resourceId, $objectId)
    {
        $resource = $this->resource->with('fields')->where('slug', $resource)->first();
        $model = $this->getModel($resource);
        $entity = $model::find($resourceId);
        $object = Object::find($objectId);
        $files = File::latest()->get();

        if(view()->exists('vendor/laramanager/objects/' . $object->slug . '/create'))
        {
            return view('vendor/laramanager/objects/' . $object->slug . '/create', compact('resource', 'entity', 'object', 'files'));
        }

        return view('laramanager::objects.' . $object->slug . '.create', compact('resource', 'entity', 'object', 'files'));
    }

    public function store(Request $request, $resource, $resourceId, $objectId)
    {
        // validation
//        $this->validate($request, $this->validationRules($this->fields, 'store'));

//        or

//        if( ! $this->validator->isValid(Input::all(), Config::get('validation/objects.' . $object->slug)))
//        {
//            return Redirect::back()->withErrors($this->validator->getErrors())->withInput();
//        }

        $resource = $this->resource->with('fields')->where('slug', $resource)->first();
        $model = $this->getModel($resource);
        $entity = $model::find($resourceId);
        $object = Object::find($objectId);

        $entity->objects()->attach($object->id, ['label' => $request->label, 'ordinal' => 1, 'data' => serialize($request->only(['data']))]);

        return redirect('admin/' . $resource->slug . '/' . $resourceId);
    }

    public function edit($resource, $resourceId, $objectableId)
    {
        $resource = $this->resource->with('fields')->where('slug', $resource)->first();
        $model = $this->getModel($resource);
        $entity = $model::find($resourceId);

        $object = $entity->objects()->where('objectables.id', $objectableId)->first();
        $files = File::latest()->get();

        if(view()->exists('vendor/laramanager/objects/' . $object->slug . '/edit'))
        {
            return view('vendor/laramanager/objects/' . $object->slug . '/edit', compact('resource', 'entity', 'object', 'files'));
        }

        return view('laramanager::objects.' . $object->slug . '.edit', compact('resource', 'entity', 'object', 'data', 'files'));
    }

    public function update(Request $request, $resource, $resourceId, $objectableId)
    {
        DB::table('objectables')->where('id', $objectableId)->update(['label' => $request->label, 'data' => serialize($request->only(['data']))]);

        return redirect('admin/' . $resource . '/' . $resourceId);
    }

    public function destroy()
    {

    }

    public function reorder(Request $request)
    {
        foreach($request->get('ids') as $ordinal => $id)
        {
            DB::table('objectables')->where('id', $id)->update([
                'ordinal' => $ordinal
            ]);
        }
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