<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/lesson.css') }}">
        <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
        <link rel="stylesheet" href="{{ asset('css/mentor.css') }}">
        <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/realtimechat.css') }}">
        <title>@lang('label.f8')</title>
    </head>
    <body>

        @include('layouts.menu_user')
        @yield('content')
        @include('layouts.footer_user')

        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('bower_components/pusher-js/dist/web/pusher.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/self-script.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/mentorscript.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/ajax-chat.js') }}"></script>
    </body>
</html>
