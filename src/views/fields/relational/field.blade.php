@include('laramanager::partials.elements.form.select', [
    'field' => [
        'name' => $field->slug,
        'options' => $options[$field->slug],
        'value' => isset($entity) ? $entity->{$field->slug} : null
        ]
    ])