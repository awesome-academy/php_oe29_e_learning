@extends('admin.master')

@section('content')
    <div class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>@lang('label.table_exercises')</h1>
                                <a class="btn btn-primary btn-mine" href="{{ route('exercises.create') }}">@lang('label.add')</a>  
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
                                        <h3 class="card-title">@lang('label.table_exercise')</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>@lang('label.id')</th>
                                                    <th>@lang('label.title')</th>
                                                    <th>@lang('label.url')</th>
                                                    <th>@lang('label.lesson')</th>
                                                    <th>@lang('label.course')</th>
                                                    <th class="width-img">@lang('label.action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($exercises as $key => $exercise)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $exercise->title }}</td>
                                                        <td><div class="text-overflow">{{ $exercise->url }}</div></td>
                                                        <td>{{ $exercise->lesson->title }}</td>
                                                        <td>{{ $exercise->lesson->course->name }}</td>
                                                        <td>
                                                            <a href="{{ $exercise->url }}" target="_blank" type="button" class="btn btn-info">@lang('label.info')</a>
                                                            <a href="{{ route('exercises.edit', [$exercise->id]) }}" type="button" class="btn btn-secondary">@lang('label.edit')</a>
                                                            <form class="form-custom" method="post" action="{{ route('exercises.destroy', [$exercise->id]) }}">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="btn btn-danger">@lang('label.delete')</button>
                                                            </form>
                                                        </td>
                                                    </tr>
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
