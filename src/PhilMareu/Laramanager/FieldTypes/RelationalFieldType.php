<?php

namespace PhilMareu\Laramanager\FieldTypes;


class RelationalFieldType extends FieldType
{
    public function options($field)
    {
        $model = (new $field->data['model']);

        return $model->all()->pluck($field->data['title'], $field->data['key'])->all();
    }
}