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
        foreach($this->resource->fields as $field)
        {
            if(method_exists($this, $field->type))
            {
                $this->{$field->type}($field->slug);
            }

        }

        return $this->request;
    }

    public function password($slug)
    {
        $value = $this->request->get($slug);

        if($value == "") $this->request->offsetUnset($slug);

        else $this->request->offsetSet($slug, bcrypt($value));
    }

    public function checkbox($slug)
    {
        if($this->request->has($slug)) $this->request->offsetSet($slug, 1);
        else $this->request->offsetSet($slug, 0);
    }
}