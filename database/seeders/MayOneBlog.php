<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MayOneBlog extends Seeder
{
    
    // php artisan db:seed --class=MayOneBlog    
    
    public function run(): void
    {
        $service = app(BlogService::class);

        // ── Fetch category ids ────────────────────────────────────

        // BlogCategory::create([
        //     'name'       => 'Marketing',
        //     'slug'       => 'marketing',
        //     'color'      => '#33b208',
        //     'sort_order' => 7,
        // ]);

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
                'blog_category_id'    => $cats['guides'],
                'title'               => 'Secure Disposable Email for Online Privacy',
                'slug'                => 'secure-disposable-email',
                'excerpt'             => 'Learn how secure disposable email services help users protect privacy, reduce spam, and manage temporary online registrations.',
                'featured_image'      => 'secure-disposable-email.png',
                'featured_image_alt'  => 'Secure disposable email dashboard on modern workspace devices',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Secure Disposable Email for Online Privacy',
                'meta_description'    => 'Use secure disposable email services for privacy, verification, spam prevention, and temporary registrations.',
                'status'              => 'published',
                'is_featured'         => false,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => [
                    'secure-email',
                    'disposable-email',
                    'privacy',
                    'temporary-email'
                ],
                'body'                => $this->bodySecureDisposableEmail(),
            ],
        ];
    }
 
    
