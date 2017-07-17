<?php namespace Philsquare\LaraManager\Models; 

use Illuminate\Database\Eloquent\Model;

class Error extends Model {

    protected $table = 'laramanager_errors';

    protected $fillable = [
        'exception',
        'message',
        'uri',
        'count'
    ];

}