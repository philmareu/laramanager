<?php namespace Philsquare\LaraManager\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Philsquare\LaraManager\Models\File;
use Philsquare\LaraManager\Models\Image;
use Philsquare\LaraManager\Models\Object;
use Philsquare\LaraManager\Models\Resource;

class ResourceObjectsController extends Controller {

    protected $resource;

    protected $image;

    public function __construct(Resource $resource, Image $image)
    {
        $this->resource = $resource;
        $this->image = $image;
    }

    public function create($resource, $resourceId, $objectId)
    {
        $resource = $this->resource->with('fields')->where('slug', $resource)->first();
        $model = $this->getModel($resource);
        $entity = $model::find($resourceId);
        $object = Object::find($objectId);
        $images = $this->image->latest()->get();

        return view('laramanager::objects.wrappers.create', compact('object', 'resource', 'entity', 'object', 'images'));
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

        $entity->objects()->attach($object->id, ['label' => $request->label, 'ordinal' => 100, 'data' => serialize($request->only(['data']))]);

        return redirect('admin/' . $resource->slug . '/' . $resourceId);
    }

    public function edit($resource, $resourceId, $objectableId)
    {
        $resource = $this->resource->with('fields')->where('slug', $resource)->first();
        $model = $this->getModel($resource);
        $entity = $model::find($resourceId);

        $object = $entity->objects()->where('objectables.id', $objectableId)->first();
        $images = $this->image->latest()->get();

        return view('laramanager::objects.wrappers.edit', compact('object', 'resource', 'entity', 'object', 'images'));
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