@component('mail::message')
# Welcome to {{ $appName }}, {{ $user->name }}!

Thank you for joining {{ $appName }}. We're excited to have you on board.

@if ($isSocial)
Your account was created using **{{ ucfirst($user->provider) }}**. Your email has been verified automatically, so you can start using all features right away.
@else
Please verify your email address to unlock all features and ensure the security of your account.
@endif

@component('mail::button', ['url' => $dashboardUrl, 'color' => 'primary'])
Go to Dashboard
@endcomponent

@if ($verifyEmailUrl)
@component('mail::button', ['url' => $verifyEmailUrl, 'color' => 'success'])
Verify Email Address
@endcomponent
@endif

If you have any questions, feel free to reply to this email or visit our support center.

Thanks,<br>
{{ $appName }} Team
@endcomponent
