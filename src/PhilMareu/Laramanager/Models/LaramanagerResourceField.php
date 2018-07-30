<?php

namespace PhilMareu\Laramanager\Models;

use Illuminate\Database\Eloquent\Model;

class LaramanagerResourceField extends Model {

    protected $fillable = [
        'title',
        'slug',
        'validation',
        'is_required',
        'is_unique',
        'data',
        'list'
    ];

    public function resource()
    {
        return $this->belongsTo(LaramanagerResource::class);
    }

    public function fieldType()
    {
        return $this->belongsTo(LaramanagerFieldType::class, 'laramanager_field_type_id');
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