@extends('admin.master')

@section('content')
    <div class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>@lang('label.exercises')</h1>
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
                                        <h3 class="card-title">@lang('label.exercise')</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>@lang('label.id')</th>
                                                    <th>@lang('label.title')</th>
                                                    <th>@lang('label.url')</th>
                                                    <th>@lang('label.submit_url')</th>
                                                    <th>@lang('label.action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $index = 1;
                                                @endphp
                                                @foreach ($exercises as $keyExercise => $exercise)
                                                    @foreach ($exercise->users as $keyUser => $user)
                                                        <tr>
                                                            <td>{{ $index++ }}</td>
                                                            <td>{{ $exercise->title }}</td>
                                                            <td><div class="text-overflow">{{ $exercise->url }}</div></td>
                                                            <td><div class="text-overflow">{{ $user->pivot->submit_url }}</div></td>
                                                            <td>
                                                                <a href="{{ $user->pivot->submit_url }}" target="_blank" type="button" class="btn btn-info">@lang('label.info')</a>
                                                                <form class="form-custom" method="POST" action="{{ route('students.accept', [$exercise->id]) }}">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="text" class="d-none" value="{{ $user->id }}" name="student_id">
                                                                    <button type="submit" class="btn btn-success">@lang('label.accept')</button>
                                                                </form>
                                                                <form class="form-custom" method="POST" action="{{ route('students.reject', [$exercise->id]) }}">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="text" class="d-none" value="{{ $user->id }}" name="student_id">
                                                                    <button type="submit" class="btn btn-danger">@lang('label.reject')</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="paginate-container">{{ $exercises->links() }}</div>
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
