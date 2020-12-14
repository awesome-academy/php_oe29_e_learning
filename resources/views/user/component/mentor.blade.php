@extends('user.course_master')

@section('mentor')
    active
@endsection

@section('content')
    <section class="all-course-container">
        @auth
            <div class="current-user d-none" data-id="{{ Auth::id() }}"></div>
            <div class="url-chat d-none" data-url="{{ route('chat') }}"></div>
            <section class="chat-list-container">
                <div class="user-container">
                    @foreach ($mentorHasBeenBooked as $mentorGroupBy)
                        <div class="user-item-chat" id="{{ $mentorGroupBy->mentor_id }}" data-name="{{ $mentorGroupBy->mentor->name }}">
                            <div class="avatar-chat sub-avatar-mentor">
                                @if ($mentorGroupBy->mentor->image)
                                    <img src="{{ asset(config('img.img_path') . $mentorGroupBy->mentor->image->url) }}" alt="">
                                @else
                                    <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                                @endif
                            </div>
                            <div class="message-content-container">
                                <div class="user-name-chat">{{ $mentorGroupBy->mentor->name }}</div>
                                <div class="last-message-user">
                                    @if ($mentorGroupBy->mentor->sendMessages->first())
                                        <span class="@if(!$mentorGroupBy->mentor->sendMessages->first()->is_read) unread-message @endif">
                                            {{ $mentorGroupBy->mentor->sendMessages->first()->message }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @foreach ($mentorGroupBy->mentor->sendMessages as $message)
                                @if (!$message->is_read)
                                    <span class="pending"></span>
                                    @break
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </section>
            <section class="mentor-container chat-content d-none" id="text-chat"></section>
        @endauth
        <section class="mentor-container" id="mentor-container-id">
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
    @auth
        @foreach ($requestsOfUser as $request)
            <div class="modal fade" id="request{{ $request->id }}" tabindex="-1" role="dialog" aria-labelledby="modalRating" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">@lang('label.mentor_feedback')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mentor-information">
                                <div class="avatar-mentor">
                                    @if ($request->mentor->image)
                                        <img src="{{ asset(config('img.img_path') . $request->mentor->image->url) }}" alt="">
                                    @else
                                        <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                                    @endif
                                </div>
                                <h6 class="color-modal">{{ $request->mentor->name }}</h6>
                            </div>
                            <form action="{{ route('rating.mentor', $request->mentor->id) }}" method="POST" id="form{{ $request->id }}">
                                @csrf
                                <input class="d-none" type="text" name="request_id" value="{{ $request->id }}">
                                <div class="rating">
                                    <input type="radio" name="rate" id="star1" value="5">
                                    <label for="star1"></label>
                                    <input type="radio" name="rate" id="star2" value="4">
                                    <label for="star2"></label>
                                    <input type="radio" name="rate" id="star3" value="3">
                                    <label for="star3"></label>
                                    <input type="radio" name="rate" id="star4" value="2">
                                    <label for="star4"></label>
                                    <input type="radio" name="rate" id="star5" value="1">
                                    <label for="star5"></label>
                                </div>
                                <div class="form-group">
                                    <label for="comment-area" class="color-modal" id="label-format">@lang('label.rate')</label>
                                    <textarea rows="3" class="form-control color-modal" id="comment-area" placeholder="@lang('label.enter_comment_here')" name="content"></textarea>
                                    @error ('content')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('label.close')</button>
                            <button type="submit" class="btn btn-primary n-btn" form="form{{ $request->id }}">@lang('label.submit')</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endauth
@endsection
