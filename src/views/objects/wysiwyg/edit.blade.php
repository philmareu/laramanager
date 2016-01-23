@extends('laramanager::objects.wrappers.edit')

@section('form')

    @include('laraform::elements.form.wysiwyg', ['field' => ['name' => 'text', 'id' => 'editor', 'value' => $object->data('text')]])

@endsection