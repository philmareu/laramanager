<?php

namespace PhilMareu\Laramanager\FieldTypes;


use Illuminate\Http\Request;

class ImagesFieldType extends FieldType
{
    public $filter = true;

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