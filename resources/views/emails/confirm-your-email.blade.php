@component('mail::message')
# one step to confirm your account in Courses Academy

We Need You To Confirm Your Email

@component('mail::button', ['url' => route('confirm-email').'?token='.$user->confirm_token])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
