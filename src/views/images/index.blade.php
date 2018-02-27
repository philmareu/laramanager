@extends('laramanager::layouts.sub.default')

@section('title')
    Images
@endsection

@section('breadcrumbs')
    <li><span>@yield('title')</span></li>
@endsection

@section('page-content')

    <image-gallery></image-gallery>

@endsection