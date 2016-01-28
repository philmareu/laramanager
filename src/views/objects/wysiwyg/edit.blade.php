@extends('laramanager::objects.wrappers.edit')

@section('form')

    @include('laraform::elements.form.wysiwyg', ['field' => ['name' => 'data[text]', 'id' => 'editor', 'value' => $object->data('text')]])

@endsection