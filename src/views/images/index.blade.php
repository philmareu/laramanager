@extends('laramanager::layouts.sub.default')

@section('title')
    Images
@endsection

@section('breadcrumbs')
    <li><span>@yield('title')</span></li>
@endsection

@section('default-content')

    <image-gallery></image-gallery>

@endsection