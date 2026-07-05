<?php

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\Email;
use Illuminate\Console\Command;

class FakeEmailBody extends Command
{
    protected $signature = 'email:fake-body {--id= : Address ID to create fake emails for} {--count=5 : Number of fake emails to create}';
    protected $description = 'Generate fake email records for a given address';

    public function handle(): int
    {
        $addressId = $this->option('id');
        $count = (int) $this->option('count');

        if (!$addressId) {
            $this->error('The --id option is required (address ID).');
            return 1;
        }

        $address = Address::find($addressId);
        if (!$address) {
            $this->error("Address with ID {$addressId} not found.");
            return 1;
        }

        $this->line("Creating <fg=cyan>{$count}</> fake email(s) for address <fg=yellow>{$address->email}</>");

        $templates = $this->templates();
        $senders = $this->senders();
        $created = 0;

        for ($i = 0; $i < $count; $i++) {
            $tpl = $templates[array_rand($templates)];
            $sender = $senders[array_rand($senders)];

            $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            $year = date('Y');
            $receivedAt = now()->subMinutes(random_int(1, 1440));

            $vars = [
                '{from_name}' => $sender['name'],
                '{from_email}' => $sender['email'],
                '{to_email}' => $address->email,
                '{subject}' => $tpl['subject'],
                '{otp}' => $otp,
                '{year}' => $year,
                '{message}' => $tpl['message'],
            ];

            $htmlBody = strtr($tpl['html'], $vars);
            $textBody = strtr($tpl['text'], $vars);

            Email::create([
                'address_id' => $address->id,
                'source' => 'inbox',
                'from_name' => $sender['name'],
                'from_email' => $sender['email'],
                'to_email' => $address->email,
                'subject' => strtr($tpl['subject'], $vars),
                'html_body' => $htmlBody,
                'text_body' => $textBody,
                'size' => strlen($htmlBody) + strlen($textBody),
                'is_read' => false,
                'is_spam' => false,
                'received_at' => $receivedAt,
            ]);

            $this->line("  <fg=green>✓</> Created — {$tpl['label']} from {$sender['name']}");
            $created++;
        }

        $this->info("Done — created {$created} fake email(s).");

        return 0;
    }

    private function senders(): array
    {
        return [
            ['name' => 'Google',    'email' => 'noreply@accounts.google.com'],
            ['name' => 'GitHub',    'email' => 'noreply@github.com'],
            ['name' => 'PayPal',    'email' => 'service@paypal.com'],
            ['name' => 'Amazon',    'email' => 'ship-confirm@amazon.com'],
            ['name' => 'Netflix',   'email' => 'info@netflix.com'],
            ['name' => 'Spotify',   'email' => 'no-reply@spotify.com'],
            ['name' => 'Twitter',   'email' => 'notify@twitter.com'],
            ['name' => 'LinkedIn',  'email' => 'messages@linkedin.com'],
            ['name' => 'Dropbox',   'email' => 'team@dropbox.com'],
            ['name' => 'Slack',     'email' => 'noreply@slack.com'],
            ['name' => 'Stripe',    'email' => 'receipts@stripe.com'],
            ['name' => 'Cloudflare','email' => 'noreply@cloudflare.com'],
        ];
    }

