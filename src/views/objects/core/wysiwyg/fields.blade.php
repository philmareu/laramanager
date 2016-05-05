@include('laramanager::partials.elements.form.wysiwyg', [
    'field' => [
        'name' => 'data[text]',
        'id' => 'editor',
        'value' => $object->data('text'),
        'label' => 'text'
    ]
])