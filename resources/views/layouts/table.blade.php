<div class="card-body table-responsive p-0">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>@lang('label.id')</th>
                <th>@lang('label.title')</th>
                <th>@lang('label.description')</th>
                <th class="video-url-container">@lang('label.url')</th>
                <th>@lang('label.course')</th>
                <th class="width-img">@lang('label.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lessons as $key => $lesson)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $lesson->title }}</td>
                    <td>{{ $lesson->description }}</td>
                    <td >
                        <div class="video-url-container">{{ $lesson->video_url }}</div></td>
                    <td>{{ $lesson->course->name }}</td>
                    <td>
                        <a href="{{ route('lessons.show', [$lesson->id]) }}" type="button" class="btn btn-info">@lang('label.info')</a>
                        <a href="{{ route('lessons.edit', [$lesson->id]) }}" type="button" class="btn btn-secondary">@lang('label.edit')</a>
                        <form class="form-custom" method="post" action="{{ route('lessons.destroy', [$lesson->id]) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">@lang('label.delete')</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginate-container">{{ $lessons->links() }}</div>
</div>
