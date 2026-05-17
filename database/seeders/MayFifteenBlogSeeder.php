<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MayFifteenBlogSeeder extends Seeder
{
    
    // php artisan db:seed --class=MayFifteenBlogSeeder    
    
    public function run(): void
    {
        $service = app(BlogService::class);

        // ── Fetch category ids ────────────────────────────────────
        $cats = BlogCategory::pluck('id', 'slug');

        // ── Fetch tag ids ─────────────────────────────────────────
        $tags = BlogTag::pluck('id', 'slug');

        // ── Post definitions ──────────────────────────────────────
        $posts = $this->posts($cats, $tags);

        foreach ($posts as $data) {
            $tagIds = $data['tag_slugs'] ?? [];
            unset($data['tag_slugs']);

            // Auto-calculate read time from body
            $data['read_time_minutes'] = BlogPost::estimateReadTime($data['body']);

            $post = BlogPost::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );

            // Sync tags
            if ($tagIds) {
                $ids = collect($tagIds)
                    ->map(fn ($slug) => $tags[$slug] ?? null)
                    ->filter()
                    ->values()
                    ->all();

                $post->tags()->sync($ids);
            }
        }

        $service->clearCaches();
    }


    private function posts(\Illuminate\Support\Collection $cats, \Illuminate\Support\Collection $tags): array
    {
        return [
            [
                'blog_category_id'    => $cats['security'],
                'title'               => 'Best Ways to Avoid Spam Emails in 2026',
                'slug'                => 'best-ways-avoid-spam-emails-2026',
                'excerpt'             => 'Learn the best ways to stop spam emails, protect your inbox, and improve online privacy in 2026 using temporary email tools and smart habits.',
                'featured_image'      => 'avoid-spam-emails-2026.png',
                'featured_image_alt'  => 'Clean inbox protected from spam emails and phishing messages',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Best Ways to Avoid Spam Emails in 2026',
                'meta_description'    => 'Discover effective ways to stop spam emails and protect your inbox using temporary email and privacy tools.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['spam-protection', 'privacy', 'temporary-email', 'security'],
                'body'                => $this->bodyAvoidSpamEmails2026(),
            ],
        ];
    }

    
