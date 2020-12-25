@component('mail::message')
# @lang('label.remind')

@lang('label.let_study', ['name' => $username])

@component('mail::button', ['url' => $url])
@lang('label.study_now')
@endcomponent

<br>
<b>{{ config('title.name') }}</b>
@endcomponent
