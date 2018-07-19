<?php

namespace PhilMareu\LaraManager\Database;

use PhilMareu\LaraManager\Models\LaramanagerObject;

trait Objectable {

    public function objects()
    {
        return $this->morphToMany(LaramanagerObject::class, 'laramanager_objectable', 'laramanager_objectables')->withPivot(['id', 'label', 'ordinal', 'data'])->orderBy('ordinal', 'asc');
    }

}