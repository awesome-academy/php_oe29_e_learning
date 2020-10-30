@extends('layouts.profile_layout')

@section('content')  
    @isset($user)
        <section class="content-container">
            <section class="user-infor">
                <section class="sidebar-infor">
                    <section class="user-sidebar">
                        <a href="" class="flex-link">
                            <section class="sidebar-avatar">
                                <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                            </section>
                            <section class="sidebar-header">
                                <h3>{{ $user->name }}</h3>
                                <p>{{ $user->role->name }}</p>
                            </section>
                        </a>
                    </section>
                    <ul class="sidebar-nav">
                        <li class="sidebar-item"><a href="{{ route('settings') }}">@lang('label.account')</a></li>
                    </ul>
                </section>
            </section>
            <section class="user-detail">
                <section class="header-user-detail">
                    <section class="detail-icon">
                        <img src="{{ asset(config('title.profile_icon')) }}" alt="">
                    </section>
                    <section class="user-detail-title">
                        <h1>@lang('label.account')</h1>
                        <p>@lang('label.account_management')</p>
                    </section>
                </section>
                <section class="user-detail-row">
                    <h4>@lang('label.login_information')</h4>
                    <a href="{{ route('show.email') }}" class="user-detail-link">
                        <section class="detail-item">
                            <span>@lang('label.email')</span>
                            <span class="detail-description">{{ $user->email }}</span>
                        </section>
                        <div><i class="fas fa-chevron-right arrow-color"></i></div>
                    </a>
                </section>
                <section class="user-detail-row seperate-row">
                    <h4>@lang('label.user_information')</h4>
                    <a href="{{ route('show.information') }}" class="user-detail-link">
                        <section class="detail-item">
                            <span>@lang('label.person')</span>
                            <span class="detail-description">{{ $user->name }}</span>
                        </section>
                        <div><i class="fas fa-chevron-right arrow-color"></i></div>
                    </a>
                    <a href="" class="user-detail-link">
                        <section class="detail-item">
                            <span>@lang('label.language')</span>
                            <span class="detail-description">
                            @switch(App::getLocale())
                                @case('en')
                                    @lang('label.en')
                                    @break
                                @default
                                    @lang('label.vi')
                            @endswitch
                            </span>
                        </section>
                        <div><i class="fas fa-chevron-right arrow-color"></i></div>
                    </a>
                </section>
            </section>
        </section>
    @endisset
@endsection
