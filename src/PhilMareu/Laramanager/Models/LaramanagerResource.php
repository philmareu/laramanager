<?php

namespace PhilMareu\Laramanager\Models;

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
        return $this->hasMany(LaramanagerResourceField::class, 'resource_id');
    }

    public function listedFields()
    {
        return $this->hasMany(LaramanagerResourceField::class, 'resource_id')->where('list', 1);
    }
}