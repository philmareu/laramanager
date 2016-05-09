<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Philsquare\LaraManager\Models\Resource;

class ConvertImagesSerializedFieldToM2m extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $resources = Resource::with('fields')->get();

        $resources->filter(function($resource) {
            return $resource->fields->contains(function($key, $field) {
                return $field->type == 'images';
            });
        })->each(function($resource, $key) {
            $resource->fields->filter(function($field) {
                return $field->type == 'images';
            })->each(function($field, $key) use ($resource) {
                if($this->belongsToManyMethodDoesNotExists($field)) throw new Exception('Method not defined');

                $this->getEntities($field, $resource)->each(function($entity, $key) use ($field) {
                    $this->syncImageIds($entity, $field);
                });
            });
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

    /**
     * @param $field
     * @param $resource
     * @return mixed
     */
    private function getEntities($field, $resource)
    {
        $model = $resource->namespace . '\\' . $resource->model;
        $entities = $model::select(['id', $field->slug])->get();
        return $entities;
    }

    private function belongsToManyMethodDoesNotExists($field)
    {
        return ! isset($field->data['method']);
    }

    /**
     * @param $entity
     * @param $field
     */
    private function syncImageIds($entity, $field)
    {
        $method = $field->data['method'];
        $imageIds = unserialize($entity->{$field->slug});
        if (!empty($imageIds)) $entity->$method()->sync($imageIds);
    }
}
