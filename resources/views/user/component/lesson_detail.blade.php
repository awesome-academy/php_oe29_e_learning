@extends('user.lesson_master')

@section('content')
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
                                        <img src="{{ asset(config('img.img_path')) . Auth::user()->image->url }}" alt="">
                                    @else
                                        <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                                    @endif
                                    <div class="text-input-comment">
                                        <form action="">
                                            <input type="text" placeholder="@lang('label.question')">
                                        </form>
                                    </div>
                                    <div class="comment-submit">
                                        <button>@lang('label.comment_button')</button>
                                    </div>
                                </div>
                            @endauth
                            <div class="comment-detail-student">
                                @foreach ($lesson->comments as $key => $comment)
                                    <div class="avatar-wrap">
                                        @if ($comment->user->image)
                                            <img src="{{ asset(config('img.img_path')) . $comment->user->image->url }}" alt="">
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
                                @endforeach
                            </div>
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
                    <div>
                        <div class="video-group">
                            <h3>@lang('label.post_study')</h3>
                            <div>@lang('label.total_post', ['total' => count($course->lessons)])</div>
                        </div>
                    </div>
                    <ul class="list-video">
                        @foreach ($course->lessons as $key => $lesson)
                            <li>
                                <a href="{{ route('course.lesson', [$lesson->id]) }}">
                                    <div class="check-study"><i class="fas fa-lock"></i></div>
                                    <div class="list-video-content">
                                        <h3>@lang('label.post', ['index' => $key + 1]){{ $lesson->title }}</h3>
                                        <p><i class="fas fa-play-circle"></i></p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
