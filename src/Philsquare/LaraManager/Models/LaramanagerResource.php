<?php

namespace Philsquare\LaraManager\Models;

use Illuminate\Database\Eloquent\Model;

class LaramanagerResource extends Model {

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
        return $this->hasMany(LaramanagerResourceField::class);
    }

    public function listedFields()
    {
        return $this->hasMany(LaramanagerResourceField::class)->where('list', 1);
    }

}