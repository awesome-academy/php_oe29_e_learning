<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <title>F8 FullStack</title>
    </head>
    <body>

        @include('layouts.welcome')
        @yield('content')
        @include('layouts.footer_user')

        <script type="text/javascript" src="{{ asset('js/self-script.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backgroundscript.js') }}"></script>
    </body>
</html>
