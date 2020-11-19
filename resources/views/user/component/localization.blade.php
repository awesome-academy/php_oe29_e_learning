@extends('layouts.profile_layout')

@section('content')  
    <section class="content-container">
        <section class="user-infor">
            <section class="sidebar-infor">
                <section class="user-sidebar">
                    <a href="" class="flex-link">
                        <section class="sidebar-avatar">
                            @if ($user->image)
                                <img src="{{ asset(config('img.img_path') . $user->image->url) }}" alt="">
                            @else
                                <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                            @endif
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
        <section class="user-detail max-width">
            <section class="header-user-detail">
                <section class="user-detail-title">
                    <h1>@lang('label.user_localization')</h1>
                    <p>@lang('label.change_localization')</p>
                </section>
            </section>
            <section class="change-email">
                <section>
                    <form action="{{ route('localization.change') }}" method="POST" id="form-localization">
                        @csrf
                        <div class="input-container">
                            <label for="">@lang('label.use_localization')</label>
                            <div>
                                <div class="radio-container">
                                    <input type="radio" name="language" value="vi">
                                    <label for="">@lang('label.vi')</label>
                                </div>
                                <div class="radio-container">
                                    <input type="radio" name="language" value="en">
                                    <label for="">@lang('label.en')</label>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                    <section class="btn-submit-container">
                        <button type="submit" form="form-localization">@lang('label.update')</button>
                    </section>
                </section>
            </section>
            <div class="tips-email-container">
                <div class="tips-email">
                    <svg class="message-icon" viewBox="0 0 16 16"><path fill="currentColor" d="M8 0c4.42 0 8 3.58 8 8s-3.58 8-8 8-8-3.58-8-8 3.58-8 8-8zm0 14.914A6.911 6.911 0 0 0 14.914 8 6.911 6.911 0 0 0 8 1.086 6.911 6.911 0 0 0 1.086 8 6.911 6.911 0 0 0 8 14.914zM7.25 5V3.5h1.5V5h-1.5zm1.5 1.5v6h-1.5v-6h1.5z"></path></svg>
                    <div class="message-body">
                        <p>@lang('label.localization_information')</p>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
