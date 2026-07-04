<?php

namespace App\Listeners\Auth;

use App\Events\UserRegistered;
use App\Mail\WelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    public string $queue = 'emails';

    public function handle(UserRegistered $event): void
    {
        $user = $event->user;

        Mail::to($user->email)
            ->send(new WelcomeMail($user, $event->isSocial));

        if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }
    }
}
