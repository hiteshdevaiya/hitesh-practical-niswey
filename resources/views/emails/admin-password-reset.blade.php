@component('mail::message')
# Admin Password Reset

You are receiving this email because we received a password reset request for your admin account.

@component('mail::button', ['url' => route('admin.password.reset', [
    'token' => $token,
    'email' => $email
])])
Reset Password
@endcomponent

This password reset link will expire in 60 minutes.

If you did not request a password reset, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