    private function templates(): array
    {
        return [
            [
                'label' => 'Verification Code',
                'subject' => 'Your verification code is {otp}',
                'message' => 'This code expires in 10 minutes. Do not share it with anyone.',
                'html' => <<<'HTML'
<!DOCTYPE html>
<html><body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0"><tr><td align="center" style="padding:40px 16px;">
<table role="presentation" width="560" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,.08);">
<tr><td style="padding:32px 32px 0;text-align:center;">
<h1 style="font-size:22px;color:#111;margin:0 0 6px;">Verify your account</h1>
<p style="font-size:14px;color:#666;margin:0 0 24px;line-height:1.5;">Hi there,<br>Use the code below to complete your verification.</p>
</td></tr>
<tr><td style="padding:0 32px;text-align:center;">
<div style="display:inline-block;font-family:monospace;font-size:36px;font-weight:800;letter-spacing:8px;background:#fef3c7;color:#111;padding:16px 32px;border-radius:10px;border:2px solid #111;box-shadow:4px 4px 0 #111;">{otp}</div>
<p style="font-size:13px;color:#888;margin:20px 0 0;line-height:1.5;">{message}</p>
</td></tr>
<tr><td style="padding:32px;text-align:center;">
<a href="#" style="display:inline-block;background:#111;color:#facc15;text-decoration:none;padding:12px 28px;border-radius:8px;font-weight:700;font-size:14px;">Verify Now</a>
</td></tr>
<tr><td style="padding:0 32px 32px;text-align:center;font-size:12px;color:#aaa;border-top:1px solid #eee;padding-top:24px;">
<p style="margin:0 0 4px;">{from_name} &lt;{from_email}&gt;</p>
<p style="margin:0;">&copy; {year} — This is an automated message.</p>
</td></tr>
</table>
</td></tr></table>
</body></html>
HTML,
                'text' => "VERIFY YOUR ACCOUNT\n\nHi there,\n\nUse this code to complete your verification:\n\n  {otp}\n\n{message}\n\n— {from_name} ({from_email})\n© {year}",
            ],
            [
                'label' => 'Welcome Email',
                'subject' => 'Welcome to {from_name}!',
                'message' => 'We\'re excited to have you onboard! Get started by exploring our features.',
                'html' => <<<'HTML'
<!DOCTYPE html>
<html><body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0"><tr><td align="center" style="padding:40px 16px;">
<table role="presentation" width="560" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,.08);">
<tr><td style="padding:32px 32px 0;text-align:center;">
<div style="width:56px;height:56px;background:#10b981;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;color:#fff;font-size:28px;font-weight:700;">✓</div>
<h1 style="font-size:22px;color:#111;margin:0 0 6px;">Welcome aboard!</h1>
<p style="font-size:14px;color:#666;margin:0 0 20px;line-height:1.6;">Thanks for joining <strong>{from_name}</strong>. Your account at <strong>{to_email}</strong> is all set.</p>
</td></tr>
<tr><td style="padding:0 32px;font-size:14px;color:#444;line-height:1.7;">
<p style="margin:0 0 12px;">{message}</p>
<ul style="padding-left:20px;margin:0 0 20px;">
<li>Create and manage your profile</li>
<li>Connect with other users</li>
<li>Stay in control of your privacy</li>
</ul>
</td></tr>
<tr><td style="padding:0 32px 32px;text-align:center;">
<a href="#" style="display:inline-block;background:#111;color:#facc15;text-decoration:none;padding:12px 28px;border-radius:8px;font-weight:700;font-size:14px;">Get Started</a>
</td></tr>
<tr><td style="padding:0 32px 32px;text-align:center;font-size:12px;color:#aaa;border-top:1px solid #eee;padding-top:24px;">
<p style="margin:0 0 4px;">{from_name}</p>
<p style="margin:0;">&copy; {year}</p>
</td></tr>
</table>
</td></tr></table>
</body></html>
HTML,
                'text' => "WELCOME ABOARD!\n\nThanks for joining {from_name}. Your account at {to_email} is all set.\n\n{message}\n\n- Create and manage your profile\n- Connect with other users\n- Stay in control of your privacy\n\n— {from_name}",
            ],
            [
                'label' => 'Password Reset',
                'subject' => 'Password reset request for your account',
                'message' => 'If you did not request a password reset, please ignore this email.',
                'html' => <<<'HTML'
<!DOCTYPE html>
<html><body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0"><tr><td align="center" style="padding:40px 16px;">
<table role="presentation" width="560" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,.08);">
<tr><td style="padding:32px 32px 0;text-align:center;">
<h1 style="font-size:22px;color:#111;margin:0 0 6px;">Reset your password</h1>
<p style="font-size:14px;color:#666;margin:0 0 24px;line-height:1.5;">We received a request to reset the password for your <strong>{from_name}</strong> account.</p>
</td></tr>
<tr><td style="padding:0 32px;text-align:center;">
<a href="#" style="display:inline-block;background:#111;color:#facc15;text-decoration:none;padding:14px 32px;border-radius:8px;font-weight:700;font-size:14px;">Reset Password</a>
<p style="font-size:13px;color:#888;margin:20px 0 0;line-height:1.5;">Or copy this link into your browser:<br><span style="font-family:monospace;font-size:12px;color:#666;">https://example.com/reset?token=abc{otp}xyz</span></p>
</td></tr>
<tr><td style="padding:24px 32px 8px;font-size:13px;color:#888;line-height:1.6;">
<p style="margin:0;">{message}</p>
</td></tr>
<tr><td style="padding:0 32px 32px;text-align:center;font-size:12px;color:#aaa;border-top:1px solid #eee;padding-top:24px;">
<p style="margin:0 0 4px;">{from_name} &lt;{from_email}&gt;</p>
<p style="margin:0;">&copy; {year}</p>
</td></tr>
</table>
</td></tr></table>
</body></html>
HTML,
                'text' => "RESET YOUR PASSWORD\n\nWe received a request to reset the password for your {from_name} account.\n\nOpen this link to reset:\nhttps://example.com/reset?token=abc{otp}xyz\n\n{message}\n\n— {from_name} ({from_email})\n© {year}",
            ],
            [
                'label' => 'Notification Alert',
                'subject' => 'New activity on your account',
                'message' => 'This is an automated notification from your account. No action is required at this time.',
                'html' => <<<'HTML'
<!DOCTYPE html>
<html><body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0"><tr><td align="center" style="padding:40px 16px;">
<table role="presentation" width="560" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,.08);">
<tr><td style="padding:32px 32px 0;">
<div style="width:44px;height:44px;background:#3b82f6;border-radius:10px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:14px;color:#fff;font-size:20px;">i</div>
<h1 style="font-size:20px;color:#111;margin:0 0 4px;">{subject}</h1>
</td></tr>
<tr><td style="padding:8px 32px 24px;font-size:14px;color:#444;line-height:1.7;">
<p style="margin:0 0 14px;">Hello,</p>
<p style="margin:0 0 14px;">{message}</p>
<div style="background:#f9fafb;border-left:3px solid #3b82f6;padding:12px 16px;border-radius:6px;font-size:13px;color:#666;margin:0 0 14px;">
<strong style="color:#111;">Details:</strong><br>
Account: {to_email}<br>
Time: {year}-{year}<br>
Reference: #REF-{otp}
</div>
</td></tr>
<tr><td style="padding:0 32px 32px;font-size:12px;color:#aaa;border-top:1px solid #eee;padding-top:24px;text-align:center;">
<p style="margin:0 0 4px;">{from_name}</p>
<p style="margin:0;">&copy; {year}</p>
</td></tr>
</table>
</td></tr></table>
</body></html>
HTML,
                'text' => "{subject}\n\nHello,\n\n{message}\n\nDetails:\n  Account: {to_email}\n  Reference: #REF-{otp}\n\n— {from_name}\n© {year}",
            ],
            [
                'label' => 'Receipt / Invoice',
                'subject' => 'Your receipt from {from_name}',
                'message' => 'Thank you for your payment. Your receipt is attached below.',
                'html' => <<<'HTML'
<!DOCTYPE html>
<html><body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0"><tr><td align="center" style="padding:40px 16px;">
<table role="presentation" width="560" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,.08);">
<tr><td style="padding:32px 32px 0;text-align:center;">
<h1 style="font-size:22px;color:#111;margin:0 0 6px;">Payment receipt</h1>
<p style="font-size:14px;color:#666;margin:0 0 24px;line-height:1.5;">Thanks for your purchase from <strong>{from_name}</strong>.</p>
</td></tr>
<tr><td style="padding:0 32px;">
<table width="100%" cellpadding="8" style="font-size:14px;color:#444;">
<tr><td style="border-bottom:1px solid #eee;">Item</td><td style="text-align:right;border-bottom:1px solid #eee;">Amount</td></tr>
<tr><td>Pro Plan — Monthly</td><td style="text-align:right;">$29.00</td></tr>
<tr><td>Tax</td><td style="text-align:right;">$2.90</td></tr>
<tr style="font-weight:700;color:#111;"><td style="border-top:2px solid #111;">Total</td><td style="text-align:right;border-top:2px solid #111;">$31.90</td></tr>
</table>
<p style="font-size:13px;color:#888;margin:20px 0 0;line-height:1.5;">Reference: <span style="font-family:monospace;">INV-{otp}</span></p>
</td></tr>
<tr><td style="padding:32px;text-align:center;">
<a href="#" style="display:inline-block;background:#111;color:#facc15;text-decoration:none;padding:12px 28px;border-radius:8px;font-weight:700;font-size:14px;">View Invoice</a>
</td></tr>
<tr><td style="padding:0 32px 32px;text-align:center;font-size:12px;color:#aaa;border-top:1px solid #eee;padding-top:24px;">
<p style="margin:0 0 4px;">{from_name} &lt;{from_email}&gt;</p>
<p style="margin:0;">&copy; {year}</p>
</td></tr>
</table>
</td></tr></table>
</body></html>
HTML,
                'text' => "PAYMENT RECEIPT\n\nThanks for your purchase from {from_name}.\n\nItem: Pro Plan — Monthly\nAmount: $29.00\nTax: $2.90\nTotal: $31.90\nReference: INV-{otp}\n\n— {from_name} ({from_email})\n© {year}",
            ],
        ];
    }
}
