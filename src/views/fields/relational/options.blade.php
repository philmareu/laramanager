@include('laramanager::partials.elements.form.text', [
    'field' => [
        'name' => 'data[model]',
        'label' => 'Model (values)',
        'value' => isset($field) ? $field->data('model') : ''
    ]
])

@include('laramanager::partials.elements.form.text', [
    'field' => [
        'name' => 'data[method]',
        'label' => 'Method name',
        'value' => isset($field) ? $field->data('method') : ''
    ]
])

@include('laramanager::partials.elements.form.text', [
    'field' => [
        'name' => 'data[title]',
        'label' => 'Title Field (e.x. "name")',
        'value' => isset($field) ? $field->data('title') : 'title'
    ]
])

@include('laramanager::partials.elements.form.text', [
    'field' => [
        'name' => 'data[key]',
        'label' => 'Key Field (e.x. "id")',
        'value' => isset($field) ? $field->data('key') : 'id'
    ]
])
