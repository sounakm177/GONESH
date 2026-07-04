<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public bool $isSocial = false,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to ' . config('app.name') . '!',
        );
    }

    public function content(): Content
    {
        $verifyUrl = $this->isSocial
            ? null
            : \Illuminate\Support\Facades\URL::temporarySignedRoute(
                'verification.verify',
                now()->addDays(7),
                ['id' => $this->user->id, 'hash' => sha1($this->user->email)]
            );

        return new Content(
            markdown: 'emails.welcome',
            with: [
                'user' => $this->user,
                'isSocial' => $this->isSocial,
                'appName' => config('app.name'),
                'dashboardUrl' => route('dashboard.overview'),
                'verifyEmailUrl' => $verifyUrl,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
