<?php namespace Philsquare\LaraManager\Repositories; 

use Illuminate\Http\Request;
use Philsquare\LaraManager\Fields\FieldProcessor;
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
        $fieldProcessor = new FieldProcessor($request, $resource);
        $request = $fieldProcessor->processAttributes();

        $model = $this->getModel($resource);
        $entity = new $model;

        return $entity->create($request->all());
    }

    public function getFieldOptions($field)
    {
        $model = $field->data['model'];
        return $model::all()->lists($field->data['title'], $field->data['key'])->all();
    }

    /**
     * @param $resource
     * @return string
     */
    private function getModel($resource)
    {
        return $resource->namespace . '\\' . $resource->model;
    }

}