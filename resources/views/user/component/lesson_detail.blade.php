@extends('user.lesson_master')

@section('content')
    @if(session()->has('message'))
        <div class="book-success" id="alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div id="ajax-lesson-detail">
        @include('layouts.lesson_content')
    </div>
@endsection
