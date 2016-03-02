<?php namespace Philsquare\LaraManager\Models; 

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

    protected $fillable = [
        'title',
        'slug',
        'type',
        'value',
        'description'
    ];

}