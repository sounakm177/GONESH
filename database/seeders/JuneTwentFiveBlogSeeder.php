<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JuneTwentFiveBlogSeeder extends Seeder
{
    

    // php artisan db:seed --class=JuneTwentFiveBlogSeeder    
    
    public function run(): void
    {
        $service = app(BlogService::class);

        // ── Fetch category ids ────────────────────────────────────

        // BlogCategory::create([
        //     'name'       => 'Verification',
        //     'slug'       => 'verification',
        //     'color'      => '#33b208',
        //     'sort_order' => 14,
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
                'blog_category_id'    => $cats['privacy'],
                'title'               => 'How Disposable Email Improves Privacy and Reduces Spam',
                'slug'                => 'how-disposable-email-improves-privacy-and-reduces-spam',
                'excerpt'             => 'Learn how disposable email helps reduce spam exposure, organize registrations, and support privacy-focused email management.',
                'featured_image'      => 'how-disposable-email-improves-privacy-and-reduces-spam.png',
                'featured_image_alt'  => 'Privacy-focused inbox protecting users from spam emails',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'How Disposable Email Improves Privacy and Reduces Spam',
                'meta_description'    => 'Discover how disposable email helps reduce unwanted messages, organize registrations, and protect your primary inbox.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => [
                    'temporary-email',
                    'disposable-email',
                    'email-privacy',
                    'spam-protection',
                    'privacy-focused-email'
                ],
                'body'                => $this->bodyHowDisposableEmailImprovesPrivacyAndReducesSpam(),
            ],
        ];
    }
 
