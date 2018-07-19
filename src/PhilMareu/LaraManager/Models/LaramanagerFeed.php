<?php namespace PhilMareu\Laramanager\Models;

use Illuminate\Database\Eloquent\Model;

class LaramanagerFeed extends Model {

    protected $fillable = [
        'title',
        'description',
        'url',
        'slug',
        'model',
        'language',
        'copyright',
        'ttl'
    ];

}