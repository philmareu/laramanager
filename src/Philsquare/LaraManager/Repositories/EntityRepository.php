<?php namespace Philsquare\LaraManager\Repositories; 

class EntityRepository {

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

        return $model::with($eagerLoad)->select($selects)->get();
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