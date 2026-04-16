<?php

namespace App\Jobs;

use App\Events\MailboxExpired;
use App\Models\PublicMailbox;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class PruneExpiredMailboxes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries   = 1;
    public int $timeout = 120;

    public function handle(): void
    {
        $total  = 0;
        $failed = 0;

        PublicMailbox::expired()
            ->with('emails.attachments') 
            ->chunkById(100, function ($mailboxes) use (&$total, &$failed) {
                foreach ($mailboxes as $mailbox) {
                    try {
                        $this->pruneOne($mailbox);
                        $total++;
                    } catch (\Throwable $e) {
                        $failed++;
                        Log::error('PruneExpiredMailboxes: failed', [
                            'mailbox_id' => $mailbox->id,
                            'email'      => $mailbox->email,
                            'error'      => $e->getMessage(),
                            'trace'      => $e->getTraceAsString(),
                        ]);
                    }
                }
            });

        if ($total > 0 || $failed > 0) {
            Log::info('PruneExpiredMailboxes: complete', [
                'pruned' => $total,
                'failed' => $failed,
            ]);
        }
    }

    private function pruneOne(PublicMailbox $mailbox): void
    {
        MailboxExpired::dispatch($mailbox);

        foreach ($mailbox->emails as $email) {
            foreach ($email->attachments as $attachment) {
                if ($attachment->file_path && Storage::exists($attachment->file_path)) {
                    Storage::delete($attachment->file_path);
                }

                $dir = dirname($attachment->file_path);
                if (Storage::exists($dir)) {
                    $remaining = Storage::files($dir);
                    if (empty($remaining)) {
                        Storage::deleteDirectory($dir);
                    }
                }
            }
        }
        
        $mailbox->delete();
    }
}