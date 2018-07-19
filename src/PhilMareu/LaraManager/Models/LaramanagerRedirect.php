<?php

namespace PhilMareu\Laramanager\Models;

use Illuminate\Database\Eloquent\Model;

class LaramanagerRedirect extends Model {

    protected $fillable = [
        'from',
        'to',
        'type'
    ];

}