@extends('laramanager::layouts.base')

@push('css')
    <link href="{{ asset("vendor/laramanager/css/styles.css") }}" rel="stylesheet" media="screen">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:300,500' rel='stylesheet' type='text/css'>
@endpush

@section('body')
    <div id="app" class="uk-offcanvas-content">
        @yield('content')
    </div>

    <script src="{{ asset('vendor/laramanager/js/scripts.min.js') }}"></script>

    @stack('scripts-last')
@endsection