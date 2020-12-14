<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset(config('title.logo')) }}" alt="F8 Logo" class="brand-image">
        <span class="brand-text font-weight-light">@lang('label.f8')</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('mentor.request') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                        <p>@lang('label.request')</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            @lang('label.more_action')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('mentor.history') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>@lang('label.history')</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mentor.chat') }}" class="nav-link">
                    <i class="nav-icon far fa-comments"></i>
                        <p>@lang('label.chat')</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
