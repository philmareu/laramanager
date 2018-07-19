<?php namespace PhilMareu\Laramanager\Form;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Upload implements Arrayable {

    protected $uploadedFile;

    protected $filename;

    protected $original_filename;

    protected $alt;

    protected $title;

    protected $size;

    protected $extension;

    protected $folder;

    public function __construct(UploadedFile $uploadedFile, $folder)
    {
        $this->uploadedFile = $uploadedFile;
        $this->folder = $folder;
        $this->setProperties();
    }

    public static function make($uploadedFile, $folder)
    {
        return new static($uploadedFile, $folder);
    }


    public function generateNewFilename()
    {
        $this->filename = $this->generateFilename();

        return $this;
    }

    public function move()
    {
        $this->uploadedFile->move($this->folder, $this->filename);

        return $this;
    }

    private function setProperties()
    {
        $this->setFilename()
            ->setExtension()
            ->setAlt()
            ->setTitle()
            ->setSize();
    }

    /**
     * Generate random string for a filename
     *
     * @param string $ext
     * @param string $location
     * @return string
     */
    private function generateFilename()
    {
        $filename = str_random(100) . "." . $this->extension;

        if(Storage::exists($this->folder . '/' . $filename))
        {
            $this->generateFilename();
        }

        return $filename;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'filename' => $this->filename,
            'original_filename' => $this->original_filename,
            'title' => $this->title,
            'alt' => $this->alt,
            'description' => '',
            'size' => $this->size,
            'extension' => $this->extension
        ];
    }

    private function setFilename()
    {
        $this->filename = $this->original_filename = $this->uploadedFile->getClientOriginalName();

        return $this;
    }

    private function setAlt()
    {
        $this->alt = (str_replace(['_', '-'], ' ', $this->removeExtension($this->filename)));

        return $this;
    }

    private function setTitle()
    {
        $this->title = ucwords($this->alt);

        return $this;
    }

    private function setExtension()
    {
        $this->extension = $this->uploadedFile->getClientOriginalExtension();

        return $this;
    }

    private function setSize()
    {
        $this->size = $this->uploadedFile->getSize();

        return $this;
    }

    private function removeExtension($filename)
    {
        return str_replace('.' . $this->extension, '', $filename);
    }
}