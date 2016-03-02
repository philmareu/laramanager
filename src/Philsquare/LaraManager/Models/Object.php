<?php

namespace Philsquare\LaraManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Object extends Model {

    protected $fillable = [
        'title',
        'slug',
        'description'
    ];

    public function data($key)
    {
        $data = unserialize($this->pivot->data);

        return isset($data['data'][$key]) ? $data['data'][$key] : '';
    }

    public function file($key)
    {
        $id = $this->data($key);

        return Image::find($id);
    }

    public function files($key)
    {
        $ids = $this->data($key);

        if(! is_array($ids)) return [];

        $idsOrdered = implode(',', $ids);

        return Image::whereIn('id', $ids)
            ->orderByRaw(DB::raw("FIELD(id, $idsOrdered)"))
            ->get();
    }

}