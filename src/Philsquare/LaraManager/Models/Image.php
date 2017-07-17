<?php

namespace Philsquare\LaraManager\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    protected $table = 'laramanager_images';

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