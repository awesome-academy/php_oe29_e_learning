<div class="container-welcome" id="background-banner">
    <div id="img-data-set" data-background="{{ asset(config('title.main_background')) }}"></div>
    <div class="header-menu" id="my-header">
        <div class="left-container">
            <div class="logo">
                <a href="{{ route('home') }}" class="link"><img src="{{ asset(config('title.logo')) }}" alt="logo" class="logo"></a>
            </div>
            <div class="first-menu">
                <ul>
                    <li><a href="{{ route('home') }}" class="active">@lang('label.home')</a></li>
                    <li><a href="{{ route('courses') }}">@lang('label.course')</a></li>
                    <li><a href="{{ route('mentor') }}">@lang('label.mentor')</a></li>
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
                    <div class="notification-wrap">
                        <div class="bell-notification-container">
                            <span class="number-notification">{{ $requestsOfUser->count() }}</span>
                            <i class="fas fa-bell menu-item" id="btn-dropdown-notification"></i>
                        </div>
                        <div class="dropdown-notification" id="notification-content">
                            @foreach ($requestsOfUser as $request)
                                <div class="notify-item">
                                    <div class="notify-img">
                                        @if ($request->mentor->image)
                                            <img src="{{ asset(config('img.img_path') . $request->mentor->image->url) }}" alt="">
                                        @else
                                            <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="notify-info">
                                        <p>
                                            @lang('label.request_user', ['mentor_name' => $request->mentor->name, 'lesson' => $request->lesson->title, 'course' => $request->lesson->course->name, 'lesson_link' => route("course.lesson", [$request->lesson->id])])
                                        </p>
                                        <span class="notify-action" data-toggle="modal" data-target="#request{{ $request->id }}">@lang('label.rate')</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
                <a href="{{ route('courses') }}">@lang('label.course')</a>
            </div>
        </section>
    </div>
</div>
