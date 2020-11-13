@extends('user.course_master')

@section('content')
    <section class="all-course-container">
        <section class="mentor-container">
            @foreach ($mentors as $mentor)
                <div class="mentor-box">
                    <div class="mentor-heading">
                        <div class="avatar-mentor-container">
                            <div class="sub-avatar-mentor">
                                @if ($mentor->image)
                                    <img src="{{ asset(config('img.img_path') . $mentor->image->url) }}" alt="">
                                @else
                                    <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="name-star-container">
                            <div class="name-mentor">
                                <h3>{{ $mentor->name }}</h3>
                            </div>
                            <div class="rate-number">
                                @if ($mentor->rate)
                                    @for ($i = 0; $i < $mentor->rate; $i++)
                                        <i class="fas fa-star hight-light"></i>
                                    @endfor
                                @else
                                    <i class="fas fa-star hight-light"></i>
                                    <i class="fas fa-star hight-light"></i>
                                    <i class="fas fa-star hight-light"></i>
                                    <i class="fas fa-star hight-light"></i>
                                    <i class="fas fa-star hight-light"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mentor-description">
                        <div class="mentor-description-content">
                            <div class="main-information">
                                <p>@lang('label.year_of_birth', ['year' => $mentor->date_of_birth ])</p>
                                <p>{{ $mentor->address }}</p>
                                <p>@lang('label.fake_knowledge')</p>   
                                <p>@lang('label.program_language')</p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="mentor-profile-button" data-id="{{ $mentor->id }}">Profile</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
        <section class="side-show">
            @foreach ($mentors as $mentor)
                <div id="{{ $mentor->id }}">
                    <div class="black-screen" id="black-{{ $mentor->id }}"></div>
                    <div class="rate-content-user" id="content-{{ $mentor->id }}">
                        <div class="heading-content-rate"><i class="fas fa-times cursor" id="close-{{ $mentor->id }}"></i></div>
                        <div class="information-mentor-rate">
                            <div class="avatar-container-rate">
                                <div class="avatar-mentor-rate">
                                    @if ($mentor->image)
                                        <img src="{{ asset(config('img.img_path') . $mentor->image->url) }}" alt="">
                                    @else
                                        <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                                    @endif
                                </div>
                                <div class="name-mentor-rate">{{ $mentor->name }}</div>
                                <div class="mentor-number-rate">
                                    @if ($mentor->rate)
                                        @for ($i = 0; $i < $mentor->rate; $i++)
                                            <i class="fas fa-star hight-light"></i>
                                        @endfor
                                    @else
                                        <i class="fas fa-star hight-light"></i>
                                        <i class="fas fa-star hight-light"></i>
                                        <i class="fas fa-star hight-light"></i>
                                        <i class="fas fa-star hight-light"></i>
                                        <i class="fas fa-star hight-light"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="sub-separate-rate"></div>
                            <div class="information-content-rate">
                                <h3>@lang('label.introduction')</h3>
                                <p>@lang('label.year_of_birth', ['year' => $mentor->date_of_birth ])</p>
                                <p>{{ $mentor->address }}</p>
                                <p>@lang('label.fake_knowledge')</p>   
                                <p>@lang('label.program_language')</p>
                            </div>
                        </div>
                        <div class="comment-user-rate">
                            <h3>@lang('label.reviews')</h3>
                            <div>
                                @foreach ($mentor->mentorComments as $comment)
                                    <div class="comment-content-rate">
                                        <div class="avatar-content-rate">
                                            @if ($comment->user->image)
                                                <img src="{{ asset(config('img.img_path')  . $comment->user->image->url) }}" alt="">
                                            @else
                                                <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                                            @endif
                                        </div>
                                        <div class="main-rate">
                                            <div class="main-content-rate">
                                                <div class="name-user-rate">{{ $comment->user->name }}</div>
                                                <div class="star-rate">
                                                @for ($i = 0; $i < $comment->rate; $i++)
                                                    <i class="fas fa-star hight-light"></i>
                                                @endfor
                                                </div>
                                            </div>
                                            <div class="content-student-rate">{{ $comment->content }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </section>
@endsection
