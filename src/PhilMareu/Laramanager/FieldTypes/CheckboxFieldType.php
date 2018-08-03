<?php

namespace PhilMareu\Laramanager\FieldTypes;


use Illuminate\Http\Request;

class CheckboxFieldType extends FieldType
{
    public function mutate(Request $request, $name)
    {
        $request->offsetSet($name, $request->has($name));

        return $request;
    }
}