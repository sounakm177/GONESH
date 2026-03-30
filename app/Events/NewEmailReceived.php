<?php

namespace App\Events;

use App\Models\PublicEmail;
use App\Models\PublicMailbox;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewEmailReceived implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly PublicEmail   $email,
        public readonly PublicMailbox $mailbox,
    ) {}


    public function broadcastOn(): array
    {
        echo $this->mailbox->id;
        return [
            new Channel("mailbox.{$this->mailbox->id}"),
        ];
    }

    public function broadcastAs(): string
    {
        return 'new.email';
    }

    public function broadcastWith(): array
    {
        return [
            'id'          => $this->email->id,
            'sender'      => $this->email->senderName(),
            'sender_email'=> $this->email->senderEmail(),
            'subject'     => $this->email->subject,
            'preview'     => substr(strip_tags($this->email->body), 0, 120),
            'received_at' => $this->email->received_at->toISOString(),
            'time_ago'    => $this->email->timeAgo(),
            'has_attachments' => $this->email->attachments()->exists(),
            'avatar_letter'   => $this->email->avatarLetter(),
            'avatar_color'    => $this->email->avatarColor(),
            'unread_count'    => $this->mailbox->unreadCount(),
        ];
    }
}