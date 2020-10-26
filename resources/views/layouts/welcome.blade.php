<div class="container-welcome" id="background-banner">
    <div id="img-data-set" data-background="{{ asset(config('title.main_background')) }}"></div>
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
        </div>
    </div>
    <div class="overlay">
        <section class="banner">
            <h5>@lang('label.description_banner')</h5>
            <h1>@lang('label.title_banner')</h1>
            <div class="btn-course">
                <a href="">@lang('course')</a>
            </div>
        </section>
    </div>
</div>