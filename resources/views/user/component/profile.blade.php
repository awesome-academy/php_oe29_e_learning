@extends('layouts.profile_layout')

@section('content')
    @isset($user)
        <section class="content-container">
            <section class="user-infor">
                <section class="sidebar-infor">
                    <section class="user-sidebar">
                        <a href="" class="flex-link" data-toggle="modal" data-target="#modal-avatar">
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
                        <div class="modal fade" id="modal-avatar">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">@lang('label.change_avatar')</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('avatar.store', [$user->id]) }}" method="POST" id="avatar-change" enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" class="d-none" value="{{ config('validate.update_avatar') }}" name="validate_rule">
                                            <div class="form-group">
                                                <input type='file' id="input-img" name="photo"/>
                                                @error('photo')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                                <img id="img-preview" src="#" class="d-none"/>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" form="avatar-change" class="btn btn-primary">@lang('label.update')</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('label.close')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <a href="{{ route('show.github') }}" class="user-detail-link">
                        <section class="detail-item">
                            <span>@lang('label.github')</span>
                            <span class="detail-description">{{ $user->github_url ? $user->github_url : trans('label.update_github') }}</span>
                        </section>
                        <div><i class="fas fa-chevron-right arrow-color"></i></div>
                    </a>
                    <a href="{{ route('show.localization') }}" class="user-detail-link">
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
