@extends('laramanager::layouts.admin.browser')

@section('title')
File Browser
@endsection

@section('browser-content')
    <ckeditor-image-browser :func-num="{{ $funcNum }}"></ckeditor-image-browser>
@endsection