private function bodySecureDisposableEmail(): string
{
    return <<<'HTML'
<p>Online privacy and inbox security have become major concerns for internet users in 2026.</p>

<p>Every day, users register on websites, apps, online tools, shopping platforms, and digital services that require email verification.</p>

<p>Using a permanent personal inbox for every registration can often result in:</p>

<ul>
<li>Spam emails</li>
<li>Marketing overload</li>
<li>Privacy risks</li>
<li>Inbox clutter</li>
<li>Tracking-related concerns</li>
</ul>

<p>That is why many users now prefer secure disposable email services for temporary online activity and verification workflows.</p>

<p>Platforms like <strong>InboxOro</strong> help users instantly generate temporary inboxes for secure browsing, spam prevention, verification emails, and privacy-focused registrations.</p>

<h2>What Is a Secure Disposable Email?</h2>

<p>A secure disposable email is a temporary inbox commonly used for short-term online activities where users prefer not to expose their permanent email address.</p>

<p>These inboxes are commonly used for:</p>

<ul>
<li>Online registrations</li>
<li>Verification workflows</li>
<li>Free trial signups</li>
<li>Temporary accounts</li>
<li>Testing applications</li>
<li>Spam prevention</li>
</ul>

<p>Helpful resources:</p>

<ul>
<li><a href="/secure-temp-mail-service">secure temp mail service</a></li>
<li><a href="/secure-email-for-signup">secure email for signup</a></li>
<li><a href="/secure-email-for-online-use">secure email for online use</a></li>
<li><a href="/secure-anonymous-email">secure anonymous email</a></li>
</ul>

<h2>Why Users Choose Secure Disposable Email Services</h2>

<p>Many websites request email addresses before users can access content, tools, downloads, or online communities.</p>

<p>Users commonly choose disposable inboxes for users who want to:</p>

<ul>
<li>Protect personal inboxes</li>
<li>Reduce spam</li>
<li>Browse more privately</li>
<li>Manage temporary registrations</li>
<li>Separate online activities</li>
</ul>

<p>Temporary inboxes help users avoid long-term promotional email clutter.</p>

<h2>Spam Prevention and Inbox Protection</h2>

<p>One of the most common uses of disposable email services is spam prevention.</p>

<p>Many websites send:</p>

<ul>
<li>Promotional emails</li>
<li>Marketing newsletters</li>
<li>Sales campaigns</li>
<li>Automated notifications</li>
<li>Advertising emails</li>
</ul>

<p>Using temporary inboxes helps users separate temporary registrations from important personal communication.</p>

<p>Helpful pages:</p>

<ul>
<li><a href="/secure-email-for-privacy">secure email for privacy</a></li>
<li><a href="/temp-mail-without-limits">temp mail without limits</a></li>
<li><a href="/temp-mail-without-restrictions">temp mail without restrictions</a></li>
<li><a href="/temp-mail-without-delay">temp mail without delay</a></li>
</ul>

<h2>Secure Disposable Email for Verification</h2>

<p>Disposable inboxes are commonly used for receiving:</p>

<ul>
<li>Verification emails</li>
<li>Activation links</li>
<li>OTP codes</li>
<li>Password reset emails</li>
<li>Temporary access links</li>
</ul>

<p>Users often prefer temporary inboxes during short-term registrations and testing workflows.</p>

<p>Helpful resources:</p>

<ul>
<li><a href="/secure-email-for-verification">secure email for verification</a></li>
<li><a href="/fast-email-for-verification">fast email for verification</a></li>
<li><a href="/instant-email-for-otp">instant email for otp</a></li>
<li><a href="/anonymous-email-for-otp">anonymous email for otp</a></li>
</ul>

<h2>Temporary Email for Free Trials</h2>

<p>Many users create disposable inboxes for testing online tools and free trial platforms.</p>

<p>This is commonly used for:</p>

<ul>
<li>SaaS tools</li>
<li>Online platforms</li>
<li>Educational websites</li>
<li>Productivity apps</li>
<li>Digital services</li>
</ul>

<p>Helpful pages:</p>

<ul>
<li><a href="/anonymous-email-for-free-trials">anonymous email for free trials</a></li>
<li><a href="/quick-email-for-signup">quick email for signup</a></li>
<li><a href="/instant-email-for-registration">instant email for registration</a></li>
<li><a href="/temp-mail-without-signup-required">temp mail without signup required</a></li>
</ul>

<h2>Developer and QA Testing Workflows</h2>

<p>Developers and QA teams frequently use disposable inboxes while testing application signup systems and email workflows.</p>

<p>Common testing workflows include:</p>

<ul>
<li>Email verification testing</li>
<li>OTP testing</li>
<li>Password recovery testing</li>
<li>Automation testing</li>
<li>Application onboarding testing</li>
</ul>

<p>Temporary inboxes help developers quickly create multiple testing accounts.</p>

<p>Helpful resources:</p>

<ul>
<li><a href="/secure-email-for-testing">secure email for testing</a></li>
<li><a href="/fast-email-for-testing">fast email for testing</a></li>
<li><a href="/instant-temp-mail-generator">instant temp mail generator</a></li>
<li><a href="/quick-temporary-email">quick temporary email</a></li>
</ul>

<h2>Benefits of Secure Disposable Inbox Systems</h2>

<h3>Fast Inbox Generation</h3>

<p>Users can instantly generate inboxes without lengthy registration processes.</p>

<h3>Privacy Protection</h3>

<p>Temporary inboxes help reduce exposure of permanent personal email addresses.</p>

<h3>Reduced Spam</h3>

<p>Promotional emails remain separate from personal communication.</p>

<h3>Quick Verification Access</h3>

<p>Users can rapidly receive verification emails and OTP codes.</p>

<h3>Improved Online Organization</h3>

<p>Separate inboxes help organize registrations, testing workflows, and temporary accounts.</p>

<h2>Why Many Users Choose InboxOro</h2>

<p>InboxOro helps users generate secure disposable inboxes for online privacy, spam prevention, verification workflows, and temporary registrations.</p>

<p>The platform is commonly used for users who want:</p>

<ul>
<li>Instant inbox generation</li>
<li>Fast verification workflows</li>
<li>Privacy-focused browsing</li>
<li>Temporary email access</li>
<li>Developer testing support</li>
<li>Spam-free registrations</li>
</ul>

<p>InboxOro provides a clean and user-friendly temporary inbox experience for modern internet users.</p>

<p>Helpful pages:</p>

<ul>
<li><a href="/fast-temp-mail-service">fast temp mail service</a></li>
<li><a href="/temp-mail-without-phone">temp mail without phone</a></li>
<li><a href="/temp-mail-without-password">temp mail without password</a></li>
<li><a href="/temp-mail-without-verification-required">temp mail without verification required</a></li>
<li><a href="/temp-mail-without-expiry-limit">temp mail without expiry limit</a></li>
</ul>

<h2>Frequently Asked Questions</h2>

<h3>Why do people use secure disposable email services?</h3>

<p>Users commonly use disposable inboxes for privacy protection, spam prevention, temporary registrations, and verification workflows.</p>

<h3>Can disposable inboxes receive OTP and verification emails?</h3>

<p>Yes. Many temporary inbox systems support OTP messages, activation links, and email verification workflows.</p>

<h3>Are disposable inboxes useful for developers?</h3>

<p>Developers commonly use temporary inboxes for application testing, onboarding systems, and email delivery testing.</p>

<h3>Do secure disposable inboxes help reduce spam?</h3>

<p>Yes. Temporary inboxes help separate promotional and temporary emails from personal inboxes.</p>

<h2>Conclusion</h2>

<p>Secure disposable email services continue becoming more important as privacy concerns and online registrations increase in 2026.</p>

<p>From spam prevention and secure browsing to developer testing and temporary account management, disposable inbox systems provide practical privacy-focused solutions for modern internet usage.</p>

<p>Platforms like <strong>InboxOro</strong> help users instantly create temporary inboxes for secure verification workflows, spam-free browsing, and online privacy protection.</p>
HTML;
}
}