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

    @include('laramanager::navigations.top.index')

    <div class="uk-grid uk-grid-collapse">
        <div class="uk-width-1-6">
            @include('laramanager::navigations.primary.index')
        </div>
        <div class="uk-width-5-6">

            @include('laraform::alerts.default')

            <div class="title-bar uk-grid uk-grid-collapse uk-flex-middle">
                <div class="uk-width-1-2">
                    <h1>@yield('title')</h1>
                </div>
                <div class="uk-width-1-2">
                    @yield('actions')
                </div>
            </div>

            <div class="uk-container">
                @yield('content')
            </div>

            @include('laramanager::partials.footer')
        </div>
    </div>

    <script src="{{ asset('vendor/laramanager/js/scripts.js') }}"></script>

    @yield('scripts')

</body>
</html>