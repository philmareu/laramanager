@include('laramanager::partials.elements.form.textarea', [
    'field' => [
        'name' => 'data[options]',
        'label' => 'List Options (e.x. movie:Movie|band:Band|comedy:Comedy)',
        'value' => isset($field) ? $field->data['options'] : ''
    ]
])