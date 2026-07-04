<?php

namespace App\Listeners\Auth;

use App\Events\UserLoggedIn;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateLastLogin implements ShouldQueue
{
    public string $queue = 'default';

    public function handle(UserLoggedIn $event): void
    {
        $event->user->update([
            'last_login_at' => now(),
        ]);
    }
}
