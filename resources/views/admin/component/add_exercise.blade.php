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
                                        <h3 class="card-title">@lang('label.table-name')</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('exercises.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">@lang('label.name')</label>
                                                <input type="text" class="form-control @error ('title') focus @enderror" id="title" value="{{ old('title') }}" placeholder="@lang('label.enter_title')" name="title">
                                                @error ('title')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">@lang('label.url')</label>
                                                <input type="text" class="form-control @error ('url') focus @enderror" id="title" value="{{ old('url') }}" placeholder="@lang('label.enter_url')" name="url">
                                                @error('url')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="category">@lang('label.lesson')</label>
                                                <select class="custom-select" id="lesson" name="lesson_id">
                                                    <option selected>@lang('label.chose')</option>
                                                    @foreach ($lessons as $lesson)
                                                        <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('lesson_id')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">@lang('label.submit')</button>
                                        </form>
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
