@extends('laramanager::objects.wrappers.edit')

@section('form')

    @include('laraform::elements.form.text', ['field' => ['name' => 'text', 'value' => $object->data('text')]])

@stop