@extends('laramanager::objects.wrappers.create')

@section('form')

    @include('laraform::elements.form.text', ['field' => ['name' => 'text']])

@endsection