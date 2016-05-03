<?php

namespace Philsquare\LaraManager\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UniqueFilenameValidator
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate($attribute, $value, $parameters, $validator)
    {
        return $this->filenameDoesNotExist($value);
    }

    private function filenameExists($filename)
    {
        return Storage::has('laramanager/images/' . $filename);
    }

    private function filenameDoesNotExist($filename)
    {
        return ! $this->filenameExists($filename);
    }
}