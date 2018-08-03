<?php

namespace PhilMareu\Laramanager\FieldTypes;


class SelectFieldType extends FieldType
{
    public function selectArray($data)
    {
        $options = [];
        foreach(explode('|', $data) as $row)
        {
            $option = explode(':', $row);

            $options[$option[0]] = $option[1];
        }

        return $options;
    }
}