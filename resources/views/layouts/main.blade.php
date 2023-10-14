<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @hasSection('title')
            <title>{{ config('app.name') }} | @yield('title')</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        @include('layouts.partials.css')
        @stack('css')
        @livewireStyles
    </head>
    <body class="hold-transition sidebar-collapse layout-top-nav">
        <div class="wrapper" id="main">

            @include('layouts.partials.navbar')

            @include('layouts.partials.sidebar')

            @yield('content')

            @include('layouts.partials.footer')

        </div>

        @include('layouts.partials.js')
        @livewireScripts
        @stack('js')
    </body>
</html>
