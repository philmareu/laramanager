@extends('laramanager::objects.create.wrapper')

@section('form')

    @include('laraform::elements.form.text', ['field' => ['name' => 'text']])

@endsection