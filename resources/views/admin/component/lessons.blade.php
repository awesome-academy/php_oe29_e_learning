@extends('admin.master')

@section('content')
    <div class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>@lang('label.table')</h1>
                                <a class="btn btn-primary btn-mine" href="{{ route('lessons.create') }}">@lang('label.add')</a>  
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header dp-flex">
                                        <h3 class="card-title mb-3">@lang('label.table-name')</h3>
                                        <div class="dropdown" id="lightdropdown">
                                            <div class="dropdown-select">
                                                <span class="dropdown-selected" data-url="{{ route('lesson_filter', Config::get('filter.default')) }}">@lang('label.all')</span>
                                                <i class="fa fa-angle-down dropdown-caret"></i>
                                            </div>
                                            <ul class="dropdown-list">
                                                <li class="dropdown-item" data-id="{{ config('filter.default') }}" data-value="@lang('label.all')">
                                                    @lang('label.all')
                                                </li>
                                                @foreach ($courses as $key => $course)
                                                    <li class="dropdown-item" data-value="{{ $course->name }}" data-id="{{ $course->id }}">
                                                        {{ $course->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="ajax-container">
                                        @include('layouts.table')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
