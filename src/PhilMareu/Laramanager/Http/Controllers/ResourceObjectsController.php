<?php namespace PhilMareu\Laramanager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhilMareu\Laramanager\Models\File;
use PhilMareu\Laramanager\Models\LaramanagerObject;
use PhilMareu\Laramanager\Repositories\EntityRepository;
use PhilMareu\Laramanager\Repositories\ResourceRepository;

class ResourceObjectsController extends Controller {

    protected $resourceRepository;

    protected $entityRepository;

    public function __construct(ResourceRepository $resourceRepository, EntityRepository $entityRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->entityRepository = $entityRepository;
    }

    public function create($resourceSlug, $entityId, $objectId)
    {
        $resource = $this->resourceRepository->getBySlug($resourceSlug);
        $entity = $this->entityRepository->getById($entityId, $resource);
        $object = LaramanagerObject::find($objectId);

        return view('laramanager::objects.wrappers.create', compact('object', 'resource', 'entity'));
    }

    public function store(Request $request, $resourceSlug, $entityId, $objectId)
    {
        $resource = $this->resourceRepository->getBySlug($resourceSlug);
        $entity = $this->entityRepository->getById($entityId, $resource);
        $object = LaramanagerObject::find($objectId);

        $entity->objects()->attach($object->id, ['label' => $request->label, 'ordinal' => 100, 'data' => serialize($request->only(['data']))]);

        return redirect('admin/' . $resource->slug . '/' . $entity->id);
    }

    public function edit($resourceSlug, $entityId, $objectableId)
    {
        $resource = $this->resourceRepository->getBySlug($resourceSlug);
        $entity = $this->entityRepository->getById($entityId, $resource);

        $object = $entity->objects()->where('laramanager_objectables.id', $objectableId)->first();

        return view('laramanager::objects.wrappers.edit', compact('object', 'resource', 'entity'));
    }

    public function update(Request $request, $resourceSlug, $entity, $objectableId)
    {
        DB::table('laramanager_objectables')->where('id', $objectableId)->update(['label' => $request->label, 'data' => serialize($request->only(['data']))]);

        return redirect('admin/' . $resourceSlug . '/' . $entity);
    }

    public function reorder(Request $request)
    {
        foreach($request->get('ids') as $ordinal => $id)
        {
            DB::table('laramanager_objectables')->where('id', $id)->update([
                'ordinal' => $ordinal
            ]);
        }
    }
}