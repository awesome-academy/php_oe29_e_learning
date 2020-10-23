@extends('user.master')

@section('content')
    <section class="feature-container">
        <section class="feature">
            <img src="{{ asset(config('title.feature_1')) }}" alt="feature-1">
            <h3>@lang('label.title_feature1')</h3>
        </section>
        <section class="feature">
            <img src="{{ asset(config('title.feature_2')) }}" alt="feature-2">
            <h3>@lang('label.title_feature2')</h3>
        </section>
        <section class="feature">
            <img src="{{ asset(config('title.feature_3')) }}" alt="feature-3">
            <h3>@lang('label.title_feature3')</h3>
        </section>
    </section>
    <section class="course-section">
        <section class="header-course">
            <h2>@lang('label.hot_course')</h2>
            <p>@lang('label.title_course_section')</p>
        </section>
        <section class="course-main-container">
            @foreach ($courses as $course)
                <section class="course-container">
                    <div class="course-detail">
                        <div class="img-title">
                            <div class="overlay-course" id="img" data-img="{{ $course->url }}"></div>
                        </div>
                        <div class="content">
                            <h6>{{ $course->name }}</h6>
                            <p>{{ $course->description }}</p>
                            <ul>
                                <li>
                                    <div class="logo-course-container"><img src="{{ asset(config('title.unnamed.png')) }}" alt=""></div>
                                </li>
                                <li class="number-students">
                                    <i class="fas fa-users"></i>
                                    <span>{{ config('title.demo_students') }}</span>
                                </li>
                                <li>
                                    <a href="#">@lang('label.study_now')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            @endforeach
        <section class="button-course-container">
            <div class="button">
                <a href="#">@lang('label.all_course')</a>
            </div>
        </section>
    </section>
@endsection
