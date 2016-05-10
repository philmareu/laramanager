<?php namespace Philsquare\LaraManager\Repositories; 

use Philsquare\LaraManager\Models\Resource;

class ResourceRepository {

    protected $model;

    public function __construct()
    {
        $this->model = new Resource;
    }

    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

}