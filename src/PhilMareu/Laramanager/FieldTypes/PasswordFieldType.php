<?php

namespace PhilMareu\Laramanager\FieldTypes;


use Illuminate\Http\Request;

class PasswordFieldType extends FieldType
{
    /**
     * @param Request $request
     * @param $name
     * @return Request
     */
    public function mutate(Request $request, $name)
    {
        if($request->filled($name)) $request->offsetSet($name, bcrypt($request->get($name)));

        else $request->offsetUnset($name);

        return $request;
    }
}