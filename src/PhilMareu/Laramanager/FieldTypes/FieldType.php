<?php

namespace PhilMareu\Laramanager\FieldTypes;

use Illuminate\Http\Request;

abstract class FieldType
{
    public $filter = false;

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
        return $entry;
    }
}