@extends('mentor.master')

@section('content')
    <div class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content" id="content-chat">
                    <div class="current-user d-none" data-id="{{ Auth::id() }}"></div>
                    <div class="url-chat d-none" data-url="{{ route('chat') }}"></div>
                    <section class="chat-list-container">
                        <div class="user-container">
                            @foreach ($students as $studentGroupBy)
                                <div class="user-item-chat" id="{{ $studentGroupBy->student_id }}" data-name="{{ $studentGroupBy->student->name }}">
                                    <div class="avatar-chat sub-avatar-mentor">
                                        @if ($studentGroupBy->student->image)
                                            <img src="{{ asset(config('img.img_path') . $studentGroupBy->student->image->url) }}" alt="">
                                        @else
                                            <img src="{{ asset(config('title.avatar_default')) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="message-content-container">
                                        <div class="user-name-chat">{{ $studentGroupBy->student->name }}</div>
                                        <div class="last-message-user">
                                            @if ($studentGroupBy->student->sendMessages->first())
                                                <span class="@if(!$studentGroupBy->student->sendMessages->first()->is_read) unread-message @endif">
                                                    {{ $studentGroupBy->student->sendMessages->first()->message }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    @foreach ($studentGroupBy->student->sendMessages as $message)
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
                </section>
            </div>
        </div>
    </div>
@endsection
