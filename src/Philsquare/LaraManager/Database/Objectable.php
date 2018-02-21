<?php

namespace Philsquare\LaraManager\Database;

trait Objectable {

    public function objects()
    {
        return $this->morphToMany('Philsquare\LaraManager\Models\LaramanagerObject', 'objectable', 'laramanager_objectables')->withPivot(['id', 'label', 'ordinal', 'data'])->orderBy('ordinal', 'asc');
    }

}