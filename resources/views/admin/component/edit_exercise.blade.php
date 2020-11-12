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
                                        <form action="{{ route('exercises.update', $exercise->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">@lang('label.name')</label>
                                                <input type="text" class="form-control @error ('title') focus @enderror" id="title" placeholder="@lang('label.enter_title')" name="title" value="{{ $exercise->title }}">
                                                @error ('title')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">@lang('label.url')</label>
                                                <input type="text" class="form-control @error ('url') focus @enderror" id="title" placeholder="@lang('label.enter_url')" name="url" value="{{ $exercise->url }}">
                                                @error('url')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="category">@lang('label.lesson')</label>
                                                <select class="custom-select" id="lesson" name="lesson_id">
                                                    @foreach ($lessons as $lesson)
                                                        @if ($lesson->id == $exercise->lesson->id)
                                                            <option value="{{ $lesson->id }}" selected>{{ $lesson->title }}</option>
                                                        @else
                                                            <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                                                        @endif
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
