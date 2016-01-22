@extends('laramanager::objects.wrappers.create')

@section('form')

    @include('laraform::elements.form.wysiwyg', ['field' => ['name' => 'text', 'id' => 'editor']])

@endsection