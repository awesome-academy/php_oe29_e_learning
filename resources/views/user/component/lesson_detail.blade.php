@extends('user.lesson_master')

@section('content')
    @if(session()->has('message'))
        <div class="book-success" id="alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="learning-section">
        <div class="player-column">
            <div class="active-player">
                <div class="learn-active-video">
                    <div class="iframe-container">
                        <iframe src="{{ $lesson->video_url }}" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
            <section class="comment-container">
                <section>
                    <div class="tab-header">
                        <p class="sub-tab">@lang('label.over_view')</p>
                    </div>
                    <div class="learning-description">
                        <p>@lang('label.join_f8')</p>
                        <p>@lang('label.subscribe')</p>
                    </div>
                    <div class="learn-comment-block">
                        <div class="comment-detail-row">
                            <div class="comment-content-heading">
                                <h4>{{ count($lesson->comments) }} @lang('label.question_answer')</h4>
                            </div>
                            @auth
                                <div class="comment-user">
                                    @if (Auth::user()->image)
                                        <img src="{{ asset(config('img.img_path') . Auth::user()->image->url) }}" alt="">
                                    @else
                                        <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                                    @endif
                                    <div class="text-input-comment">
                                        <form action="{{ route('lesson.comment', [$lesson->id]) }}" method="POST" id="comment-form">
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
                            @foreach ($lesson->comments as $comment)
                                <div class="comment-detail-student">
                                    <div class="avatar-wrap">
                                        @if ($comment->user->image)
                                            <img src="{{ asset(config('img.img_path') . $comment->user->image->url) }}" alt="">
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
            </section>
            <div class="footer-wrapper">
                <h2>@lang('label.website')</h2>
                <div>@lang('label.made_with')</div>
            </div>
        </div>
        <div class="learning-playlist">
            <div class="learn-playlist">
                <header>
                    <h1>{{ $course->name }}</h1>
                </header>
                <div class="related-video">
                    <div class="heading-video">
                        <div class="video-group">
                            <h3>@lang('label.post_study')</h3>
                            <div>@lang('label.total_post', ['total' => count($course->lessons)])</div>
                        </div>
                        <div class="book-mentor">
                            <form action="{{ route('lesson.mentor') }}" method="POST">
                                @csrf
                                <input class="d-none" type="text" value="{{ $lesson->id }}" name="lesson_id">
                                <button class="book-mentor-btn">@lang('label.book_mentor')</button>
                            </form>
                        </div>
                    </div>
                    <ul class="list-video">
                        @foreach ($course->lessons as $key => $lessonItem)
                            <li>
                                <a href="{{ route('lesson.enroll', [$lessonItem->id]) }}">
                                    <div class="check-study">
                                        @if ($lessonItem->status == config('status.course.finish_number'))
                                            <i class="fas fa-check color-success"></i>
                                        @elseif ($lessonItem->status == config('status.course.progress_number'))
                                            <i class="fas fa-spinner color-playing"></i>
                                        @elseif ($lessonItem->status == config('status.course.not_register_number'))
                                            <i class="fas fa-lock"></i>
                                        @endif
                                    </div>
                                    <div class="list-video-content">
                                        <h3>@lang('label.post', ['index' => $key + 1]){{ $lessonItem->title }}</h3>
                                        <p><i class="fas fa-play-circle @if ($lessonItem->id == $lesson->id) color-playing @endif "></i></p>
                                    </div>
                                </a>
                            </li>
                            @if ($lesson->id == $lessonItem->id && $lesson->exercises->count() > 0)
                                <li class="test-container">
                                    <div class="test-wrapper">
                                        <h3>@lang('label.test')</h3>
                                        @foreach ($lesson->exercises as $key => $exercise)
                                            <div class="exercise-item">
                                                <span>{{ $key + 1 }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
