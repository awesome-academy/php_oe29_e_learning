<div class="container-welcome">
    <div class="header-menu" id="my-header">
        <div class="left-container">
            <div class="logo">
                <a href="" class="link"><img src="{{ asset(config('title.logo')) }}" alt="logo" class="logo"></a>
            </div>
            <div class="first-menu">
                <ul>
                    <li><a href="">@lang('label.home')</a></li>
                    <li><a href="">@lang('label.course')</a></li>
                </ul>
            </div>
        </div>
        <div class="second-menu">
            @auth
                <div class="info-container">
                    <div class="avatar">
                        <img src="{{ asset(config('title.logo')) }}" alt="logo">
                    </div>
                    <p>@lang('label.name')</p>
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
                                <div><i class="fas fa-cog"></i></div> 
                                <p>@lang('label.settings')</p>
                            </li>
                            <li>
                                <div><i class="fas fa-sign-out-alt"></i></div>
                                <p>@lang('label.log_out')</p>
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
</div>
