<?php namespace PhilMareu\LaraManager\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use PhilMareu\LaraManager\Http\Requests\CreateObjectRequest;
use PhilMareu\LaraManager\Http\Requests\UpdateObjectRequest;
use PhilMareu\LaraManager\Models\LaramanagerObject;

class ObjectsController extends Controller {

    protected $object;

    public function __construct(LaramanagerObject $object)
    {
        $this->object = $object;
    }

    public function index()
    {
        $objects = $this->object->all();

        return view('laramanager::objects.index', compact('objects'));
    }

    public function create()
    {
        return view('laramanager::objects.create');
    }

    public function store(CreateObjectRequest $request)
    {
        $this->object->create($request->all());

        return redirect('admin/objects');
    }

    public function show()
    {

    }

    public function edit($objectId)
    {
        $object = $this->object->findOrFail($objectId);

        return view('laramanager::objects.edit', compact('object'));
    }

    public function update(UpdateObjectRequest $request, $objectId)
    {
        $object = $this->object->findOrFail($objectId);
        $object->update($request->all());

        return redirect('admin/objects');
    }

    public function destroy()
    {

    }

}