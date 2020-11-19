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
