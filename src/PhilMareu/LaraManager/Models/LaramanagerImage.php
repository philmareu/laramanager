<?php

namespace PhilMareu\Laramanager\Models;

use Illuminate\Database\Eloquent\Model;

class LaramanagerImage extends Model {

    protected $fillable = [
        'filename',
        'title',
        'description',
        'type',
        'original_filename',
        'alt',
        'size'
    ];

    protected $appends = ['paths'];

    public function getPathsAttribute()
    {
        return [
            'original' => url('images/original/' . $this->filename)
        ];
    }

}