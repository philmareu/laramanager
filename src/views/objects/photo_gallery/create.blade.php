@extends('laramanager::objects.wrappers.create')

@section('form')

    @include('laramanager::objects.fields.images', ['name' => 'file_ids', 'label' => 'Photos'])

@endsection