<?php

namespace App\Console\Commands;

use App\Events\MailboxExpired;
use App\Models\PublicMailbox;
use Illuminate\Console\Command;

class ExpireMailbox extends Command
{
    protected $signature = 'mailbox:expire
                            {--id=      : Specific mailbox ID to expire}
                            {--email=   : Specific mailbox email to expire}
                            {--dry-run  : Preview only — no dispatch, no delete}';

    protected $description = 'Dispatch MailboxExpired event and prune mailbox(es)';

    public function handle(): int
    {
        $isDryRun = $this->option('dry-run');
        $id       = $this->option('id');
        $email    = $this->option('email');

        if ($id || $email) {
            $query = PublicMailbox::query();
            if ($id)    $query->where('id', $id);
            if ($email) $query->where('email', $email);

            $mailbox = $query->first();

            if (! $mailbox) {
                $this->error('Mailbox not found.');
                return self::FAILURE;
            }

            $this->info("Target: [{$mailbox->id}] {$mailbox->email}");
            $this->line("  Session : {$mailbox->session_id}");
            $this->line("  Expires : {$mailbox->expires_at}");
            $this->line("  Expired?: " . ($mailbox->isExpired() ? 'YES' : 'no (will force-expire)'));

            if ($isDryRun) {
                $this->warn('[dry-run] Would dispatch MailboxExpired and delete.');
                return self::SUCCESS;
            }

            if (! $this->confirm("Dispatch MailboxExpired and DELETE mailbox [{$mailbox->email}]?")) {
                $this->line('Aborted.');
                return self::SUCCESS;
            }

            $this->dispatchAndDelete($mailbox);
            $this->info("Done. Mailbox [{$mailbox->email}] expired and deleted.");
            return self::SUCCESS;
        }

        $count = PublicMailbox::expired()->count();

        if ($count === 0) {
            $this->info('No expired mailboxes found.');
            return self::SUCCESS;
        }

        $this->info("Found {$count} expired mailbox(es).");

        if ($isDryRun) {
            PublicMailbox::expired()->each(function ($m) {
                $this->line("  [dry-run] Would expire: [{$m->id}] {$m->email}");
            });
            return self::SUCCESS;
        }

        $bar = $this->output->createProgressBar($count);
        $bar->start();

        $done   = 0;
        $failed = 0;

        PublicMailbox::expired()
            ->with('emails.attachments')
            ->chunkById(50, function ($mailboxes) use ($bar, &$done, &$failed) {
                foreach ($mailboxes as $mailbox) {
                    try {
                        $this->dispatchAndDelete($mailbox);
                        $done++;
                    } catch (\Throwable $e) {
                        $failed++;
                        $this->newLine();
                        $this->error("Failed [{$mailbox->id}]: {$e->getMessage()}");
                    }
                    $bar->advance();
                }
            });

        $bar->finish();
        $this->newLine();
        $this->info("Expired: {$done} | Failed: {$failed}");

        return $failed > 0 ? self::FAILURE : self::SUCCESS;
    }


    private function dispatchAndDelete(PublicMailbox $mailbox): void
    {
        MailboxExpired::dispatch($mailbox);

        foreach ($mailbox->emails as $email) {
            foreach ($email->attachments as $att) {
                if (\Illuminate\Support\Facades\Storage::exists($att->file_path)) {
                    \Illuminate\Support\Facades\Storage::delete($att->file_path);
                }
            }
        }

        $mailbox->delete();
    }
}