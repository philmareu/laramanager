<?php

namespace Philsquare\LaraManager\Models;

use Illuminate\Database\Eloquent\Model;

class Object extends Model {

    public function data($key)
    {
        $data = unserialize($this->pivot->data);

        return isset($data['data'][$key]) ? $data['data'][$key] : '';
    }

}