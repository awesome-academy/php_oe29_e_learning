<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset(config('title.logo')) }}" alt="F8 Logo" class="brand-image">
        <span class="brand-text font-weight-light">@lang('label.f8')</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>@lang('label.dashboard')</p>
                    </a>
                </li>
                <li class="nav-header">@lang('label.student')</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>@lang('label.students')</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            @lang('label.details')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>@lang('label.exercise')</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-header">@lang('label.mentor')</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>@lang('label.mentors')</p>
                    </a>
                </li>
                <li class="nav-header">@lang('label.course')</li>
                <li class="nav-item">
                    <a href="{{ route('courses.index') }}" class="nav-link active">
                        <i class="nav-icon fas fa-file"></i>
                        <p>@lang('label.courses')</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
