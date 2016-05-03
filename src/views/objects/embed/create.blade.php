@extends('laramanager::objects.wrappers.create')

@section('form')

    @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'data[embed_url]', 'label' => 'Embed URL']])

@endsection