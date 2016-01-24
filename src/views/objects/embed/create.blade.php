@extends('laramanager::objects.wrappers.create')

@section('form')

    @include('laraform::elements.form.text', ['field' => ['name' => 'data[embed_url]', 'label' => 'Embed URL']])

@endsection