<?php namespace Philsquare\LaraManager\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Philsquare\LaraManager\Models\File;
use Philsquare\LaraManager\Models\Object;
use Philsquare\LaraManager\Repositories\EntityRepository;
use Philsquare\LaraManager\Repositories\ResourceRepository;

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
        $object = Object::find($objectId);

        return view('laramanager::objects.wrappers.create', compact('object', 'resource', 'entity'));
    }

    public function store(Request $request, $resourceSlug, $entityId, $objectId)
    {
        $resource = $this->resourceRepository->getBySlug($resourceSlug);
        $entity = $this->entityRepository->getById($entityId, $resource);
        $object = Object::find($objectId);

        $entity->objects()->attach($object->id, ['label' => $request->label, 'ordinal' => 100, 'data' => serialize($request->only(['data']))]);

        return redirect('admin/' . $resource->slug . '/' . $entity->id);
    }

    public function edit($resourceSlug, $entityId, $objectableId)
    {
        $resource = $this->resourceRepository->getBySlug($resourceSlug);
        $entity = $this->entityRepository->getById($entityId, $resource);

        $object = $entity->objects()->where('objectables.id', $objectableId)->first();

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