@extends('laramanager::objects.wrappers.edit')

@section('form')

    @include('laraform::elements.form.text', ['field' => ['name' => 'data[embed_url]', 'label' => 'Embed URL', 'value' => $object->data('embed_url')]])

@endsection