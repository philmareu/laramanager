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
        // Get resources
        $resources = Resource::with('fields')->get();

        $resources->each(function($resource, $key) {
            $resource->fields->each(function($field, $key) use ($resource) {
                if($field->type == 'images')
                {
                    if(! isset($this->data['method'])) throw new Exception('Method not defined');

                    $model = $this->getModel($resource);
                    $entities = $model::select($field->slug)->get();

                    $entities->each(function($entity, $key) use ($field) {
                        $method = $field->data['method'];
                        $imageIds = unserialize($entity->{$field->slug});

                        if(! empty($imageIds)) $entity->$method()->sync($imageIds);
                    });
                }
            });
        });
        // Go through fields
        // Move them to m2m
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
     * @param $resource
     * @return string
     */
    private function getModel($resource)
    {
        return $resource->namespace . '\\' . $resource->model;
    }
}
