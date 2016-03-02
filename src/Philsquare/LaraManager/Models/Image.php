<?php

namespace Philsquare\LaraManager\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    protected $fillable = [
        'filename',
        'title',
        'description',
        'type',
        'original_filename',
        'alt',
        'size'
    ];

}