<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body>
<div id="app">
    <main class='sm-12'>
        @include('partials.alerts')
        @yield('content')
    </main>
</div>

<script src="{{ asset('js/app.js') }}"></script>
{{--<script src="{{ asset('js/TweenMax.min.js') }}"></script>--}}
</body>
</html>
