@extends('layouts.app')

@section('content')
    <section class="body-auth">
        <section class="content-auth">
            <section class="form-auth">
                <h1 class="auth-heading">@lang('label.auth')</h1>
                <p class="auth-sub-heading">@lang('label.f8_auth_title')</p>
                <ul>
                    <li>
                        <button class="auth-btn-third">
                            <div class="auth-img-container">
                                <img src="{{ asset(config('title.auth_facebook_logo')) }}" alt="">
                            </div>
                            <span class="with-before">@lang('label.f8_auth_google')</span>
                        </button>
                    </li>
                    <li>
                        <button class="auth-btn-third">
                            <div class="auth-img-container">
                                <img src="{{ asset(config('title.auth_google_logo')) }}" alt="">
                            </div>
                            <span class="with-before">@lang('label.f8_auth_facebook')</span>
                        </button>
                    </li>
                    <p class="auth-sub-heading space">@lang('f8_auth_tips')</p>
                    <li class="auth-separator">
                        <span class="sub-auth-separator">@lang('label.or')</span>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="text-input-container">
                                <label for="email">@lang('label.email')</label>
                                <input type="email" class="auth-input" id="email" placeholder="@lang('label.enter_email')" name="email">
                                @error('email')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-input-container">
                                <label for="password">@lang('label.password')</label>
                                <input type="password" class="auth-input" id="password" placeholder="@lang('label.enter_password')" name="password">
                                @error('password')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="auth-btn-submit">@lang('label.login')</button>
                        </form>
                        <section class="auth-reset-pwd">
                            <a href="" class="auth-link">@lang('label.forget_password')</a>
                        </section>
                    </li>
                </ul>
            </section>
        </section>
        @if (Route::has('register'))
            <section class="other-action">
                <p>@lang('label.new_account')</p>
                <a href="{{ route('register') }}">@lang('label.register_now')</a>
            </section>
        @endif
    </section>
@endsection
