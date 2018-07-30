<?php

namespace PhilMareu\Laramanager\FieldTypes;

use Illuminate\Http\Request;

abstract class FieldType
{
    /**
     * The name of the relationship to eager load.
     *
     * @return array
     */
    public function eagerLoad()
    {
        return [];
    }

    public function mutate(Request $request, $name)
    {
        return $request;
    }

    public function relations(Request $request, $field, $entry)
    {
        if($request->filled($field->slug))
        {
            $entries = [];
            foreach($request->get($field->slug) as $key => $imageId)
            {
                $entries[$imageId] = ['ordinal' => $key];
            }

            $entry->{$field->data['method']}()->sync($entries);
        }
    }
}