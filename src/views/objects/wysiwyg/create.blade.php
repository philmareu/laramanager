@extends('laramanager::objects.wrappers.create')

@section('form')

    @include('laraform::elements.form.wysiwyg', ['field' => ['name' => 'data[text]', 'id' => 'editor', 'label' => 'Text']])

@endsection