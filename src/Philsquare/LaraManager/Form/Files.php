<?php

namespace Philsquare\LaraManager\Form;

use Illuminate\Support\Facades\Storage;

class Files {

    /**
     * Generate random string for a filename
     *
     * @param string $ext
     * @param string $location
     * @return string
     */
    public function createFilename($ext, $location)
    {
        $filename = str_random(100) . ".$ext";

        if(Storage::exists("$location/$filename"))
        {
            $this->createFilename($ext, $location);
        }

        return $filename;
    }

    /**
     * Destroy file
     * Path is relative to /app directory
     *
     * @param $filenamepath
     */
    public function destroyFile($filenamepath)
    {
        if(Storage::has($filenamepath))
        {
            return Storage::delete($filenamepath);
        }

        return true;
    }
}