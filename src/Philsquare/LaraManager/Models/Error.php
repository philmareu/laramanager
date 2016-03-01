<?php namespace Philsquare\LaraManager\Models; 

use Illuminate\Database\Eloquent\Model;

class Error extends Model {

    protected $fillable = [
        'exception',
        'message',
        'uri',
        'count'
    ];

}