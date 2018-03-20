<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('page-description')">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="site-url" content="{{ url('') }}">
        @stack('meta')

        <!-- Title -->
        <title>{{ config('app.name') }} | @yield('title')</title>

        <!-- Links -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link href="{{ asset('favicon.ico') }}" rel="shortcut icon" type="image/x-icon">

        <!-- CSS -->
        @stack('css')

        <!-- Scripts -->
        @stack('scripts')

        <!-- Additional <head></head> resources -->
        @stack('head')
    </head>
    <body class="@yield('body-classes')">
        @yield('body')
    </body>
</html>