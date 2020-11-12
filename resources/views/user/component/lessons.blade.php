@extends('user.course_master')

@section('content')
    <section class="all-course-container">
        <section class="lesson-container">
            <ul class="link-menu-url">
                <li>
                    <a href="{{ route('courses') }}">@lang('label.course')</a>
                    <i class="fas fa-angle-right svg-format"></i>
                </li>
                <li><a href="">@lang('label.knowledge')</a></li>
            </ul>
            <h1 class="lesson-container-heading">{{ $course->name }}</h1>
            <div class="lesson-container-description">{{ $course->description }}</div>
            <div class="lessons-section">
                <div class="lessons-section-title">
                    <h3>@lang('label.lesson_content')</h3>
                    <span class="lessons-total">{{ $course->lessons->count() }} @lang('label.lesson')</span>   
                </div>
                <div class="lessons-panel">
                    <div class="lessons-panel-group">
                        <div class="sub-panel">
                            <div class="panel-heading">
                                <h5>@lang('label.content')</h5>
                            </div>
                            @foreach ($course->lessons as $lesson)
                                <div class="panel-collapse">
                                    <div class="panel-collapse-body">
                                        <ul>
                                            <li>
                                                <a href="{{ route('course.enroll', [$course->id]) }}">
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
            <div class="learn-comment-block">
                <div class="comment-detail-row">
                    <div class="comment-content-heading">
                        <h4>{{ count($course->comments) }} @lang('label.comment_rate')</h4>
                    </div>
                    @auth
                        <div class="comment-user">
                            @if (Auth::user()->image)
                                <img src="{{ asset(config('img.img_path') . Auth::user()->image->url) }}" alt="">
                            @else
                                <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                            @endif
                            <div class="text-input-comment">
                                <form action="{{ route('course.comment', [$course->id]) }}" method="POST" id="comment-form">
                                    @csrf
                                    <input type="text" placeholder="@lang('label.question')" name="content">
                                    @error('content')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </form>
                            </div>
                            <div class="comment-submit">
                                <button type="submit" form="comment-form">@lang('label.comment_button')</button>
                            </div>
                        </div>
                    @endauth
                    @foreach ($course->comments as $comment)
                        <div class="comment-detail-student">                        
                            <div class="avatar-wrap">
                                @if ($comment->user->image)
                                    <img src="{{ asset(config('img.img_path'). $comment->user->image->url) }}" alt="">
                                @else
                                    <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                                @endif
                            </div>
                            <div class="comment-body">
                                <div class="comment-body-content">
                                    <h5>{{ $comment->user->name }}</h5>
                                    <div class="comment-body-text">
                                        <span>{{ $comment->content }}</span>
                                    </div>
                                </div>
                                <div class="comment-body-time">
                                    <p>
                                        <span>
                                            <span>@lang('label.like')</span>
                                        </span>
                                        <span class="reply-comment">@lang('label.reply')</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
                <form action="{{ route('course.postEnroll') }}" method="POST">
                    @csrf
                    <input class="d-none" type="text" value="{{ $course->id }}" name="course_id">
                    <button class="course-detail-learn-now">@lang('label.continue_study')</button>
                </form>
                <ul>
                    <li>
                        <i class="fas fa-laugh"></i>
                        <span>@lang('label.level')</span>
                    </li>
                    <li>
                        <i class="fas fa-video"></i>
                        <span>@lang('label.total_lessons', ['total' => count($course->lessons)])</span>
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
