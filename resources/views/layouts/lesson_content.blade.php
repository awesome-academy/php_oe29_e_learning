<div class="learning-section">
    <div class="player-column">
        <div class="active-player">
            <div class="learn-active-video">
                <div class="iframe-container">
                    <iframe src="{{ $lesson->video_url }}" frameborder="0"></iframe>
                </div>
            </div>
        </div>
        <div id="comment-container-ajax">
            @include('layouts.comment_content')
        </div>
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
                        <li class="lesson-item @if ($lessonItem->id == $lesson->id) current-study @endif" data-url="{{ route('lesson.enroll', [$lessonItem->id]) }}">
                            <a>
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
                                    <h3>
                                        @lang('label.post', ['index' => $key + 1]){{ $lessonItem->title }} 
                                        @if ($lessonItem->exercises->count() > 0) 
                                            @lang('label.number_exercise', ['number' => $lessonItem->exercises->count()]) 
                                        @endif
                                    </h3>
                                    <p><i class="fas fa-play-circle @if ($lessonItem->id == $lesson->id) color-playing @endif "></i></p>
                                </div>
                            </a>
                        </li>
                        @if ($lesson->id == $lessonItem->id && $lesson->exercises->count() > 0)
                            <li class="test-container">
                                <div class="test-wrapper">
                                    <h3>@lang('label.test')</h3>
                                    @foreach ($lesson->exercises as $key => $exercise)
                                        <button type="button" data-toggle="modal" data-target="#lesson{{ $exercise->id }}" class="exercise-item">
                                            @foreach ($exercise->users as $user)
                                                @if ($user->pivot->status)
                                                    <i class="fas fa-check color-success position-check"></i>
                                                @else
                                                    <i class="fas fa-times color-reject position-check"></i>
                                                @endif
                                            @endforeach
                                            <span>{{ $key + 1 }}</span>
                                        </button>
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
@foreach ($course->lessons as $lessonItem)
    @if ($lesson->id == $lessonItem->id && $lesson->exercises->count() > 0)
        @foreach ($lesson->exercises as $exercise)
            @if ($exercise->users->count() > 0)
                @foreach ($exercise->users as $user)
                    <div class="modal fade" id="lesson{{ $exercise->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">@lang('label.exercises')</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('lesson.submit') }}" method="POST" id="form{{ $exercise->id }}">
                                        @csrf
                                        <input class="d-none" type="text" name="exercise_id" value="{{ $exercise->id }}">
                                        <div class="form-group">
                                            <div class="color-modal-text">{{ $exercise->title }}</div>
                                        </div>
                                        <div class="form-group">
                                            <a class="color-modal-text text-primary" href="{{ $exercise->url }}" target="_blank">{{ $exercise->url }}</a>
                                        </div>
                                        <div class="form-group">
                                            <label class="color-modal-text" for="submit_url">@lang('label.your_answer')</label>
                                            @if ($user->pivot->status == config('status.exercise.finish_number'))
                                                <a class="color-modal-text d-block text-primary" href="{{ $user->pivot->submit_url }}" target="_blank">{{ $user->pivot->submit_url }}</a>
                                            @else
                                                <input type="text" class="form-control" placeholder="@lang('label.enter_link_exercise')" name="submit_url" value="{{ $user->pivot->submit_url }}">
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('label.close')</button>
                                    <button type="submit" class="btn btn-primary n-btn" form="form{{ $exercise->id }}">@lang('label.submit')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="modal fade" id="lesson{{ $exercise->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">@lang('label.exercises')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('lesson.submit') }}" method="POST" id="form{{ $exercise->id }}">
                                    @csrf
                                    <input class="d-none" type="text" name="exercise_id" value="{{ $exercise->id }}">
                                    <div class="form-group">
                                        <div class="color-modal-text">{{ $exercise->title }}</div>
                                    </div>
                                    <div class="form-group">
                                        <a class="color-modal-text text-primary" href="{{ $exercise->url }}" target="_blank">{{ $exercise->url }}</a>
                                    </div>
                                    <div class="form-group">
                                        <label class="color-modal-text" for="submit_url">@lang('label.your_answer')</label>
                                        <input type="text" class="form-control" id="submit_url" placeholder="@lang('label.enter_link_exercise')" name="submit_url">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('label.close')</button>
                                <button type="submit" class="btn btn-primary n-btn" form="form{{ $exercise->id }}">@lang('label.submit')</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
@endforeach
@if(session()->has('error'))
    <div class="error-container"><span class="text-error">{{ session()->get('error') }}</span></div>
@endif
