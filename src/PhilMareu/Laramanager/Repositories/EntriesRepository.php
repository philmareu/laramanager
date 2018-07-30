<?php namespace PhilMareu\Laramanager\Repositories;

use Illuminate\Http\Request;
use PhilMareu\Laramanager\Fields\FieldProcessor;
use PhilMareu\Laramanager\Fields\RelationProcessor;
use PhilMareu\Laramanager\Models\LaramanagerResource;

class EntriesRepository {

    public function getById($id, $resource)
    {
        $model = $this->getModel($resource);
        return $model::where('id', $id)->first();
    }

    public function getList($resource)
    {
        $selects = $resource->listedFields->filter(function($field) {
            return $field->list == 1;
        })->map(function($field, $key) {
            return $field->slug;
        })->all();

        $eagerLoad = $resource->listedFields->map(function($field) {
            return $field->fieldType->getClass()->eagerLoad();
        })->flatten()->all();

        $model = $this->getModel($resource);

        return $model::with(empty($eagerLoad) ? [] : $eagerLoad)->select(array_merge(['id'], $selects))->get();
    }

    public function create(Request $request, LaramanagerResource $resource)
    {
        $request = $this->processFields($request, $resource);
        $model = $this->getModel($resource);
        $entry = (new $model)->forceCreate($this->filterRequest($request, $resource));
        $this->processRelations($request, $resource, $entry);

        return $entry;
    }

    public function update($id, Request $request, LaramanagerResource $resource)
    {
        $request = $this->processFields($request, $resource);
        $entry = $this->getById($id, $resource);
        $this->processRelations($request, $resource, $entry);
        $entry->forceFill($this->filterRequest($request, $resource));

        return $entry->save();
    }

    public function delete($id, $resource)
    {
        return $this->getById($id, $resource)->delete();
    }

    public function getFieldOptions($field)
    {
        $model = $field->data['model'];
        return $model::orderBy($field->data['title'], 'asc')->get()->pluck($field->data['title'], $field->data['key'])->all();
    }

    /**
     * @param $resource
     * @return string
     */
    private function getModel($resource)
    {
        return $resource->namespace . '\\' . $resource->model;
    }

    /**
     * @param Request $request
     * @param Resource $resource
     * @return Request
     */
    private function processFields(Request $request, LaramanagerResource $resource)
    {
        foreach($resource->fields as $field)
        {
            $request = $field->fieldType->getClass()->mutate($request, $field->slug);
        }

        return $request;
    }

    private function processRelations(Request $request, LaramanagerResource $resource, $entry)
    {
        foreach($resource->fields as $field)
        {
            $field->fieldType->getClass()->relations($request, $field, $entry);
        }
    }

    private function filterRequest(Request $request, LaramanagerResource $resource)
    {
        $filter = $resource->fields->filter(function($field) {
            return $field->fieldType->getClass()->filter;
        })->map(function ($field) {
            return $field->slug;
        })->merge(['_token', '_method'])->all();

        return $request->except($filter);
    }

}