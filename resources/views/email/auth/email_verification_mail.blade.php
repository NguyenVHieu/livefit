@component('mail::message')
# Introduction

Email Verify

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}
<a href="{{ $data['url'] }}">Click here to verify email</a>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
