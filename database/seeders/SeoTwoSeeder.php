<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SeoPage;

class SeoTwoSeeder extends Seeder
{
    // php artisan db:seed --class=SeoTwoSeeder
    public function run()
    {
        $pages = [
            [
                'slug'             => '10-minute-email',
                'title'            => '10 Minute Email – Free Self-Destructing Inbox | inboxOro',
                'meta_description' => 'Get a free 10 minute email address instantly. Receive OTPs, verification links & confirmations — then it self-destructs. No signup. Powered by inboxOro.',
                'h1'               => '10 Minute Email — Instant Inbox That Vanishes on Schedule',
                'intro_text'       => '<p>inboxOro\'s 10-minute email gives you a fully working inbox that automatically destroys itself — along with every message inside — exactly 10 minutes after creation. Perfect for one-time verifications, trial signups, and anything in between.</p>',
                'faq'              => json_encode([
                    ['question' => 'What is a 10 minute email?', 'answer' => 'A 10 minute email is a disposable inbox that auto-deletes after 10 minutes. It receives real emails just like a normal inbox, but leaves no permanent trace.'],
                    ['question' => 'Is inboxOro\'s 10 minute email really free?', 'answer' => 'Yes, 100% free. No account, no credit card, no strings attached — just visit inboxOro and your 10-minute inbox is ready instantly.'],
                    ['question' => 'Can I get a new address after my 10-minute email expires?', 'answer' => 'Absolutely. Click "Generate New" on inboxOro and a fresh 10-minute address is created in under a second.'],
                    ['question' => 'Does the 10 minute email receive images and attachments?', 'answer' => 'Yes. inboxOro renders HTML emails and supports incoming attachments within the active 10-minute session.'],
                    ['question' => 'Can I use a 10 minute email for PayPal or banking?', 'answer' => 'We recommend permanent emails for financial accounts since you need ongoing access. The 10-minute email is best for one-time verifications and trial signups.'],
                    ['question' => 'Why is 10 minutes the default lifespan?', 'answer' => 'Ten minutes is the sweet spot — long enough to complete any email verification flow, short enough to prevent abuse and maximise your privacy.'],
                ]),
                'is_active'        => true,
            ],
            [
                'slug'             => 'temp-mail-for-linkedin',
                'title'            => 'Temp Mail for LinkedIn – Sign Up Privately | inboxOro',
                'meta_description' => 'Create a LinkedIn account without your real email. inboxOro delivers free temp mail for LinkedIn verification in seconds. No signup. Auto-deletes in 10 minutes.',
                'h1'               => 'Temp Mail for LinkedIn — Build Your Profile, Not Your Spam List',
                'intro_text'       => '<p>Whether you\'re creating a secondary LinkedIn profile or simply protecting your personal inbox, inboxOro\'s temporary email receives LinkedIn\'s verification email in real time — no personal data required, ever.</p>',
                'faq'              => json_encode([
                    ['question' => 'Does LinkedIn accept temporary email addresses?', 'answer' => 'LinkedIn sends verification emails to any working inbox. inboxOro addresses are real functioning inboxes that receive LinkedIn emails successfully.'],
                    ['question' => 'Can I use temp mail to create a LinkedIn recruiter or business account?', 'answer' => 'For a primary business presence on LinkedIn, a permanent email is strongly recommended. For testing or secondary accounts, inboxOro works well.'],
                    ['question' => 'What happens to my LinkedIn account when the temp email expires?', 'answer' => 'Your LinkedIn account stays active. However, you won\'t be able to recover it via email — update to a permanent email in LinkedIn settings before the timer runs out if needed.'],
                    ['question' => 'How fast does LinkedIn\'s verification email arrive in inboxOro?', 'answer' => 'LinkedIn\'s confirmation emails typically land in your inboxOro inbox within 5–20 seconds of signup.'],
                    ['question' => 'Can I connect my LinkedIn to a temp email long-term?', 'answer' => 'No — once the temp email expires, you lose email-based access. Switch to a permanent email in your LinkedIn account settings for long-term use.'],
                    ['question' => 'Is using a temp email for LinkedIn against their terms?', 'answer' => 'Always review LinkedIn\'s Terms of Service. inboxOro is a privacy tool — responsible use of any platform remains your own responsibility.'],
                ]),
                'is_active'        => true,
            ],
            [
                'slug'             => 'temp-mail-for-telegram',
                'title'            => 'Temp Mail for Telegram – Verify Accounts Anonymously | inboxOro',
                'meta_description' => 'Use inboxOro temp mail to verify Telegram without your real email. Instant inbox, real-time delivery, no registration. Free. Auto-deletes in 10 minutes.',
                'h1'               => 'Temp Mail for Telegram — Anonymous Verification, Real Privacy',
                'intro_text'       => '<p>Telegram is built for privacy — your email signup should be too. inboxOro generates a temporary inbox that receives Telegram\'s verification email in seconds, keeping your identity completely off the record.</p>',
                'faq'              => json_encode([
                    ['question' => 'Does Telegram require an email address to sign up?', 'answer' => 'Telegram primarily uses phone numbers for account creation, but some flows and bot/channel setups may request an email. inboxOro handles those email steps privately.'],
                    ['question' => 'Can I receive Telegram login codes via temp mail?', 'answer' => 'If Telegram sends an email-based login code, inboxOro\'s real-time inbox will display it within seconds.'],
                    ['question' => 'Is inboxOro temp mail safe to use with Telegram?', 'answer' => 'Yes. inboxOro collects no personal data and auto-deletes all emails after 10 minutes — aligned with Telegram\'s own privacy-first philosophy.'],
                    ['question' => 'Can I use temp mail for Telegram bots or channel creation?', 'answer' => 'For certain Telegram business integrations that request an email, inboxOro provides an instant, throwaway inbox to complete the step.'],
                    ['question' => 'Will my Telegram account be affected when the temp email expires?', 'answer' => 'Telegram accounts are phone-number based, so email expiry does not affect your account functionality.'],
                    ['question' => 'How is inboxOro different from a Telegram anonymous number?', 'answer' => 'They solve different problems — anonymous numbers hide your phone identity, while inboxOro protects your email identity. They complement each other perfectly.'],
                ]),
                'is_active'        => true,
            ],
            [
                'slug'             => 'temp-mail-for-snapchat',
                'title'            => 'Temp Mail for Snapchat – Create Accounts Without Your Real Email | inboxOro',
                'meta_description' => 'Sign up on Snapchat privately with inboxOro temp mail. Instant inbox for Snapchat verification. Free, no registration, auto-deletes in 10 min. Stay anonymous.',
                'h1'               => 'Temp Mail for Snapchat — Snap Privately, Share Nothing',
                'intro_text'       => '<p>Create a new Snapchat account without handing over your real email address. inboxOro\'s temporary inbox receives Snapchat\'s verification email in real time — disposable, anonymous, and auto-deleting in 10 minutes.</p>',
                'faq'              => json_encode([
                    ['question' => 'Does Snapchat send a verification email to temp inboxes?', 'answer' => 'Yes. Snapchat sends confirmation emails to any valid inbox, and inboxOro\'s addresses receive them in real time without issues.'],
                    ['question' => 'Can I use temp mail to make a second Snapchat account?', 'answer' => 'Yes. Generate a fresh inboxOro address for each Snapchat account — each signup needs a unique email address.'],
                    ['question' => 'How do I verify Snapchat using inboxOro?', 'answer' => 'Copy your inboxOro address, enter it in Snapchat\'s signup form, then open your inboxOro inbox and click the verification link in Snapchat\'s email.'],
                    ['question' => 'Will my Snapchat streaks be safe if I used a temp email?', 'answer' => 'Your Snapchat account and streaks remain active after the temp email expires. Just note that email-based account recovery won\'t be available.'],
                    ['question' => 'Can Snapchat detect inboxOro email addresses?', 'answer' => 'inboxOro regularly rotates its email domains to maintain high deliverability across platforms including Snapchat.'],
                    ['question' => 'Is creating a Snapchat account with temp mail against the rules?', 'answer' => 'Always review Snapchat\'s Terms of Service. inboxOro is a privacy protection tool — use all platforms responsibly.'],
                ]),
                'is_active'        => true,
            ],
            [
                'slug'             => 'temp-mail-for-pinterest',
                'title'            => 'Temp Mail for Pinterest – Pin Anonymously | inboxOro',
                'meta_description' => 'Sign up for Pinterest without your real email. inboxOro delivers free temp mail for Pinterest verification instantly. No account needed. Auto-deletes in 10 min.',
                'h1'               => 'Temp Mail for Pinterest — Save Ideas, Not Your Personal Data',
                'intro_text'       => '<p>Start pinning without exposing your personal inbox to Pinterest\'s marketing emails. inboxOro creates a throwaway email address that receives Pinterest\'s verification in seconds — then disappears automatically after 10 minutes.</p>',
                'faq'              => json_encode([
                    ['question' => 'Does Pinterest accept temporary email addresses?', 'answer' => 'Yes. Pinterest sends verification emails to any working inbox. inboxOro addresses successfully receive Pinterest\'s confirmation emails in real time.'],
                    ['question' => 'Why would I use temp mail for Pinterest?', 'answer' => 'Pinterest sends frequent marketing and recommendation emails. Using a temp email keeps your real inbox clean while still giving you full access to the platform.'],
                    ['question' => 'Can I create a Pinterest business account with temp mail?', 'answer' => 'For a primary business account you\'ll manage long-term, use a permanent email. For testing Pinterest\'s business features, inboxOro works perfectly.'],
                    ['question' => 'How quickly does Pinterest\'s verification email arrive?', 'answer' => 'Pinterest verification emails typically appear in your inboxOro inbox within 10–30 seconds of account creation.'],
                    ['question' => 'Will my Pinterest boards disappear when my temp email expires?', 'answer' => 'No. Your Pinterest account and boards remain intact. Only the temporary email inbox is deleted after 10 minutes.'],
                    ['question' => 'Can I switch my Pinterest account to a real email later?', 'answer' => 'Yes. Update your email in Pinterest account settings before the temp address expires to maintain full recovery options.'],
                ]),
                'is_active'        => true,
            ],
            [
                'slug'             => 'temp-mail-for-quora',
                'title'            => 'Temp Mail for Quora – Ask & Answer Without Your Real Email | inboxOro',
                'meta_description' => 'Join Quora without sharing your personal email. inboxOro provides free temp mail for Quora signup in seconds. No registration required. Auto-deletes in 10 min.',
                'h1'               => 'Temp Mail for Quora — Share Your Knowledge, Not Your Inbox',
                'intro_text'       => '<p>Quora is a great platform for knowledge — but not for your inbox. Use inboxOro\'s temporary email to sign up for Quora privately, receive the verification link in real time, and keep your personal address completely off their mailing list.</p>',
                'faq'              => json_encode([
                    ['question' => 'Does Quora work with temporary email addresses?', 'answer' => 'Yes. Quora sends verification emails to any working inbox, and inboxOro\'s addresses successfully receive them in real time.'],
                    ['question' => 'Why avoid using my real email for Quora?', 'answer' => 'Quora sends daily digest and notification emails that quickly fill your inbox. A temp email lets you verify and choose your notification preferences without the initial spam flood.'],
                    ['question' => 'Can I use temp mail for a Quora Space or Quora+ account?', 'answer' => 'For Quora+ subscriptions or Spaces you plan to grow long-term, a permanent email is recommended for billing and recovery purposes.'],
                    ['question' => 'How fast does Quora\'s confirmation email arrive in inboxOro?', 'answer' => 'Quora\'s verification emails land in your inboxOro inbox within seconds of signup — fast enough to complete verification comfortably.'],
                    ['question' => 'Will I lose my Quora answers when the temp email expires?', 'answer' => 'No. Your Quora content remains live. You simply lose the ability to recover your account via that email address after it expires.'],
                    ['question' => 'Is using temp mail for Quora against their policies?', 'answer' => 'Always consult Quora\'s Terms of Service. inboxOro is a privacy tool designed for legitimate privacy protection.'],
                ]),
                'is_active'        => true,
            ],
            [
                'slug'             => 'temp-mail-for-paypal',
                'title'            => 'Temp Mail for PayPal – Verify Without Your Real Email | inboxOro',
                'meta_description' => 'Use inboxOro temp mail to receive PayPal verification emails privately. Instant inbox, real-time delivery, no signup. Note: update to a permanent email for long-term PayPal use.',
                'h1'               => 'Temp Mail for PayPal — Verify Privately, Upgrade When Ready',
                'intro_text'       => '<p>Need to get past PayPal\'s email verification step without committing your personal inbox right away? inboxOro delivers PayPal\'s confirmation email in real time — just remember to update to a permanent email in your PayPal settings before the 10 minutes are up.</p>',
                'faq'              => json_encode([
                    ['question' => 'Can I use a temp email to create a PayPal account?', 'answer' => 'You can use inboxOro to receive PayPal\'s initial verification email. However, since PayPal is a financial service, we strongly recommend updating to a permanent email immediately after verification.'],
                    ['question' => 'Will PayPal block my account if it detects a temp email?', 'answer' => 'PayPal may flag accounts without a verified permanent email for security reasons. Always switch to a real email address in your PayPal account settings after initial verification.'],
                    ['question' => 'How do I update my PayPal email after using a temp address?', 'answer' => 'Go to PayPal Settings → Account → Email, add your permanent email, and verify it. Do this before your inboxOro temp address expires.'],
                    ['question' => 'Does PayPal\'s verification email arrive quickly in inboxOro?', 'answer' => 'Yes. PayPal\'s confirmation emails typically arrive in your inboxOro inbox within 10–30 seconds.'],
                    ['question' => 'Is it safe to link a bank account to a PayPal made with temp mail?', 'answer' => 'Not until you\'ve updated to a permanent email. Financial account recovery depends on email access — always use a permanent email for any financial service.'],
                    ['question' => 'What is temp mail for PayPal best used for?', 'answer' => 'It\'s most useful for testing PayPal integration in development environments, or for exploring PayPal\'s interface before committing your real email address.'],
                ]),
                'is_active'        => true,
            ],
            [
                'slug'             => 'temp-mail-for-ebay',
                'title'            => 'Temp Mail for eBay – Register Without Your Personal Email | inboxOro',
                'meta_description' => 'Sign up on eBay without your real email using inboxOro temp mail. Instant inbox, real-time verification delivery. Free, no signup. Auto-deletes in 10 minutes.',
                'h1'               => 'Temp Mail for eBay — Browse, Bid & Stay Private',
                'intro_text'       => '<p>Explore eBay without flooding your real inbox with deal alerts and marketing emails. inboxOro delivers eBay\'s verification email in real time — instant, free, and completely anonymous.</p>',
                'faq'              => json_encode([
                    ['question' => 'Does eBay send verification emails to temporary addresses?', 'answer' => 'Yes. eBay\'s verification emails land in inboxOro\'s real-time inbox within seconds of account creation.'],
                    ['question' => 'Can I buy and sell on eBay with a temp email account?', 'answer' => 'For active buying and selling — especially for order confirmations, shipping updates, and dispute resolution — a permanent email is essential. Use inboxOro for initial exploration only.'],
                    ['question' => 'What happens if my eBay email expires before I complete a purchase?', 'answer' => 'You\'ll lose email-based notifications and recovery. Update your eBay account email to a permanent address before the 10-minute temp window closes.'],
                    ['question' => 'How do I switch my eBay account to a permanent email later?', 'answer' => 'Go to eBay Account Settings → Personal Information → Email, and update it to your real address. Verify the new email to complete the switch.'],
                    ['question' => 'Is inboxOro temp mail good for eBay seller accounts?', 'answer' => 'Not for long-term seller accounts — sellers need reliable email for buyer communications, payment alerts, and shipping updates. Use a permanent email for selling.'],
                    ['question' => 'Can I use temp mail to sign up for eBay newsletters or deal alerts?', 'answer' => 'Yes — perfect use case. Use inboxOro to check if eBay\'s deals are worth your real subscription, then decide whether to sign up permanently.'],
                ]),
                'is_active'        => true,
            ],
            [
                'slug'             => 'temp-mail-for-zoom',
                'title'            => 'Temp Mail for Zoom – Join Meetings Without Your Real Email | inboxOro',
                'meta_description' => 'Create a Zoom account privately with inboxOro temp mail. Instant inbox for Zoom verification. Free, no registration needed. Auto-deletes in 10 minutes.',
                'h1'               => 'Temp Mail for Zoom — Attend Meetings, Not Mailing Lists',
                'intro_text'       => '<p>Signing up for Zoom just to join one meeting? Use inboxOro\'s temporary email to verify your account instantly without adding your personal address to Zoom\'s marketing list. Done in 10 minutes, deleted in 10 minutes.</p>',
                'faq'              => json_encode([
                    ['question' => 'Does Zoom accept temporary email addresses for account creation?', 'answer' => 'Yes. Zoom sends an activation email to any valid inbox, and inboxOro\'s addresses receive it in real time without issues.'],
                    ['question' => 'Can I host Zoom meetings with an account made using temp mail?', 'answer' => 'Yes, the account works normally for hosting and joining meetings. For long-term professional use, update to a permanent email in Zoom settings.'],
                    ['question' => 'How long does Zoom\'s activation email take to arrive?', 'answer' => 'Zoom\'s activation email typically arrives in your inboxOro inbox within 10–20 seconds of account creation.'],
                    ['question' => 'Will my Zoom recordings be safe if I used a temp email?', 'answer' => 'Cloud recordings are tied to your Zoom account, not just your email. Update to a permanent email before the temp address expires to maintain full account access.'],
                    ['question' => 'Can I use inboxOro for Zoom webinar or event registrations?', 'answer' => 'Yes! Many webinars send confirmation emails. Use inboxOro to receive the webinar link without subscribing your real inbox to the organiser\'s mailing list.'],
                    ['question' => 'Is temp mail useful for Zoom free plan signups?', 'answer' => 'Absolutely. The Zoom free plan is popular for one-off meetings — inboxOro lets you create the account without any long-term email commitment.'],
                ]),
                'is_active'        => true,
            ],
            [
                'slug'             => 'temp-mail-for-slack',
                'title'            => 'Temp Mail for Slack – Join Workspaces Without Your Real Email | inboxOro',
                'meta_description' => 'Use inboxOro temp mail to join or test Slack workspaces privately. Instant inbox, real-time delivery. Free, no signup required. Auto-deletes in 10 minutes.',
                'h1'               => 'Temp Mail for Slack — Test Workspaces, Not Your Patience',
                'intro_text'       => '<p>Joining a new Slack workspace or testing a Slack integration? inboxOro provides a temporary inbox that receives Slack\'s magic link or verification email in real time — no personal address required, no spam after.</p>',
                'faq'              => json_encode([
                    ['question' => 'Can I join a Slack workspace with a temporary email?', 'answer' => 'Yes. Slack sends a magic link or verification email to any valid inbox. inboxOro receives these instantly in its real-time inbox.'],
                    ['question' => 'Is inboxOro temp mail useful for Slack app developers?', 'answer' => 'Very. Developers testing Slack bots, workflows, or notification emails use inboxOro to create test accounts without cluttering a permanent inbox.'],
                    ['question' => 'Can I use temp mail to create a Slack workspace?', 'answer' => 'Yes for the initial creation, but for a real team workspace you\'ll need a permanent email for ongoing notifications, billing, and admin recovery.'],
                    ['question' => 'How quickly does Slack\'s magic link arrive in inboxOro?', 'answer' => 'Slack\'s emails are fast — expect to see the magic link in your inboxOro inbox within 5–15 seconds.'],
                    ['question' => 'What happens to my Slack account when the temp email expires?', 'answer' => 'Your Slack account remains active in the workspace, but you\'ll lose email-based sign-in. Update your Slack email to a permanent address in account settings.'],
                    ['question' => 'Can Slack admins see that I used a temp email?', 'answer' => 'Slack workspace admins can see the email address associated with your account, which will show as an inboxOro domain address.'],
                ]),
                'is_active'        => true,
            ],
            [
                'slug'             => 'temp-mail-for-dropbox',
                'title'            => 'Temp Mail for Dropbox – Sign Up for Free Storage Privately | inboxOro',
                'meta_description' => 'Create a Dropbox account without your real email using inboxOro temp mail. Instant inbox, real-time delivery. Free, no registration needed. Auto-deletes in 10 minutes.',
                'h1'               => 'Temp Mail for Dropbox — Free Cloud Storage, Zero Inbox Clutter',
                'intro_text'       => '<p>Want to try Dropbox without committing your personal email to their mailing list? inboxOro delivers Dropbox\'s verification email in real time — explore the free plan anonymously, then decide if you want to upgrade with your real details.</p>',
                'faq'              => json_encode([
                    ['question' => 'Does Dropbox work with temporary email addresses?', 'answer' => 'Yes. Dropbox sends a verification email to any valid inbox, and inboxOro\'s real-time inbox receives it within seconds.'],
                    ['question' => 'Can I upload and share files on Dropbox with a temp email account?', 'answer' => 'Yes, the Dropbox account functions normally. However, update to a permanent email before the temp address expires if you plan to keep your files long-term.'],
                    ['question' => 'What happens to my Dropbox files if my temp email expires?', 'answer' => 'Your Dropbox files are tied to your account, not the email address. Update your Dropbox email in account settings to a permanent address before losing access to the temp inbox.'],
                    ['question' => 'How do I update my Dropbox email to a permanent address?', 'answer' => 'Go to Dropbox Settings → Account → Email, enter your permanent email, and complete verification. Do this within the 10-minute temp window.'],
                    ['question' => 'Is inboxOro temp mail good for testing Dropbox integrations?', 'answer' => 'Yes — developers and QA testers use inboxOro to create throwaway Dropbox accounts for testing file sharing, API integrations, and webhook notifications.'],
                    ['question' => 'Can I use temp mail to get Dropbox\'s referral bonus storage?', 'answer' => 'Dropbox\'s referral system requires a verified, active account. For referral bonuses you plan to keep, always use a permanent email address.'],
                ]),
                'is_active'        => true,
            ],
        ];

        foreach ($pages as $page) {
            SeoPage::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }

        $this->command->info('✅ 11 SEO Pages seeded successfully!');
    }
}

