@extends('laramanager::layouts.default')

@section('title')
    {{ $title }}
@endsection

@section('content')

    @foreach($resources as $resource)
        @foreach($fields as $field)
            @unless(isset($field['list']) && $field['list'] === false)
                {{ $resource->$field['slug'] }} |
            @endunless
        @endforeach
    @endforeach

@endsection