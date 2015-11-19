<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="{{ elixir("vendor/laramanager/uikit.css") }}" rel="stylesheet" media="screen">
    <script src="//js.pusher.com/3.0/pusher.min.js"></script>

    @if(Auth::check())
        <script>
            var pusher = new Pusher('{{ env('PUSHER_KEY') }}');
            var channel = pusher.subscribe('user.{{ Auth::user()->id }}');
        </script>
    @endif

    @if(env('APP_ENV') == 'production')

        <script type="text/javascript" charset="utf-8">
            var SITE_URL = "{{ url('', [], true) }}";
        </script>

    @else

        <script type="text/javascript" charset="utf-8">
            var SITE_URL = "{{ url() }}";
        </script>

    @endif

    @yield('head')
</head>
<body>

@yield('content')

</body>
</html>