private function bodyAvoidSpamEmails2026(): string
{
    return <<<'HTML'
<p>Email spam continues to be one of the biggest online frustrations for internet users in 2026. From endless promotional newsletters to suspicious phishing messages, unwanted emails can quickly overwhelm even the most organized inbox.</p>

<p>Every online signup, giveaway form, coupon registration, or free trial increases the chances of your email address being added to marketing databases. Over time, this often leads to inbox clutter, privacy concerns, and security risks.</p>

<p>Fortunately, there are practical ways to reduce spam and better protect your personal inbox.</p>

<p>Many users now rely on temporary email services like <a href="https://inboxoro.com">InboxOro</a> to keep their primary email address private during short-term online activities.</p>

<h2>Why Spam Emails Are Increasing</h2>

<p>Modern websites and online platforms collect massive amounts of user data. Email addresses are commonly used for:</p>

<ul>
<li>Marketing campaigns</li>
<li>Newsletter subscriptions</li>
<li>Promotional offers</li>
<li>User verification</li>
<li>Advertising systems</li>
</ul>

<p>Once your email address appears in multiple databases, it may begin receiving a large volume of unwanted messages.</p>

<p>Some users also experience spam after participating in:</p>

<ul>
<li>Free trial registrations</li>
<li>Coupon websites</li>
<li>Online surveys</li>
<li>Digital downloads</li>
<li>Temporary account signups</li>
</ul>

<p>This is why email privacy has become increasingly important.</p>

<h2>Use Temporary Email for Non-Essential Signups</h2>

<p>One of the most effective ways to reduce spam is avoiding the use of your primary email address for every website registration.</p>

<p>A temporary email address allows users to create disposable inboxes instantly for short-term use.</p>

<p>Helpful resources include:</p>

<ul>
<li><a href="https://inboxoro.com/free-temp-mail-no-signup">free temp mail no signup</a></li>
<li><a href="https://inboxoro.com/free-temp-mail-no-login">free temp mail no login</a></li>
<li><a href="https://inboxoro.com/how-to-create-temp-email">how to create temp email</a></li>
<li><a href="https://inboxoro.com/best-temporary-email-service">best temporary email service</a></li>
</ul>

<p>Temporary inboxes are commonly used for:</p>

<ul>
<li>One-time registrations</li>
<li>Verification codes</li>
<li>Download access</li>
<li>Free trial signups</li>
<li>Short-term testing</li>
</ul>

<h2>Protect Your Personal Email Privacy</h2>

<p>Your personal email address is connected to many parts of your digital identity. Sharing it unnecessarily can increase privacy exposure.</p>

<p>Privacy-focused tools help users reduce unnecessary tracking and unwanted communication.</p>

<p>Useful pages include:</p>

<ul>
<li><a href="https://inboxoro.com/protect-email-privacy">protect email privacy</a></li>
<li><a href="https://inboxoro.com/privacy-email">privacy email</a></li>
<li><a href="https://inboxoro.com/how-to-hide-email-address-online">hide email address online</a></li>
<li><a href="https://inboxoro.com/email-privacy-for-online-accounts">email privacy for online accounts</a></li>
</ul>

<h2>Avoid Using One Email Everywhere</h2>

<p>Many users rely on a single email address for social media, shopping, work, gaming, and banking. This creates unnecessary risk.</p>

<p>A better strategy is separating your email usage:</p>

<ul>
<li>Main email for important accounts</li>
<li>Secondary email for subscriptions</li>
<li>Temporary email for short-term activities</li>
</ul>

<p>This approach helps keep your primary inbox cleaner and more secure.</p>

<h2>Use Temporary Email for Verification Codes</h2>

<p>Many websites require email verification before allowing account access.</p>

<p>Temporary email services are commonly used for receiving short-term verification messages without exposing personal inboxes.</p>

<p>Helpful pages:</p>

<ul>
<li><a href="https://inboxoro.com/how-to-get-free-email-for-otp">free email for OTP</a></li>
<li><a href="https://inboxoro.com/receive-otp-online">receive OTP online</a></li>
<li><a href="https://inboxoro.com/how-to-receive-verification-email-online">receive verification email online</a></li>
<li><a href="https://inboxoro.com/best-email-for-verification-codes">best email for verification codes</a></li>
</ul>

<h2>Reduce Spam from Online Shopping</h2>

<p>Ecommerce websites frequently send promotional campaigns, discount alerts, and product recommendations.</p>

<p>Users who only plan to make one purchase may prefer using temporary email during registration.</p>

<p>Useful resources:</p>

<ul>
<li><a href="https://inboxoro.com/temp-email-for-online-shopping">temp email for online shopping</a></li>
<li><a href="https://inboxoro.com/temp-email-for-ecommerce">temp email for ecommerce</a></li>
<li><a href="https://inboxoro.com/temp-email-for-coupons">temp email for coupons</a></li>
</ul>

<h2>Be Careful with Free Downloads and Giveaways</h2>

<p>Many websites collect email addresses through giveaways and downloadable content offers.</p>

<p>While some offers are legitimate, they often result in ongoing promotional emails.</p>

<p>Temporary inboxes are commonly used for:</p>

<ul>
<li><a href="https://inboxoro.com/temp-email-for-downloads">downloads</a></li>
<li><a href="https://inboxoro.com/temp-email-for-giveaways">giveaways</a></li>
<li><a href="https://inboxoro.com/temp-email-for-surveys">surveys</a></li>
</ul>

<h2>Use Temporary Email for Social Platforms</h2>

<p>Some users prefer using temporary email for short-term access to online communities and social platforms.</p>

<p>Examples include:</p>

<ul>
<li><a href="https://inboxoro.com/temp-mail-for-discord">temp mail for Discord</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-linkedin">temp mail for LinkedIn</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-quora">temp mail for Quora</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-telegram">temp mail for Telegram</a></li>
</ul>

<p>These pages are intended for users who want to use temporary email during account signup or testing workflows.</p>

<h2>Understand the Difference Between Email Types</h2>

<p>Not all email services are designed for the same purpose.</p>

<p>Comparison pages can help users better understand the differences between permanent email providers and temporary inbox tools.</p>

<p>Helpful comparisons include:</p>

<ul>
<li><a href="https://inboxoro.com/disposable-email-vs-temporary-email">disposable email vs temporary email</a></li>
<li><a href="https://inboxoro.com/temp-mail-vs-gmail">temp mail vs gmail</a></li>
<li><a href="https://inboxoro.com/temp-mail-vs-permanent-email">temp mail vs permanent email</a></li>
<li><a href="https://inboxoro.com/fake-email-vs-real-email">fake email vs real email</a></li>
</ul>

<h2>Temporary Email for Developers and Testing</h2>

<p>Temporary inboxes are also commonly used in software testing and development environments.</p>

<p>Developers may use disposable inboxes for:</p>

<ul>
<li>Registration flow testing</li>
<li>OTP validation</li>
<li>QA testing</li>
<li>Email automation workflows</li>
</ul>

<p>Helpful pages include:</p>

<ul>
<li><a href="https://inboxoro.com/temp-email-for-developers">temp email for developers</a></li>
<li><a href="https://inboxoro.com/temp-email-for-testers">temp email for testers</a></li>
<li><a href="https://inboxoro.com/mock-email-service">mock email service</a></li>
<li><a href="https://inboxoro.com/best-temporary-email-for-developers">best temporary email for developers</a></li>
</ul>

<h2>Use Smart Inbox Habits</h2>

<p>Reducing spam also requires better email management habits.</p>

<p>Recommended practices include:</p>

<ul>
<li>Do not share your main email unnecessarily</li>
<li>Unsubscribe from unwanted newsletters</li>
<li>Avoid suspicious websites</li>
<li>Use separate inboxes for different activities</li>
<li>Never click unknown email attachments</li>
</ul>

<h2>Temporary Email and Privacy Protection</h2>

<p>Privacy-focused temporary email services help users reduce tracking and inbox exposure.</p>

<p>Helpful pages:</p>

<ul>
<li><a href="https://inboxoro.com/protect-identity-with-temp-email">protect identity with temp email</a></li>
<li><a href="https://inboxoro.com/secure-email-with-temp-mail">secure email with temp mail</a></li>
<li><a href="https://inboxoro.com/spam-free-email">spam free email</a></li>
<li><a href="https://inboxoro.com/stop-spam-emails-fast">stop spam emails fast</a></li>
</ul>

<h2>Why Many Users Prefer InboxOro</h2>

<p>InboxOro helps users create temporary email inboxes instantly without lengthy registration processes.</p>

<p>It is commonly used for:</p>

<ul>
<li>Verification emails</li>
<li>Short-term registrations</li>
<li>Free trials</li>
<li>Testing workflows</li>
<li>Online privacy protection</li>
</ul>

<p>Users who want to reduce inbox clutter often prefer temporary inbox tools for non-essential activities.</p>

<h2>Conclusion</h2>

<p>Spam emails continue to increase in 2026, but users now have more tools and better strategies to protect themselves online.</p>

<p>Using temporary email for short-term activities, protecting your personal inbox, and improving privacy habits can significantly reduce unwanted email traffic.</p>

<p>With services like <strong>InboxOro</strong>, users can create temporary inboxes instantly and maintain a cleaner, safer, and more organized digital experience.</p>
HTML;
}


}