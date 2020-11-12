@extends('mentor.master')

@section('content')
    <div class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>@lang('label.table_request')</h1> 
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
                                        <h3 class="card-title">@lang('label.request_title')</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>@lang('label.id')</th>
                                                    <th>@lang('label.user')</th>
                                                    <th>@lang('label.lesson')</th>
                                                    <th>@lang('label.course')</th>
                                                    <th>@lang('label.action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($coaches as $key => $coach)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $coach->student->name }}</td>
                                                        <td>{{ $coach->lesson->title }}</td>
                                                        <td>{{ $coach->lesson->course->name }}</td>
                                                        <td>
                                                            <a href="#" type="button" class="btn btn-success">@lang('label.accept')</a>
                                                            <a href="#" type="button" class="btn btn-danger">@lang('label.reject')</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="paginate-container">{{ $coaches->links() }}</div>
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
