@include('laramanager::partials.elements.form.select', [
    'field' => [
        'name' => $field->slug,
        'options' => $field->fieldType->getClass()->options($field),
        'value' => isset($entry) ? $entry->{$field->slug} : null
        ]
    ])