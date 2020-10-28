@extends('layouts.profile_layout')

@section('content')    
    <section class="content-container">
        <section class="user-infor">
            <section class="sidebar-infor">
                <section class="user-sidebar">
                    <a href="" class="flex-link">
                        <section class="sidebar-avatar">
                            <img src="{{ asset(config('title.avatar_demo')) }}" alt="">
                        </section>
                        <section class="sidebar-header">
                            <h3>@lang('label.user_name')</h3>
                            <p>@lang('label.type_user')</p>
                        </section>
                    </a>
                </section>
                <ul class="sidebar-nav">
                    <li class="sidebar-item"><a href="">@lang('label.account')</a></li>
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
                <a href="" class="user-detail-link">
                    <section class="detail-item">
                        <span>@lang('label.password')</span>
                        <span class="detail-description">@lang('label.password_description')</span>
                    </section>
                    <div><i class="fas fa-chevron-right arrow-color"></i></div>
                </a>
            </section>
            <section class="user-detail-row seperate-row">
                <h4>@lang('label.user_information')</h4>
                <a href="" class="user-detail-link">
                    <section class="detail-item">
                        <span>@lang('label.name')</span>
                        <span class="detail-description">@lang('label.username')</span>
                    </section>
                    <div><i class="fas fa-chevron-right arrow-color"></i></div>
                </a>
            </section>
        </section>
    </section>
@endsection
