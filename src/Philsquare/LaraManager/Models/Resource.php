<?php

namespace Philsquare\LaraManager\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model {

    protected $fillable = [
        'title',
        'slug',
        'namespace',
        'model',
        'order_column',
        'order_direction',
        'icon'
    ];

    public function fields()
    {
        return $this->hasMany('Philsquare\LaraManager\Models\ResourceField');
    }

    public function listedFields()
    {
        return $this->hasMany('Philsquare\LaraManager\Models\ResourceField')->where('list', 1);
    }

}