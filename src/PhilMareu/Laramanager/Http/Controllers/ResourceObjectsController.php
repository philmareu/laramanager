<?php namespace PhilMareu\Laramanager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhilMareu\Laramanager\Models\File;
use PhilMareu\Laramanager\Models\LaramanagerObject;
use PhilMareu\Laramanager\Repositories\EntriesRepository;
use PhilMareu\Laramanager\Repositories\ResourceRepository;

class ResourceObjectsController extends Controller {

    protected $resourceRepository;

    protected $entriesRepository;

    public function __construct(ResourceRepository $resourceRepository, EntriesRepository $entriesRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->entriesRepository = $entriesRepository;
    }

    public function create($resourceSlug, $entryId, $objectId)
    {
        $resource = $this->resourceRepository->getBySlug($resourceSlug);
        $entry = $this->entriesRepository->getById($entryId, $resource);
        $object = LaramanagerObject::find($objectId);

        return view('laramanager::objects.wrappers.create', compact('object', 'resource', 'entity'));
    }

    public function store(Request $request, $resourceSlug, $entryId, $objectId)
    {
        $resource = $this->resourceRepository->getBySlug($resourceSlug);
        $entry = $this->entriesRepository->getById($entryId, $resource);
        $object = LaramanagerObject::find($objectId);

        $entry->objects()->attach($object->id, ['label' => $request->label, 'ordinal' => 100, 'data' => serialize($request->only(['data']))]);

        return redirect('admin/' . $resource->slug . '/' . $entry->id);
    }

    public function edit($resourceSlug, $entryId, $objectableId)
    {
        $resource = $this->resourceRepository->getBySlug($resourceSlug);
        $entry = $this->entriesRepository->getById($entryId, $resource);

        $object = $entry->objects()->where('laramanager_objectables.id', $objectableId)->first();

        return view('laramanager::objects.wrappers.edit', compact('object', 'resource', 'entity'));
    }

    public function update(Request $request, $resourceSlug, $entry, $objectableId)
    {
        DB::table('laramanager_objectables')->where('id', $objectableId)->update(['label' => $request->label, 'data' => serialize($request->only(['data']))]);

        return redirect('admin/' . $resourceSlug . '/' . $entry);
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