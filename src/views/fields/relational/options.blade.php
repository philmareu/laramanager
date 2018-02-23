@include('laramanager::partials.elements.form.text', [
    'field' => [
        'name' => 'data[method]',
        'label' => 'Method name',
        'value' => isset($field) ? $field->data['method'] : ''
    ]
])

@include('laramanager::partials.elements.form.text', [
    'field' => [
        'name' => 'data[model]',
        'label' => 'Relation model',
        'value' => isset($field) ? $field->data['model'] : ''
    ]
])

@include('laramanager::partials.elements.form.text', [
    'field' => [
        'name' => 'data[title]',
        'label' => 'Relation title Field (e.x. "name", "title")',
        'value' => isset($field) ? $field->data['title'] : 'title'
    ]
])

@include('laramanager::partials.elements.form.text', [
    'field' => [
        'name' => 'data[key]',
        'label' => 'Relation key Field (e.x. "id")',
        'value' => isset($field) ? $field->data['key'] : 'id'
    ]
])
