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

        $bodies = [
            "Hi there,\n\nYour order #ORD-38291 has been shipped and is on its way! Estimated delivery is 3-5 business days.\n\nTrack your package here:\nhttps://tracking.example.com/ORD-38291\n\nThanks for shopping with us!\n— The Team",

            "We noticed a new login to your account from a device we don't recognize.\n\nIf this was you, no action needed. If not, please secure your account immediately.\n\nTime: " . date('g:i A') . "\nDevice: Chrome on Windows\nLocation: Unknown",

            "We noticed unusual activity on your account. Please verify your identity to keep your account secure.\n\nVerify here: https://example.com/verify\n\nIf this wasn't you, please reset your password.",

            "You sent a payment of $49.99 to John Doe.\n\nReference: PP-2847-1928-3847\nDate: " . date('M j, Y') . "\n\nThis payment will appear on your statement as EXAMPLE*SERVICE.",

            "Your weekly playlist is ready! We've picked 20 new songs based on your listening history.\n\nCheck it out: https://example.com/playlist/weekly\n\nHappy listening!",

            "A new pull request #892 has been submitted by contributor 'alex-dev'.\n\nTitle: Fix navigation layout on mobile\nBranch: fix/mobile-nav\n\nView: https://github.com/org/repo/pull/892",

            "We detected a sign-in from a new device. If this was you, you can ignore this alert.\n\nDevice: iPhone 15 Pro\nLocation: San Francisco, CA\nTime: " . date('g:i A'),

            "How was your shopping experience with us? We'd love to hear your feedback!\n\nShare your thoughts: https://example.com/review/order-38291\n\nIt only takes 2 minutes.",

            "A shared workspace 'Marketing Campaigns' has been updated by Sarah.\n\nNew changes:\n- Added Q4 budget plan\n- Updated timeline\n- New team members added\n\nOpen workspace: https://example.com/workspace/marketing",

            "@john_doe liked your tweet: \"Just shipped a major update to our platform! Really proud of the team's hard work. 🚀\"",

            "New job recommendations based on your profile:\n\n1. Senior Software Engineer at TechCorp — Remote\n2. Full Stack Developer at StartupXYZ — San Francisco, CA\n3. DevOps Engineer at CloudInc — New York, NY\n\nView all: https://example.com/jobs",

            "Your login code is: 482916\n\nThis code expires in 10 minutes. If you didn't request this, you can ignore this message.",

            "Sarah left a new comment on your design 'Homepage v3':\n\n\"The hero section looks great! Can we try a warmer color gradient? Also, the CTA button could be slightly larger.\"\n\nReply: https://example.com/design/homepage-v3",

            "Your trip from Downtown to Airport is complete.\n\nTotal: $24.50\nDistance: 8.2 miles\nDuration: 22 minutes\nDriver: Michael\n\nReceipt: https://example.com/receipts/uber-8492",

            "New message in #general from @alice:\n\n\"Hey team! Don't forget about the standup in 15 minutes. Also, the deployment to staging went through — please verify your services.\"",
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
                'body' => $bodies[array_rand($bodies)],
                'status' => $status,
                'created_at' => (clone $now)->subMinutes(rand(1, $count * 60)),
            ]);

            $created++;
        }

        $this->info("Created {$created} dummy forwarding log entries for alias ID {$aliasId}.");
        return 0;
    }
}
