@extends('user.master')

@section('content')
    @isset($courses)
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
                                <div class="overlay-course" id="img" data-img="{{ config('img.img_path') . $course->image->url }}"></div>
                            </div>
                            <div class="content">
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
                                        <a href="#">@lang('label.study_now')</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>
                @endforeach
            </section>
            <section class="button-course-container">
                <div class="button">
                    <a href="{{ route('courses') }}">@lang('label.all_course')</a>
                </div>
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
    @endisset
@endsection
