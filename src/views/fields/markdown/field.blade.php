@include('laramanager::partials.elements.form.textarea', [
    'field' => [
        'name' => $field->slug,
        'class' => 'field-markdown',
        'value' => isset($entity) ? $entity->{$field->slug} : null
    ]
])