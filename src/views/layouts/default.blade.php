<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('laramanager.site_title') }} | @yield('title')</title>

    <link href="{{ asset("vendor/laramanager/css/styles.css") }}" rel="stylesheet" media="screen">

    @yield('head')
</head>
<body>

    <div class="uk-grid uk-grid-collapse">
        <div class="uk-width-1-5">
            @include('laramanager::navigations.primary.index')
        </div>
        <div class="uk-width-4-5">
            @include('laramanager::navigations.top.index')

            @include('laramanager::partials.session.alerts')

            @yield('content')

            @include('laramanager::partials.footer')
        </div>
    </div>

    <script src="{{ asset('vendor/laramanager/js/scripts.js') }}"></script>

    @yield('scripts')

</body>
</html>