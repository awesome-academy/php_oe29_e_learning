<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="">
</head>
<body>
    <section class="container-auth">
        <header class="header-auth">
            <div class="header-link"><a href="{{ route('home') }}"><img src="{{ asset(config('title.auth_logo')) }}" alt=""></a></div>
        </header>
        
        @yield('content')

    </section>
</body>
</html>
