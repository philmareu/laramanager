<?php

namespace PhilMareu\Laramanager\FieldTypes;


use Illuminate\Http\Request;

class TextFieldType
{
    protected $viewDirectory = 'laramanager::field_types.text';

    protected $slug = 'text';

    public function getViewDirectory()
    {
        return $this->viewDirectory;
    }

    public function mutate(Request $request)
    {

    }

    public function relationships($entry)
    {

    }
}