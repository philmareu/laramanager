<?php namespace Philsquare\LaraManager\Models; 

use Illuminate\Database\Eloquent\Model;

class Feed extends Model {

    protected $fillable = [
        'title',
        'description',
        'url',
        'slug',
        'model'
    ];

}