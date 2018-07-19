<?php namespace PhilMareu\Laramanager\Models;

use Illuminate\Database\Eloquent\Model;

class LaramanagerSetting extends Model {

    protected $fillable = [
        'title',
        'slug',
        'type',
        'value',
        'description'
    ];

}