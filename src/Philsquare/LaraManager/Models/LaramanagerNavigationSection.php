<?php

namespace Philsquare\LaraManager\Models;


use Illuminate\Database\Eloquent\Model;

class LaramanagerNavigationSection extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'ordinal'
    ];

    public function links()
    {
        return $this->hasMany(LaramanagerNavigationLink::class)->orderBy('ordinal');
    }
}