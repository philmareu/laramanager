@include('laramanager::partials.elements.form.text', [
    'field' => [
        'name' => 'data[method]',
        'label' => 'Method name',
        'value' => isset($field) ? $field->data['method'] : ''
    ]
])