<?php

namespace PhilMareu\LaraManager\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhilMareu\LaraManager\Repositories\ImageRepository;

class UniqueFilenameValidator
{
    protected $request;

    protected $imageRepository;

    public function __construct(Request $request, ImageRepository $imageRepository)
    {
        $this->request = $request;
        $this->imageRepository = $imageRepository;
    }

    public function validate($attribute, $value, $parameters, $validator)
    {
        $image = $this->imageRepository->getById($parameters[0]);

        if($this->filenameWasNotChanged($image->filename, $value)) return true;

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

    private function filenameWasNotChanged($old, $new)
    {
        return $old == $new;
    }
}