<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/lesson.css') }}">
        <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
        <title>@lang('label.f8')</title>
    </head>
    <body>

        @include('layouts.menu_user')
        @yield('content')

    </body>
</html>