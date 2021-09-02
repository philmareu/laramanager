<?php

namespace PhilMareu\Laramanager\Models;

use Illuminate\Database\Eloquent\Model;
use PhilMareu\Laramanager\FieldTypes\FieldType;

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
        return $this->belongsTo(LaramanagerFieldType::class, 'field_type_id');
    }

    /**
     * A shorthand for grabbing the related field type.
     *
     * @return LaramanagerFieldType
     */
    public function getTypeAttribute()
    {
        return $this->fieldType;
    }

    /**
     * Return the related field type class.
     *
     * @return FieldType
     */
    public function getTypeClassAttribute()
    {
        return $this->fieldType->getClass();
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
