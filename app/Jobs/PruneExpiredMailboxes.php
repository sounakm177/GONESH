<?php

namespace App\Jobs;

use App\Events\MailboxExpired;
use App\Models\PublicEmailAttachment;
use App\Models\PublicMailbox;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Scheduled every minute via Console\Kernel.
 *
 * Strategy:
 *  1. Collect IDs of expired mailboxes.
 *  2. Broadcast MailboxExpired to connected browsers (so UI can react).
 *  3. Delete attachment files from disk.
 *  4. Delete DB rows (cascades handle emails + attachments).
 *
 * Processes in batches of 100 to keep memory usage flat.
 */
class PruneExpiredMailboxes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries   = 1;
    public int $timeout = 120;

    public function handle(): void
    {
        $total = 0;

        PublicMailbox::expired()
            ->with('emails.attachments')
            ->chunkById(100, function ($mailboxes) use (&$total) {
                foreach ($mailboxes as $mailbox) {
                    try {
                        // Notify browser
                        MailboxExpired::dispatch($mailbox);

                        // Delete attachment files from storage
                        foreach ($mailbox->emails as $email) {
                            foreach ($email->attachments as $att) {
                                if (Storage::exists($att->file_path)) {
                                    Storage::delete($att->file_path);
                                }
                            }
                        }

                        // DB cascade will remove emails + attachments rows
                        $mailbox->delete();
                        $total++;
                    } catch (\Throwable $e) {
                        Log::error("PruneExpiredMailboxes: failed for mailbox #{$mailbox->id}: " . $e->getMessage());
                    }
                }
            });

        if ($total > 0) {
            Log::info("PruneExpiredMailboxes: pruned {$total} expired mailbox(es).");
        }
    }
}