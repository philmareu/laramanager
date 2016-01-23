@extends('laramanager::objects.wrappers.create')

@section('form')

    @include('laraform::elements.form.text', ['field' => ['name' => 'data[text]', 'label' => 'Text']])

@endsection