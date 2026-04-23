<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\PublicMailbox;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class MailboxExpired implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
 
    public readonly int    $mailboxId;
    public readonly string $email;
 
    public function __construct(PublicMailbox $mailbox)
    {
        $this->mailboxId = $mailbox->id;
        $this->email     = $mailbox->email;
    }
 
    public function broadcastOn(): array
    {
        return [
            new Channel("mailbox.{$this->mailboxId}"),
        ];
    }
 
    public function broadcastAs(): string
    {
        return 'mailbox.expired';
    }
 
    public function broadcastWith(): array
    {
        return [
            'mailbox_id' => $this->mailboxId,
            'email'      => $this->email,
            'expired_at' => now()->toISOString(),
        ];
    }
}
