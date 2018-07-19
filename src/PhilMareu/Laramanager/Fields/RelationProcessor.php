<?php namespace PhilMareu\Laramanager\Fields;

use Illuminate\Http\Request;
use PhilMareu\Laramanager\Models\LaramanagerImage;
use PhilMareu\Laramanager\Models\LaramanagerResource;

class RelationProcessor {

    protected $request;

    protected $entity;

    protected $resource;

    public function __construct(Request $request, LaramanagerResource $resource, $entity)
    {
        $this->request = $request;
        $this->entity = $entity;
        $this->resource = $resource;
    }

    public function processRelations()
    {
        foreach($this->resource->fields as $field)
        {
            if(method_exists($this, $field->type))
            {
                $this->{$field->type}($field);
            }

        }

        return $this->request;
    }

    public function images($field)
    {
        if($this->request->has($field->slug))
        {
            $entries = [];
            foreach($this->request->get($field->slug) as $key => $imageId)
            {
                $entries[$imageId] = ['ordinal' => $key];
            }

            $this->entity->{$field->data['method']}()->sync($entries);
        }
    }
}