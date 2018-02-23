<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} Admin | @yield('title')</title>

    <link href="{{ asset("vendor/laramanager/css/styles.css") }}" rel="stylesheet" media="screen">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:300,500' rel='stylesheet' type='text/css'>

    <script type="text/javascript" charset="utf-8">
        var SITE_URL = "{{ url('') }}";
        var csrf = "{{ csrf_token() }}";
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>

    <!-- Scripts -->
    @stack('scripts')

    @yield('head')
</head>
<body>
    <div id="app" class="uk-offcanvas-content">
        @yield('content')
    </div>

    <script src="{{ asset('vendor/laramanager/js/scripts.min.js') }}"></script>

    @stack('scripts-last')

</body>
</html>