@extends('laramanager::objects.wrappers.edit')

@section('form')

    @include('laramanager::objects.fields.images', ['name' => 'file_ids', 'label' => 'Photos'])

@endsection