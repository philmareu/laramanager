<?php

namespace Philsquare\LaraManager\Repositories;

use Illuminate\Support\Facades\Storage;
use Philsquare\LaraManager\Exceptions\FilenameExistsException;
use Philsquare\LaraManager\Models\Image;

class ImageRepository {

    protected $model;

    public function __construct()
    {
        $this->model = new Image;
    }

    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    public function getById($id)
    {
        return $this->model->whereId($id)->first();
    }

    public function update($id, $attributes)
    {
        $image = $this->getById($id);

        $image->update($attributes);

        return $image;
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }
}