// https://inboxoro.com/10-minute-email
// https://inboxoro.com/temp-mail-for-linkedin
// https://inboxoro.com/temp-mail-for-telegram
// https://inboxoro.com/temp-mail-for-snapchat
// https://inboxoro.com/temp-mail-for-pinterest
// https://inboxoro.com/temp-mail-for-quora
// https://inboxoro.com/temp-mail-for-paypal
// https://inboxoro.com/temp-mail-for-ebay
// https://inboxoro.com/temp-mail-for-zoom
// https://inboxoro.com/temp-mail-for-slack
// https://inboxoro.com/temp-mail-for-dropbox
// https://inboxoro.com/temporary-email
// https://inboxoro.com/disposable-email
// https://inboxoro.com/temp-mail
// https://inboxoro.com/10-minute-mail
// https://inboxoro.com/burner-email
// https://inboxoro.com/fake-email
// https://inboxoro.com/temp-mail-for-discord
// https://inboxoro.com/temp-mail-for-instagram
// https://inboxoro.com/temp-mail-for-facebook
// https://inboxoro.com/temp-mail-for-tiktok
// https://inboxoro.com/temp-mail-for-netflix
// https://inboxoro.com/temp-mail-for-spotify
// https://inboxoro.com/temp-mail-for-reddit
// https://inboxoro.com/temp-mail-for-twitter
// https://inboxoro.com/temp-mail-for-amazon
// https://inboxoro.com/temp-mail-for-verification
// https://inboxoro.com/temp-mail-for-signup
// https://inboxoro.com/temp-mail-for-testing
// https://inboxoro.com/anonymous-email
// https://inboxoro.com/throwaway-email
// https://inboxoro.com/temp-mail-for-youtube
// https://inboxoro.com/temp-mail-for-github
// https://inboxoro.com/no-signup-email
// https://inboxoro.com/spam-free-email
// https://inboxoro.com/privacy-email
// https://inboxoro.com/email-for-otp