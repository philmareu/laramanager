@include('laramanager::partials.elements.form.select', [
    'field' => [
        'name' => $field->slug,
        'options' => $field->fieldType->getClass()->selectArray($field->data['options']),
        'value' => isset($entry) ? $entry->{$field->slug} : null
        ]
    ])