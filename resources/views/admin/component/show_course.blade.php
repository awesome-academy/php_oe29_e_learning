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
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-image-container"><img src="{{ asset(config('img.img_path') . $course->image->url) }}" alt=""></div>
                                        <div class="card-content-container">
                                            <h3>{{ $course->name }}</h3>
                                            <p>{{ $course->description }}</p>
                                        </div>
                                        <button class="btn btn-primary addRow">@lang('label.add_lesson')</button>
                                        <div class="d-none">{{ $course->id }}</div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <form action="{{ route('lessons.store') }}" method="POST" id="form-add-lessons">
                                            @csrf
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="course-order">@lang('STT')</th>
                                                        <th class="fixed-width">@lang('label.name')</th>
                                                        <th class="fixed-width">@lang('label.description')</th>
                                                        <th class="fixed-width">@lang('label.url')</th>
                                                        <th class="remove-container"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($course->lessons as $key => $lesson)
                                                        <tr>
                                                            <td class="course-order"><div>{{ $lesson->course_order }}</div></td>
                                                            <td>{{ $lesson->title }}</td>
                                                            <td>{{ $lesson->description }}</td>
                                                            <td><div class="text-overflow">{{ $lesson->video_url }}</div></td>
                                                            <td class="remove-container"><div class="d-none">{{ $course->id }}</div></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </form>
                                        <div class="trans-data d-none">@lang('label.submit')</div>
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
