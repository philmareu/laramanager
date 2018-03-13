<?php namespace Philsquare\LaraManager\Repositories; 

use Philsquare\LaraManager\Models\LaramanagerResource;

class ResourceRepository {

    protected $resource;

    public function __construct(LaramanagerResource $resource)
    {
        $this->resource = $resource;
    }

    public function getBySlug($slug)
    {
        return $this->resource->where('slug', $slug)->first();
    }

}