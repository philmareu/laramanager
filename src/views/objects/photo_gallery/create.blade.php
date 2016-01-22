@extends('laramanager::objects.wrappers.create')

@section('form')

    @include('laraform::elements.form.uploads', ['field' => ['name' => 'text[]']])

@endsection