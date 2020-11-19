@extends('user.course_master')

@section('course')
    active
@endsection

@section('content')
    <section class="all-course-container">
        <ul class="menu-filter">
            <li><a href="" class="active-menu">@lang('label.route')</a></li>
            <li><a href="">@lang('label.match')</a></li>
            <li><a href="">@lang('label.newest')</a></li>
        </ul>
        <section class="course-main-container course-row">
            @foreach ($courses as $course)
                <section class="course-container">
                    <div class="course-detail">
                        <div class="img-title">
                            <div class="overlay-course overlay-row" id="img" data-img="{{ config('img.img_path') . $course->image->url }}"></div>
                        </div>
                        <div class="content content-row">
                            <h6>{{ $course->name }}</h6>
                            <p>{{ $course->description }}</p>
                            <ul>
                                <li>
                                    <div class="logo-course-container"><img src="{{ asset(config('title.logo_course')) }}" alt=""></div>
                                </li>
                                <li class="number-students">
                                    <i class="fas fa-users"></i>
                                    <span>{{ config('title.demo_students') }}</span>
                                </li>
                                <li>
                                    <a href="{{ route('course.lessons', ['course' => $course->id]) }}">@lang('label.study_now')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            @endforeach
        </section>
    </section>
@endsection
