<?php

namespace PhilMareu\Laramanager\Models;


use Illuminate\Database\Eloquent\Model;

class LaramanagerFieldType extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'class',
        'views',
        'active'
    ];

    public function fields()
    {
        return $this->belongsToMany(LaramanagerResourceField::class);
    }

    public function getOptionView()
    {
        if(view()->exists($this->getViewPath('options'))) return view($this->getViewPath('options'))->render();

        return '';
    }

    public function getClass()
    {
        return (new $this->class);
    }

    public function getViewPath($name)
    {
        return "{$this->views}.{$this->slug}.$name";
    }
}