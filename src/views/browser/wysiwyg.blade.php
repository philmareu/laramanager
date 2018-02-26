@extends('laramanager::layouts.sub.browser')

@section('title')
File Browser
@endsection

@section('content')
    <ckeditor-image-browser :func-num="{{ $funcNum }}"></ckeditor-image-browser>
@endsection