@include('laraform::elements.form.text', ['field' => ['name' => 'data[model]', 'label' => 'Model', 'value' => isset($field) ? $field->data('model') : '']])
@include('laraform::elements.form.text', ['field' => ['name' => 'data[method]', 'label' => 'Method', 'value' => isset($field) ? $field->data('method') : '']])
@include('laraform::elements.form.text', ['field' => ['name' => 'data[title]', 'label' => 'Title Field', 'value' => isset($field) ? $field->data('title') : 'title']])
@include('laraform::elements.form.text', ['field' => ['name' => 'data[key]', 'label' => 'Key Field', 'value' => isset($field) ? $field->data('key') : 'id']])