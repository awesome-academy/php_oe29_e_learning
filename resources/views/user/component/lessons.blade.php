@extends('user.course_master')

@section('content')
    <section class="all-course-container">
        <section class="lesson-container">
            <ul class="link-menu-url">
                <li>
                    <a href="">@lang('label.course')</a>
                    <i class="fas fa-angle-right svg-format"></i>
                </li>
                <li><a href="">@lang('label.knowledge')</a></li>
            </ul>
            <h1 class="lesson-container-heading">{{ $course->name }}</h1>
            <div class="lesson-container-description">{{ $course->description }}</div>
            <div class="lessons-section">
                <div class="lessons-section-title">
                    <h3>@lang('label.lesson_content')</h3>
                    <span class="lessons-total">{{ $course->lessons->count() }} @lang('label.lessons')</span>   
                </div>
                <div class="lessons-panel">
                    <div class="lessons-panel-group">
                        <div class="sub-panel">
                            <div class="panel-heading">
                                <h5>@lang('label.content')</h5>
                            </div>
                            @foreach ($course->lessons as $key => $lesson)
                                <div class="panel-collapse">
                                    <div class="panel-collapse-body">
                                        <ul>
                                            <li>
                                                <a href="">
                                                    <span>
                                                        <i class="fas fa-play-circle"></i>
                                                        <div>{{ $lesson->title }}</div>
                                                    </span>
                                                    <span>@lang('label.study_now')</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="comment-block">
                <div class="comment-detail-row">
                    <div class="comment-content-heading">
                        <h4>@lang('label.comment_number')</h4>
                    </div>
                    <div class="comment-box"></div>
                </div>
            </div>
        </section>
        <section class="course-module">
            <div class="course-detail-purchase">
                <div class="course-img-preview">
                    <a href="">
                        <div class="course-detail-background"></div>
                        <i class="fas fa-play-circle position-center"></i>
                    </a>
                </div>
                <p class="course-detail-register">@lang('label.user_registered')</p>
                <button class="course-detail-learn-now"><a href="">@lang('label.continue_study')</a></button>
                <ul>
                    <li>
                        <i class="fas fa-laugh"></i>
                        <span>@lang('label.level')</span>
                    </li>
                    <li>
                        <i class="fas fa-video"></i>
                        <span>@lang('label.total_lessons')</span>
                    </li>
                    <li>
                        <i class="fas fa-laptop-code"></i>
                        <span>@lang('label.online_study')</span>
                    </li>
                </ul>
            </div>
        </section>
    </section>
@endsection
