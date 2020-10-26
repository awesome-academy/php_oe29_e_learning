@extends('layouts.app')

@section('content')
    <section class="body-auth">
        <section class="content-auth">
            <section class="form-auth">
                <h1 class="auth-heading">@lang('label.register')</h1>
                <p class="auth-sub-heading">@lang('label.f8_auth_title')</p>
                <ul>
                    <li>
                        <button class="auth-btn-third">
                            <div class="auth-img-container">
                                <img src="{{ asset(config('title.auth_facebook_logo')) }}" alt="">
                            </div>
                            <span class="with-before">@lang('label.f8_register_google')</span>
                        </button>
                    </li>
                    <li>
                        <button class="auth-btn-third">
                            <div class="auth-img-container">
                                <img src="{{ asset(config('title.auth_google_logo')) }}" alt="">
                            </div>
                            <span class="with-before">@lang('label.f8_register_facebook')</span>
                        </button>
                    </li>
                    <p class="auth-sub-heading space">@lang('label.f8_trick_register')</p>
                    <li class="auth-separator">
                        <span class="sub-auth-separator">@lang('label.or')</span>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="text-input-container">
                                <label for="name">@lang('label.full_name')</label>
                                <input type="text" class="auth-input" id="name" placeholder="@lang('label.enter_name')" name="name">
                                @error('name')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-input-container">
                                <label for="email">Email</label>
                                <input type="email" class="auth-input" id="email" placeholder="@lang('label.enter_email')" name="email">
                                @error('email')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-input-container">
                                <label for="password">@lang('label.password')</label>
                                <input type="password" class="auth-input" id="password" placeholder="@lang('enter_password')" name="password">
                                @error('password')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-input-container">
                                <label for="re-password">@lang('label.re_password')</label>
                                <input type="password" class="auth-input" id="re-password" placeholder="Nhập mật khẩu" name="password_confirmation">
                                @error('password')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="auth-btn-submit">@lang('label.register')</button>
                        </form>
                        <section class="auth-reset-pwd">
                            <p class="auth-link-register">@lang('label.pre_term') <a href="" class="auth-link">@lang('label.term')</a> @lang('label.post_term')</p>
                        </section>
                    </li>
                </ul>
            </section>
        </section>
        @if (Route::has('login'))
        <section class="other-action">
            <p>@lang('label.accout_exist')</p>
            <a href="{{ route('login') }}">@lang('label.login')</a>
        </section>
        @endif
    </section>
@endsection
