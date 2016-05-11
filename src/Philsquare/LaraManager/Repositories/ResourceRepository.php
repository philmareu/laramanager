<?php namespace Philsquare\LaraManager\Repositories; 

use Philsquare\LaraManager\Models\Resource;

class ResourceRepository {

    protected $resource;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    public function getBySlug($slug)
    {
        return $this->resource->where('slug', $slug)->first();
    }

}