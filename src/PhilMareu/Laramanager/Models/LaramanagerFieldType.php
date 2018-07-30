<?php

namespace PhilMareu\Laramanager\Models;


use Illuminate\Database\Eloquent\Model;

class LaramanagerFieldType extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'class',
        'views',
        'active'
    ];

    public function fields()
    {
        return $this->belongsToMany(LaramanagerResourceField::class);
    }
}