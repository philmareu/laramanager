<?php namespace Philsquare\LaraManager\Models; 

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

    protected $table = 'laramanager_settings';

    protected $fillable = [
        'title',
        'slug',
        'type',
        'value',
        'description'
    ];

}