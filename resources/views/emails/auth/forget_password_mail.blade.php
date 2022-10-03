@component('mail::message')
# Reset Password

Reset Password

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

<a href="{{ $data['url'] }}">Click here to reset password</a>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
