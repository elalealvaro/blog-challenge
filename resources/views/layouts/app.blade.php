<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blog Challenge | @yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        @include('layouts.partials.navigation')
        @include('flash::message')
    </header>

    <main class="py-4">

        @yield('content')
    </main>

    <!-- Scripts -->
    <script>
        // Set some useful app globals
        AppGlobals = {};
        AppGlobals.url = '{{ config('app.url') }}';
        @yield('js')
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
