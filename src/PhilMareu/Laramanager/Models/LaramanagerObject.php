<?php

namespace PhilMareu\Laramanager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LaramanagerObject extends Model {

    protected $fillable = [
        'title',
        'slug',
        'description'
    ];

    public function data($key)
    {
        if(is_null($this->pivot)) return null;

        $data = unserialize($this->pivot->data);

        return isset($data['data'][$key]) ? $data['data'][$key] : '';
    }

    public function image($key)
    {
        $id = $this->data($key);

        return LaramanagerImage::find($id);
    }

    public function images($key)
    {
        $ids = $this->data($key);

        if(! is_array($ids)) return [];
        
        return LaramanagerImage::whereIn('id', $ids)
            ->get();
    }

}