private function bodyHowDisposableEmailImprovesPrivacyAndReducesSpam(): string
{
    return <<<'HTML'
<p>Email remains one of the most important communication tools for personal, professional, and online activities. Every day, people sign up for new websites, download resources, join communities, subscribe to newsletters, test software, and register for online services. While these activities are convenient, they often lead to an increase in promotional emails, marketing campaigns, and unwanted inbox clutter.</p>

<p>Over time, a primary email address can become overloaded with messages that are no longer relevant. This is one reason why disposable email services have become increasingly popular among users seeking better inbox organization and privacy-focused email management.</p>

<p><strong>InboxOro</strong> provides a temporary email service that helps users receive verification emails and manage short-term registrations without relying exclusively on their primary inbox.</p>

<p>This guide explains how disposable email can help improve email privacy, reduce spam exposure, and support better inbox management practices.</p>

<h2>Introduction</h2>

<p>Every online registration typically requires an email address. Whether signing up for a newsletter, testing a software platform, accessing a free resource, or creating an account on a website, users are often asked to verify their email before gaining access.</p>

<p>While many services are legitimate, repeated registrations can contribute to:</p>

<ul>
<li>Inbox clutter</li>
<li>Marketing emails</li>
<li>Promotional newsletters</li>
<li>Subscription notifications</li>
<li>Product announcements</li>
<li>Account-related messages</li>
</ul>

<p>A disposable email address can help separate these temporary activities from personal or business communications.</p>

<h2>Why This Matters</h2>

<p>A crowded inbox can make it difficult to locate important messages. Professional communications, customer conversations, financial notifications, and personal emails may become buried beneath large volumes of less important messages.</p>

<p>Many users therefore seek practical ways to:</p>

<ul>
<li>Protect their primary inbox</li>
<li>Reduce unwanted email</li>
<li>Organize registrations more effectively</li>
<li>Manage online signups separately</li>
<li>Improve inbox productivity</li>
</ul>

<p>Disposable email services are designed to support these goals.</p>

<h2>What Is Disposable Email?</h2>

<p>A disposable email address is a temporary inbox that can receive messages for a limited period. Rather than using a primary email account for every online activity, users can use a temporary inbox for short-term registrations and verification workflows.</p>

<p>Disposable email services are commonly used for:</p>

<ul>
<li>Email verification</li>
<li>Product testing</li>
<li>Software trials</li>
<li>Temporary registrations</li>
<li>Developer testing</li>
<li>Research activities</li>
</ul>

<p>The goal is not to replace permanent email accounts but to help organize short-term communications more efficiently.</p>

<h2>Key Benefits</h2>

<h3>Reduce Spam Exposure</h3>

<p>One of the primary benefits of disposable email is reducing the number of promotional messages reaching a primary inbox.</p>

<p>When temporary registrations are separated from long-term communications, inbox organization becomes easier to maintain.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/disposable-email-for-spam-reduction">Disposable Email for Spam Reduction</a></p>

<h3>Support Email Privacy</h3>

<p>Users often prefer limiting the distribution of their primary email address across multiple websites and services.</p>

<p>Disposable email can help support privacy-focused email management by separating temporary registrations from everyday communications.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/disposable-email-for-privacy">Disposable Email for Privacy</a></p>

<h3>Improve Inbox Organization</h3>

<p>Keeping registration emails separate from business and personal communications can simplify inbox management.</p>

<h3>Manage Temporary Signups</h3>

<p>Many registrations are short-term in nature and may not require ongoing communication through a primary inbox.</p>

<h2>How Disposable Email Helps Protect Your Inbox</h2>

<p>A primary inbox often serves many important purposes:</p>

<ul>
<li>Work communication</li>
<li>Family correspondence</li>
<li>Financial notifications</li>
<li>Customer interactions</li>
<li>Important account updates</li>
</ul>

<p>Using a temporary inbox for short-term activities can help reduce unnecessary traffic within a primary mailbox.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/disposable-email-for-email-protection">Disposable Email for Email Protection</a></p>

<h2>Privacy-Focused Email Management</h2>

<p>Privacy-focused email management involves organizing communications in a way that minimizes unnecessary exposure of personal inboxes while maintaining access to essential messages.</p>

<p>Temporary inboxes can support this approach by providing separate destinations for short-term registrations.</p>

<p>Related resources:</p>

<ul>
<li><a href="https://inboxoro.com/privacy-focused-email">Privacy-Focused Email</a></li>
<li><a href="https://inboxoro.com/privacy-focused-inbox">Privacy-Focused Inbox</a></li>
</ul>

<h2>Disposable Email for Online Registration</h2>

<p>Many websites require email verification before granting access to content or services.</p>

<p>Examples include:</p>

<ul>
<li>Newsletters</li>
<li>Community forums</li>
<li>Educational resources</li>
<li>Software platforms</li>
<li>Online tools</li>
<li>Trial registrations</li>
</ul>

<p>Temporary inboxes can help manage these registration workflows more efficiently.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/disposable-email-for-online-registration">Disposable Email for Online Registration</a></p>

<h2>Disposable Email for Subscriptions</h2>

<p>Subscription-based services frequently send onboarding emails, promotional campaigns, feature announcements, and account notifications.</p>

<p>Using a temporary inbox for certain short-term subscriptions can help reduce inbox clutter.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/disposable-email-for-subscriptions">Disposable Email for Subscriptions</a></p>

<h2>Real-World Use Cases</h2>

<h3>Software Evaluation</h3>

<p>Users testing productivity tools, business applications, and online services often need to complete email verification before accessing features.</p>

<h3>Developer Testing</h3>

<p>Developers frequently validate registration systems, onboarding workflows, and email delivery processes.</p>

<h3>Educational Resources</h3>

<p>Students and researchers may register for webinars, learning platforms, and downloadable materials.</p>

<h3>Newsletter Registrations</h3>

<p>Users sometimes subscribe to content temporarily while evaluating whether it remains relevant to their interests.</p>

<h3>Business Research</h3>

<p>Organizations often explore multiple software solutions before selecting long-term vendors.</p>

<h2>Best Practices</h2>

<h3>Use Disposable Email for Temporary Activities</h3>

<p>Temporary registrations, evaluations, and testing workflows are commonly suited for disposable inboxes.</p>

<h3>Use Permanent Email for Important Accounts</h3>

<p>Critical accounts and long-term services generally benefit from a permanent email address.</p>

<h3>Review Platform Policies</h3>

<p>Users should comply with applicable terms of service and registration requirements.</p>

<h3>Maintain Organized Communication Channels</h3>

<p>Separating temporary and long-term communications can improve inbox management.</p>

<h2>Common Mistakes</h2>

<h3>Using One Inbox for Every Registration</h3>

<p>This can result in unnecessary inbox clutter over time.</p>

<h3>Ignoring Email Organization</h3>

<p>Without proper separation, important messages can become difficult to locate.</p>

<h3>Using Temporary Email for Critical Long-Term Accounts</h3>

<p>Permanent accounts are generally better suited for ongoing communication needs.</p>

<h3>Overlooking Verification Requirements</h3>

<p>Many services require email confirmation before granting access to features.</p>

<h2>How InboxOro Supports Privacy-Focused Inbox Management</h2>

<p>InboxOro helps users receive verification emails, registration confirmations, onboarding messages, and account notifications through temporary inboxes designed for short-term activities.</p>

<p>Common use cases include:</p>

<ul>
<li>Website registrations</li>
<li>Software evaluations</li>
<li>Developer testing</li>
<li>Email verification</li>
<li>Newsletter signups</li>
<li>Research activities</li>
</ul>

<p>The service is designed to support privacy-focused inbox management while helping users reduce spam exposure and keep their primary inbox organized.</p>

<h2>Frequently Asked Questions</h2>

<h3>What is disposable email?</h3>

<p>Disposable email is a temporary inbox that can receive emails for a limited period and is commonly used for short-term registrations and verification workflows.</p>

<h3>Can disposable email help reduce spam?</h3>

<p>It can help reduce the amount of promotional email reaching a primary inbox by separating temporary registrations from long-term communications.</p>

<h3>Is disposable email useful for email verification?</h3>

<p>Yes. Temporary inboxes are commonly used to receive verification emails and activation links.</p>

<h3>Can businesses use disposable email?</h3>

<p>Businesses may use temporary inboxes for testing, software evaluations, and quality assurance workflows.</p>

<h3>Is InboxOro affiliated with any third-party platform?</h3>

<p>No. All trademarks and brand names belong to their respective owners. InboxOro is not affiliated with, endorsed by, or sponsored by any third-party brand mentioned.</p>

<h2>Conclusion</h2>

<p>Managing online registrations effectively has become increasingly important as digital services continue to grow. Disposable email provides a practical solution for organizing temporary signups, reducing unwanted email exposure, and supporting privacy-focused inbox management.</p>

<p>InboxOro helps users receive verification emails, manage short-term registrations, and maintain a cleaner primary inbox while supporting responsible and organized email practices.</p>

<p>Whether you are testing software, registering for online resources, subscribing to newsletters, or conducting research, disposable email can help simplify inbox management and improve overall email organization.</p>
HTML;
}
}