<?php

namespace Philsquare\LaraManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Object extends Model {

    public function data($key)
    {
        $data = unserialize($this->pivot->data);

        return isset($data['data'][$key]) ? $data['data'][$key] : '';
    }

    public function file($key)
    {
        $id = $this->data($key);

        return File::find($id);
    }

    public function files($key)
    {
        $ids = $this->data($key);

        $idsOrdered = implode(',', $ids);

        return File::whereIn('id', $ids)
            ->orderByRaw(DB::raw("FIELD(id, $idsOrdered)"))
            ->get();
    }

}