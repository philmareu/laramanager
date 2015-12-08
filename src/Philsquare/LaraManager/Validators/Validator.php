<?php

namespace Philsquare\LaraManager\Validators;

use Illuminate\Http\Request;

class Validator
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validateUniqueExceptThisId($attribute, $value, $parameters, $validator)
    {
        $id = $this->request->segment(3);

//        dd($validator);

        $val = \Illuminate\Support\Facades\Validator::make([$attribute => $value], [
            $attribute => "unique:$parameters[0],$parameters[1],$id"
        ]);

        return $val->passes();
    }
}