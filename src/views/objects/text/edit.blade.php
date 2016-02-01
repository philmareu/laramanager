@extends('laramanager::objects.wrappers.edit')

@section('form')

    @include('laraform::elements.form.text', ['field' => ['name' => 'data[text]', 'label' => 'Text', 'value' => $object->data('text')]])

@endsection