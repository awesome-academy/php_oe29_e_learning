<div class="chat-content-container" id="message">
    <div class="header-chat">
        <h3 class="name-mentor"></h3>
        @if ($acceptedRequests->contains('mentor_id', $id))
            <div class="end-container">
                <span class="end-chat" data-toggle="modal" data-target="#request{{ $acceptedRequests->firstWhere(Auth::user()->role_id == config('role.mentor_id') ? 'student_id' : 'mentor_id', $id)->id }}">@lang('label.end')</span>
            </div>
        @else
            <i class="fas fa-times cross"></i>
        @endif
    </div>
    <div class="content-chat-message">
        @foreach ($messages as $message)
            <div class="{{ ($message->from_id == Auth::id() ? 'sender-container' : 'receive-container') }}">
                <div class="message {{ ($message->from_id == Auth::id() ? 'sender' : 'receive') }}">
                    <div class="message-content">
                        <span>{{ $message->message }}</span>
                    </div>
                    <div class="message-time">
                        <span>{{ date('d M y, h:i a', strtotime($message->created_at)) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if ($acceptedRequests->contains((Auth::user()->role_id == config('role.mentor_id') ? 'student_id' : 'mentor_id'), $id))
        <div class="send-action">
            <input type="text" name="message" autocomplete="off"></input>
            <div class="send-action-ajax">
                <i class="fas fa-paper-plane"></i>
            </div>
        </div>
    @endif
</div>
