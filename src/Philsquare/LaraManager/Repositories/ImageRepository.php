<?php

namespace Philsquare\LaraManager\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Philsquare\LaraManager\Models\LaramanagerImage;

class ImageRepository {

    protected $model;

    public function __construct(LaramanagerImage $laramanagerImage)
    {
        $this->model = $laramanagerImage;
    }

    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    public function getById($id)
    {
        return $this->model->whereId($id)->first();
    }

    public function getPaginated()
    {
        return $this->model->latest()->paginate(100);
    }

    public function search($term)
    {
        return $this->model
            ->where('filename', 'LIKE', "%$term%")
            ->orWhere('title', 'LIKE', "%$term%")
            ->orWhere('alt', 'LIKE', "%$term%")
            ->orWhere('original_filename', 'LIKE', "%$term%")
            ->get();
    }

    public function update($id, $attributes)
    {
        $image = $this->getById($id);
        $this->updateFilenameIfChanged($image->filename, $attributes['filename']);
        $image->update($attributes);

        return $image;
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    private function filenameWasChanged($old, $new)
    {
        return $old != $new;
    }

    private function updateFilenameIfChanged($old, $new)
    {
        if($this->filenameWasChanged($old, $new)) {
            Storage::move('laramanager/images/' . $old, 'laramanager/images/' . $new);
        }
    }
}