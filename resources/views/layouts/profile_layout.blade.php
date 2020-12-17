<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
        <title>@lang('label.profile')</title>
    </head>
    <body>
        <section class="container-auth">
            <header class="header-auth-profile">
                <div class="header-link-profile">
                    <a href="{{ route('home') }}" class="sub-link-profile"><img src="{{ asset(config('title.logo')) }}" alt=""></a>
                    <a href="{{ route('home') }}" class="btn-link">
                        <i class="fas fa-chevron-left"></i>
                        <span>@lang('label.back_homepage')</span>
                    </a>
                </div>
            </header>

            @yield('content')

        </section>
        @include('sweetalert::alert')

        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/preview.js') }}"></script>
        <script src="{{ asset('js/Chart.js') }}"></script>
    </body>
</html>
