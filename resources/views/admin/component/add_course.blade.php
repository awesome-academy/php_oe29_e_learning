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
                                        <form action="{{ route('courses.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">@lang('label.name')</label>
                                                <input type="text" class="form-control @error ('name') focus @enderror" id="name" value="{{ old('name') }}" placeholder="@lang('label.enter_name')" name="name">
                                                @error ('name')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">@lang('label.description')</label>
                                                <textarea rows="3" class="form-control @error ('description') focus @enderror" id="description" placeholder="@lang('label.enter_description')" name="description" value="{{ old('description') }}"></textarea>
                                                @error('description')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type='file' id="input-img" name="photo"/>
                                                <img id="img-preview" src="#" class="d-none"/>
                                                @error('photo')
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
