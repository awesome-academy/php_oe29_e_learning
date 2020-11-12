@extends('admin.master')

@section('content')
    <div class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>@lang('label.table_course')</h1>
                                <a class="btn btn-primary btn-mine" href="{{ route('courses.create') }}">@lang('label.add')</a>  
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
                                        <h3 class="card-title">@lang('label.course_title')</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>@lang('label.id')</th>
                                                    <th>@lang('label.name')</th>
                                                    <th>@lang('label.description')</th>
                                                    <th>@lang('label.image')</th>
                                                    <th class="width-img">@lang('label.action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($courses as $key => $course)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $course->name }}</td>
                                                        <td>{{ $course->description }}</td>
                                                        <td><img src="{{ asset(config('img.img_path') . $course->image->url) }}" class="width-img"></td>
                                                        <td>
                                                            <a href="{{ route('courses.show', [$course->id]) }}" type="button" class="btn btn-info">@lang('label.info')</a>
                                                            <a href="{{ route('courses.edit', [$course->id]) }}" type="button" class="btn btn-secondary">@lang('label.edit')</a>
                                                            <form class="form-custom" method="post" action="{{ route('courses.destroy', [$course->id]) }}">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="btn btn-danger">@lang('label.delete')</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="paginate-container">{{ $courses->links() }}</div>
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
