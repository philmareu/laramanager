@extends('laramanager::objects.wrappers.create')

@section('form')

    @include('laramanager::partials.elements.form.wysiwyg', ['field' => ['name' => 'data[text]', 'id' => 'editor', 'label' => 'Text']])

@endsection