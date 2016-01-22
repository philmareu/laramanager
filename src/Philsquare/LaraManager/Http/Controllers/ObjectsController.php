<?php namespace Philsquare\LaraManager\Http\Controllers; 

use Illuminate\Http\Request;
use Philsquare\LaraManager\Models\Object;

class ObjectsController extends Controller {

    public function create($resource, $resourceId, $objectId)
    {
        $model = config('laramanager.models_namespace') . '\\' . config('laramanager.resources.' . $resource . '.model');
        $entity = $model::find($resourceId);

        $object = Object::find($objectId);

        return view('laramanager::objects.create.' . $object->slug, compact('resource', 'entity', 'object'));
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

        $model = config('laramanager.models_namespace') . '\\' . config('laramanager.resources.' . $resource . '.model');
        $entity = $model::find($resourceId);

        $object = Object::find($objectId);

        $entity->objects()->attach($object->id, ['ordinal' => 1, 'data' => serialize($request->only(['text']))]);

        return redirect('admin/' . $resource . '/' . $resourceId);
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}