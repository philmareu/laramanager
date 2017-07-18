<?php namespace Philsquare\LaraManager\Models; 

use Illuminate\Database\Eloquent\Model;

class Feed extends Model {

    protected $table = 'laramanager_feeds';

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