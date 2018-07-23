@include('laramanager::partials.elements.form.select', [
    'field' => [
        'name' => $field->slug,
        'options' => $options[$field->slug],
        'value' => isset($entry) ? $entry->{$field->slug} : null
        ]
    ])