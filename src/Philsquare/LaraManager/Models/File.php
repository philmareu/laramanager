<?php

namespace Philsquare\LaraManager\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

    protected $fillable = [
        'filename',
        'title',
        'description',
        'type',
        'original_filename'
    ];

}