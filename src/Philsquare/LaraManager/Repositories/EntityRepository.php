<?php namespace Philsquare\LaraManager\Repositories; 

use Illuminate\Http\Request;
use Philsquare\LaraManager\Fields\FieldProcessor;
use Philsquare\LaraManager\Fields\RelationProcessor;
use Philsquare\LaraManager\Models\Resource;

class EntityRepository {

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

        $eagerLoad = $resource->listedFields->filter(function($field) {
            return $field->type == 'relational';
        })->map(function($field, $key) {
            return $field->data['method'];
        })->all();

        $model = $this->getModel($resource);

        return $model::with($eagerLoad)->select(array_merge(['id'], $selects))->get();
    }

    public function create(Request $request, Resource $resource)
    {
        $request = $this->processFields($request, $resource);
        $model = $this->getModel($resource);
        $entity = (new $model)->create($request->all());
        $this->processRelations($request, $resource, $entity);

        return $entity;
    }

    public function update($id, Request $request, Resource $resource)
    {
        $request = $this->processFields($request, $resource);
        $entity = $this->getById($id, $resource);
        $this->processRelations($request, $resource, $entity);

        return $entity->update($request->all());
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
    private function processFields(Request $request, Resource $resource)
    {
        $fieldProcessor = new FieldProcessor($request, $resource);
        $request = $fieldProcessor->processAttributes();
        return $request;
    }

    private function processRelations(Request $request, Resource $resource, $entity)
    {
        $relationProcessor = new RelationProcessor($request, $resource, $entity);
        $relationProcessor->processRelations();
    }

}