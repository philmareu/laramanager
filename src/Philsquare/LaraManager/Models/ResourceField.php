<?php

namespace Philsquare\LaraManager\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceField extends Model {

    protected $fillable = [
        'title',
        'slug',
        'type',
        'validation',
        'is_required',
        'is_unique',
        'data',
        'list'
    ];

    public function resource()
    {
        return $this->belongsTo('Philsquare\LaraManager\Models\Resource');
    }

}