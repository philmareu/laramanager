<?php

namespace PhilMareu\Laramanager\Database;

use PhilMareu\Laramanager\Models\LaramanagerObject;

trait Objectable {

    public function objects()
    {
        return $this->morphToMany(LaramanagerObject::class, 'laramanager_objectable', 'laramanager_objectables')->withPivot(['id', 'label', 'ordinal', 'data'])->orderBy('ordinal', 'asc');
    }

}