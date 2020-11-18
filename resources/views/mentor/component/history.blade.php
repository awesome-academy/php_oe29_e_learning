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
                                                    <th>@lang('label.rate')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($histories as $key => $history)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $history->student->name }}</td>
                                                        <td>{{ $history->lesson->title }}</td>
                                                        <td>{{ $history->lesson->course->name }}</td>
                                                        <td>
                                                            @foreach ($history->student->comments as $comment)
                                                                @for ($i = 0; $i < $comment->rate; $i++)
                                                                    <i class="fas fa-star hight-light"></i>
                                                                @endfor
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="paginate-container">{{ $histories->links() }}</div>
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
