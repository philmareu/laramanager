@include('laramanager::partials.elements.form.select', [
    'field' => [
        'name' => $field->slug,
        'options' => $field->selectArray(),
        'value' => isset($entry) ? $entry->{$field->slug} : null
        ]
    ])