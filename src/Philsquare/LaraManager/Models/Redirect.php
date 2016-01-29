<?php

namespace Philsquare\LaraManager\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model {

    protected $fillable = [
        'from',
        'to',
        'type'
    ];

}