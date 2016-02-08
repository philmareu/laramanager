<?php

namespace Philsquare\LaraManager\Fields;

use Illuminate\Http\Request;
use Philsquare\LaraManager\Models\Resource;

class FieldProcessor {

    protected $request;

    protected $resource;


    public function __construct(Request $request, Resource $resource)
    {
        $this->request = $request;
        $this->resource = $resource;
    }

    public function processAttributes()
    {
        $attributes = $this->request->all();
        foreach($this->resource->fields as $field)
        {
            if(method_exists($this, $field->type))
            {
                $attributes[$field->slug] = $this->{$field->type}($field->slug);
            }

        }

        return $attributes;
    }

    public function password($slug)
    {
        if($this->hasValue($slug)) return null;

        return bcrypt($this->request->get($slug));
    }

    public function checkbox($slug)
    {
        if($this->hasValue($slug)) return null;

        return $this->request->has($slug) ? 1 : 0;
    }

    public function images($slug)
    {
        if($this->hasValue($slug)) return null;

        return serialize($this->request->get($slug));
    }

    /**
     * @param $slug
     * @return bool
     */
    private function hasValue($slug)
    {
        return !$this->request->has($slug);
    }
}