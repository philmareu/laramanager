@extends('laramanager::layouts.base')

@push('css')
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
@endpush

@section('body')
    <div id="app" class="@yield('app-classes')">
        @yield('content')
    </div>

    <script src="{{ mix('js/app.js') }}"></script>

    @stack('scripts-last')
@endsection