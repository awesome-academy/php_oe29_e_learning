@extends('admin.master')

@section('content')
    <div class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>@lang('label.student')</h1>
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
                                        <h3 class="card-title">@lang('label.table-name')</h3>
                                        <div class="card-tools">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>@lang('label.id')</th>
                                                    <th>@lang('label.name')</th>
                                                    <th>@lang('label.email')</th>
                                                    <th>@lang('label.phone')</th>
                                                    <th>@lang('label.date')</th>
                                                    <th>@lang('label.address')</th>
                                                    <th>@lang('label.action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($students as $key => $student)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $student->name }}</td>
                                                        <td>{{ $student->email }}</td>
                                                        <td>{{ $student->phone }}</td>
                                                        <td>{{ $student->date_of_birth }}</td>
                                                        <td>{{ $student->address }}</td>
                                                        <td>
                                                        <form action="">
                                                            <select name="status">
                                                                <option value="{{ config('status.user.active_number') }}">@lang('label.active')</option>
                                                                <option value="{{ config('status.user.reject_number') }}">@lang('label.reject')</option>
                                                                <option value="{{ config('status.user.disable_number') }}">@lang('label.disable')</option>
                                                            </select>
                                                        </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
