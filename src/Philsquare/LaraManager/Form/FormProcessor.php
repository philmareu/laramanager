<?php

namespace Philsquare\LaraManager\Form;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FormProcessor {

    protected $files;

    public function __construct(Files $files)
    {
        $this->files = $files;
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     * @return string
     */
    public function processFile(UploadedFile $file, $folder, $existing = null)
    {
        if($existing) $this->files->destroyFile($folder . '/' . $existing);

        $ext = $file->getClientOriginalExtension();
        $filename = $this->files->createFilename($ext, $folder);
        $file->move(storage_path('app/' . $folder), $filename);

        return $filename;
    }

    public function setCheckboxValues(Request $request, $names)
    {
        $values = [];

        foreach($names as $name)
        {
            $values[$name] = $request->has($name) ? 1 : 0;
        }

        return $values;
    }

}