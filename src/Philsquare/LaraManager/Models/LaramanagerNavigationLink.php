<?php

namespace Philsquare\LaraManager\Models;


use Illuminate\Database\Eloquent\Model;

class LaramanagerNavigationLink extends Model
{
    protected $fillable = [
        'title',
        'laramanager_navigation_section_id',
        'ordinal',
        'uri'
    ];

    public function section()
    {
        return $this->belongsTo(LaramanagerNavigationSection::class, 'laramanager_navigation_section_id')->orderBy('ordinal');
    }

    public function wildcardUris() : array
    {
        return [$this->uri, $this->uri . '/*'];
    }
}