<div class="container-welcome" id="background-banner">
    <div id="img-data-set" data-background="{{ asset(config('title.main_background')) }}"></div>
    <div class="header-menu" id="my-header">
        <div class="left-container">
            <div class="logo">
                <a href="{{ route('home') }}" class="link"><img src="{{ asset(config('title.logo')) }}" alt="logo" class="logo"></a>
            </div>
            <div class="first-menu">
                <ul>
                    <li><a href="{{ route('home') }}">@lang('label.home')</a></li>
                    <li><a href="{{ route('courses') }}">@lang('label.course')</a></li>
                    <li><a href="">@lang('label.mentor')</a></li>
                </ul>
            </div>
        </div>
        <div class="second-menu">
            @auth
                <div class="info-container">
                    <div class="avatar">
                        @if (Auth::user()->image)
                            <img src="{{ asset(config('img.img_path') . Auth::user()->image->url) }}" alt="">
                        @else
                            <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                        @endif
                    </div>
                    <p>{{ Auth::user()->name }}</p>
                </div>
                <div class="action-container">
                    <div><i class="fas fa-bell menu-item"></i></div>
                    <div class="parent-menu">
                        <i class="fas fa-caret-down menu-item" id="btn-dropdown"></i>
                        <ul class="dropdown" id="dropdown-content">
                            <li>
                                <div><input type="checkbox" class="switch" id="theme"></div>
                                <label for="theme">@lang('label.change_theme')</label>
                            </li>
                            <li>
                                <a href="{{ route('settings') }}" class="flex-link-display">
                                        <div><i class="fas fa-cog"></i></div> 
                                        <p>@lang('label.settings')</p>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn-logout">
                                        <div><i class="fas fa-sign-out-alt"></i></div>
                                        <p>@lang('label.log_out')</p>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <ul class="action-ul">
                    <li class="info-container"><a href="{{ route('login') }}">@lang('label.login')</a></li>
                    <li><a href="{{ route('register') }}">@lang('label.register')</a></li>
                </ul>
            @endauth
        </div>
    </div>
    <div class="overlay">
        <section class="banner">
            <h5>@lang('label.description_banner')</h5>
            <h1>@lang('label.title_banner')</h1>
            <div class="btn-course">
                <a href="">@lang('label.course')</a>
            </div>
        </section>
    </div>
</div>
