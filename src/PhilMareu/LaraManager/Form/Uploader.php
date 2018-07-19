<?php

namespace PhilMareu\Laramanager\Form;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Uploader {

    /**
     * @param UploadedFile $file
     * @param string $path
     * @return string
     */
    public function upload(UploadedFile $file, $folder, $existing = null)
    {
        if($existing) $this->destroyFile($folder . '/' . $existing);

        return Upload::make($file, $folder)->generateNewFilename()->move();
    }

    protected function destroyFile($filenamePath)
    {
        if(Storage::has($filenamePath)) Storage::delete($filenamePath);
    }
}