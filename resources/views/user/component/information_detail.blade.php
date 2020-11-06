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
                    <h1>@lang('label.user_information')</h1>
                    <p>@lang('label.change_information_description')</p>
                </section>
            </section>
            <section class="change-email">
                <section>
                    <form action="{{ route('update', auth()->user()->id) }}" method="POST" id="update-information-form">
                        @method('PATCH')
                        @csrf
                        <input type="text" class="d-none" value="{{ config('validate.update_information') }}" name="validate_rule">
                        <div class="input-container">
                            <label for="">@lang('label.full_name')</label>
                            <div>
                                <input type="text" placeholder="@lang('label.enter_full_name')" value="{{ $user->name }}" name="name" class="@error('name') error-focus @enderror">
                                @error('name')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="input-container">
                            <label for="">@lang('label.date_of_birth')</label>
                            <div>
                                <input type="text" placeholder="@lang('label.enter_date')" value="{{ $user->date_of_birth }}" name="date_of_birth" class="@error('date_of_birth') error-focus @enderror">
                                @error('date_of_birth')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="input-container">
                            <label for="">@lang('label.phone')</label>
                            <div>
                                <input type="text" placeholder="@lang('label.phone_number')" value="{{ $user->phone }}" name="phone" class="@error('phone') error-focus @enderror">
                                @error('phone')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="input-container">
                            <label for="">@lang('label.address')</label>
                            <div>
                                <input type="text" placeholder="@lang('label.enter_address')" value="{{ $user->address }}" name="address" class="@error('address') error-focus @enderror">
                                @error('address')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </form>
                    <section class="btn-submit-container">
                        <button type="submit" form="update-information-form">@lang('label.update')</button>
                    </section>
                </section>
            </section>
            <div class="tips-email-container">
                <div class="tips-email">
                    <svg class="message-icon" viewBox="0 0 16 16"><path fill="currentColor" d="M8 0c4.42 0 8 3.58 8 8s-3.58 8-8 8-8-3.58-8-8 3.58-8 8-8zm0 14.914A6.911 6.911 0 0 0 14.914 8 6.911 6.911 0 0 0 8 1.086 6.911 6.911 0 0 0 1.086 8 6.911 6.911 0 0 0 8 14.914zM7.25 5V3.5h1.5V5h-1.5zm1.5 1.5v6h-1.5v-6h1.5z"></path></svg>
                    <div class="message-body">
                        <p>@lang('label.should_information')</p>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
