<?php

namespace App\Console\Commands;

use App\Models\Alias;
use App\Models\AliasLog;
use Illuminate\Console\Command;

class SeedAliasLogs extends Command
{
    protected $signature = 'alias:seed-logs {--id= : Alias ID to seed logs for} {--count=20 : Number of log entries to create}';
    protected $description = 'Seed dummy forwarding history logs for an alias';

    public function handle(): int
    {
        $aliasId = $this->option('id');
        $count = (int) $this->option('count');

        if (!$aliasId) {
            $alias = Alias::first();
            if (!$alias) {
                $this->error('No aliases found. Create an alias first or use --id to specify one.');
                return 1;
            }
            $aliasId = $alias->id;
            $this->line("No --id given, using first alias ID: {$aliasId}");
        } else {
            $alias = Alias::find($aliasId);
            if (!$alias) {
                $this->error("Alias ID {$aliasId} not found.");
                return 1;
            }
        }

        $senders = [
            ['email' => 'no-reply@amazon.com',       'name' => 'Amazon'],
            ['email' => 'notifications@shopify.com',  'name' => 'Shopify'],
            ['email' => 'info@netflix.com',           'name' => 'Netflix'],
            ['email' => 'service@paypal.com',         'name' => 'PayPal'],
            ['email' => 'no-reply@spotify.com',      'name' => 'Spotify'],
            ['email' => 'noreply@github.com',        'name' => 'GitHub'],
            ['email' => 'no-reply@google.com',       'name' => 'Google'],
            ['email' => 'feedback@etsy.com',         'name' => 'Etsy'],
            ['email' => 'noreply@notion.so',         'name' => 'Notion'],
            ['email' => 'info@twitter.com',          'name' => 'Twitter'],
            ['email' => 'jobs@linkedin.com',         'name' => 'LinkedIn'],
            ['email' => 'mail@instagram.com',        'name' => 'Instagram'],
            ['email' => 'updates@figma.com',         'name' => 'Figma'],
            ['email' => 'receipts@uber.com',         'name' => 'Uber'],
            ['email' => 'no-reply@discord.com',      'name' => 'Discord'],
            ['email' => 'no-reply@zoom.us',          'name' => 'Zoom'],
            ['email' => 'receipts@stripe.com',       'name' => 'Stripe'],
            ['email' => 'digest@medium.com',         'name' => 'Medium'],
            ['email' => 'no-reply@dropbox.com',      'name' => 'Dropbox'],
            ['email' => 'updates@hulu.com',          'name' => 'Hulu'],
        ];

        $statuses = ['received', 'forwarded', 'blocked'];

        $subjects = [
            'Your order confirmation #ORD-38291',
            'New login to your account',
            'Is this your account?',
            'You sent a payment of $49.99',
            'Your playlist is ready',
            'New pull request #892 — please review',
            'Security alert for your account',
            'How was your shopping experience?',
            'Shared workspace has been updated',
            '@someone liked your tweet',
            'New job recommendations for you',
            'Your login code is 482916',
            'New comment on your design',
            'Your trip receipt',
            'New message in #general',
            'Your meeting recording is ready',
            'Payment receipt for $29.00',
            'Your weekly reading digest',
            'File shared with you',
            'New episodes available',
        ];

        $now = now();
        $created = 0;

        for ($i = 0; $i < $count; $i++) {
            $sender = $senders[array_rand($senders)];
            $status = $statuses[array_rand($statuses)];

            AliasLog::create([
                'alias_id' => $aliasId,
                'sender_email' => $sender['name'] . ' <' . $sender['email'] . '>',
                'subject' => $subjects[array_rand($subjects)],
                'status' => $status,
                'created_at' => (clone $now)->subMinutes(rand(1, $count * 60)),
            ]);

            $created++;
        }

        $this->info("Created {$created} dummy forwarding log entries for alias ID {$aliasId}.");
        return 0;
    }
}
