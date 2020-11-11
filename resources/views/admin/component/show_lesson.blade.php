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
                                        <div class="card-image-container iframe-show-lesson">
                                            <iframe src="{{ $lesson->video_url }}" frameborder="0"></iframe>
                                        </div>
                                        <div class="card-content-container">
                                            <h3>{{ $lesson->title }}</h3>
                                            <p>{{ $lesson->description }}</p>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
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
