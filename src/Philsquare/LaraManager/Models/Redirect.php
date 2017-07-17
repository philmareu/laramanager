<?php

namespace Philsquare\LaraManager\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model {

    protected $table = 'laramanager_redirects';

    protected $fillable = [
        'from',
        'to',
        'type'
    ];

}