<?php

namespace PhilMareu\LaraManager\Validators;

use Illuminate\Http\Request;

class ModelMustExistValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        return class_exists($this->getNamespace($validator) . '\\' . $value);
    }

    private function getNamespace($validator)
    {
        return $validator->getData()['namespace'];
    }
}