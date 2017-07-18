<?php

namespace Philsquare\LaraManager\Models;

use Illuminate\Database\Eloquent\Model;

class
ResourceField extends Model {

    protected $table = 'laramanager_resource_fields';

    protected $fillable = [
        'title',
        'slug',
        'type',
        'validation',
        'is_required',
        'is_unique',
        'data',
        'list'
    ];

    public function resource()
    {
        return $this->belongsTo('Philsquare\LaraManager\Models\Resource');
    }

    public function selectArray()
    {
        $data = $this->data['options'];

        $options = [];
        foreach(explode('|', $data) as $row)
        {
            $option = explode(':', $row);

            $options[$option[0]] = $option[1];
        }

        return $options;
    }

    public function getDataAttribute($value)
    {
        return unserialize($value);
    }

    // replace this with accessor
//    public function get($key)
//    {
//        $data = unserialize($this->data);
//
//        return isset($data[$key]) ? $data[$key] : '';
//    }

}