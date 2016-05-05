@include('laramanager::partials.elements.form.text', [
    'field' => [
        'name' => 'data[text]',
        'label' => 'Text',
        'value' => $object->data('text')
    ]
])