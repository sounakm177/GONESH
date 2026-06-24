<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JuneTwentyFourBlogSeeder extends Seeder
{
    

    // php artisan db:seed --class=JuneTwentyFourBlogSeeder    
    
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
                'title'               => 'How Temporary Email Helps Protect Your Primary Inbox',
                'slug'                => 'how-temporary-email-helps-protect-your-primary-inbox',
                'excerpt'             => 'Learn how temporary email helps reduce spam exposure, organize online signups, and keep your primary inbox cleaner.',
                'featured_image'      => 'how-temporary-email-helps-protect-your-primary-inbox.png',
                'featured_image_alt'  => 'Professional email privacy and inbox protection illustration',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'How Temporary Email Helps Protect Your Primary Inbox',
                'meta_description'    => 'Discover how temporary email supports spam protection, online signups, downloads, free trials, and inbox organization.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => [
                    'temporary-email',
                    'email-privacy',
                    'spam-protection',
                    'disposable-email',
                    'online-signups'
                ],
                'body'                => $this->bodyHowTemporaryEmailHelpsProtectYourPrimaryInbox(),
            ],
        ];
    }
 
private function bodyHowTemporaryEmailHelpsProtectYourPrimaryInbox(): string
{
    return <<<'HTML'
<p>Your primary email inbox is one of the most important digital assets you use every day. It often contains personal conversations, business communications, financial notifications, account security alerts, and other important information. However, every time you sign up for a website, download a resource, start a free trial, or subscribe to a newsletter, your inbox may receive additional messages that can quickly become overwhelming.</p>

<p>Over time, these registrations can result in hundreds of promotional emails, product announcements, newsletters, and marketing campaigns. Managing this growing volume of email can become difficult, especially for users who regularly explore new websites, applications, and online services.</p>

<p><strong>InboxOro</strong> provides a temporary email service that helps users separate short-term registrations from their primary inbox. By using a temporary inbox for certain online activities, users can organize communications more effectively and reduce unwanted email exposure.</p>

<p>This guide explains how temporary email can help protect your primary inbox while supporting better email privacy, inbox organization, and spam protection.</p>

<h2>Introduction</h2>

<p>Most online services require an email address before granting access to features, content, downloads, or free trials. While email verification improves security and confirms account ownership, it also means users frequently share their primary email address across numerous websites.</p>

<p>Common online activities include:</p>

<ul>
<li>Website registrations</li>
<li>App signups</li>
<li>Free trial access</li>
<li>Digital downloads</li>
<li>Newsletter subscriptions</li>
<li>Product demonstrations</li>
<li>Online services</li>
<li>Research and testing</li>
</ul>

<p>Each registration may generate multiple emails over time. Temporary email helps users manage these activities more efficiently.</p>

<h2>Why This Matters</h2>

<p>Email remains one of the most widely used communication channels on the internet. As users interact with more services, the volume of incoming messages typically increases.</p>

<p>Common inbox challenges include:</p>

<ul>
<li>Promotional emails</li>
<li>Marketing campaigns</li>
<li>Product updates</li>
<li>Newsletters</li>
<li>Subscription reminders</li>
<li>Verification emails</li>
<li>Download confirmations</li>
</ul>

<p>When these messages accumulate, important emails may become harder to find. Using a temporary inbox for short-term registrations can help improve inbox organization.</p>

<h2>What Is a Temporary Email?</h2>

<p>A temporary email is a disposable inbox designed to receive emails for a limited period. Users commonly use temporary inboxes when they need an email address for verification, registration, testing, or short-term online activities.</p>

<p>Temporary email services are often used for:</p>

<ul>
<li>Website signups</li>
<li>Verification emails</li>
<li>Free trial registrations</li>
<li>Software evaluations</li>
<li>Newsletter subscriptions</li>
<li>Resource downloads</li>
<li>Testing workflows</li>
</ul>

<p>Rather than replacing a permanent email account, temporary email helps separate temporary activities from long-term communications.</p>

<h2>Key Benefits</h2>

<h3>Reduce Inbox Clutter</h3>

<p>Many online registrations result in recurring email communications. Temporary email can help keep these messages separate from important emails.</p>

<h3>Improve Email Organization</h3>

<p>Separating short-term registrations into a dedicated temporary inbox makes it easier to manage different types of communications.</p>

<h3>Support Privacy-Focused Email Management</h3>

<p>Users often prefer limiting the use of their primary email address when exploring new websites or services.</p>

<h3>Convenient for Testing and Research</h3>

<p>Developers, QA engineers, marketers, and researchers frequently use temporary email during evaluations and testing activities.</p>

<h2>Temporary Email for Privacy</h2>

<p>Many users choose temporary inboxes when they want to separate registrations from their primary email account.</p>

<p>Using a dedicated inbox for temporary activities can help improve email organization and reduce exposure to unwanted messages.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-email-for-privacy">Temporary Email for Privacy</a></p>

<h2>Temporary Email for Spam Protection</h2>

<p>Promotional emails and marketing campaigns often increase after registering on websites or online services.</p>

<p>Using a temporary inbox for certain registrations can help reduce spam exposure in a primary inbox.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-email-for-spam-protection">Temporary Email for Spam Protection</a></p>

<h2>Temporary Email for Online Signups</h2>

<p>Many websites require email verification before providing access to content or services.</p>

<p>Temporary inboxes are commonly used for short-term signup workflows.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-email-for-online-signups">Temporary Email for Online Signups</a></p>

<h2>Temporary Email for Free Trials</h2>

<p>Free trials allow users to evaluate products and services before making purchasing decisions.</p>

<p>Temporary email can help organize verification emails and onboarding communications associated with these evaluations.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-email-for-free-trials">Temporary Email for Free Trials</a></p>

<h2>Temporary Email for One-Time Use</h2>

<p>Some registrations only require a single verification email or temporary access.</p>

<p>Temporary inboxes are commonly used for these short-term scenarios.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-email-for-one-time-use">Temporary Email for One-Time Use</a></p>

<h2>Real-World Use Cases</h2>

<h3>Downloading Resources</h3>

<p>Many websites provide ebooks, templates, reports, and guides in exchange for email registration. Temporary inboxes can help manage these interactions.</p>

<h3>Testing New Applications</h3>

<p>Users often explore software products and online tools before deciding whether they meet their needs.</p>

<h3>Newsletter Registrations</h3>

<p>Subscribing to multiple newsletters can generate a large volume of recurring emails. Temporary inboxes can help organize these subscriptions.</p>

<h3>Online Service Evaluations</h3>

<p>Businesses and individuals frequently compare services before making purchasing decisions.</p>

<h3>Developer Testing</h3>

<p>Developers commonly test email verification systems, onboarding workflows, and registration processes.</p>

<h2>Best Practices</h2>

<h3>Use Permanent Email for Important Accounts</h3>

<p>Critical services such as banking, healthcare, employment, and long-term business accounts should generally use a permanent email address.</p>

<h3>Use Temporary Email for Short-Term Activities</h3>

<p>Temporary inboxes are often most effective for registrations, evaluations, and testing activities.</p>

<h3>Review Privacy Policies</h3>

<p>Users should understand how websites and services handle email communications.</p>

<h3>Keep Activities Organized</h3>

<p>Separating temporary registrations from long-term communications can improve inbox management.</p>

<h2>Common Mistakes</h2>

<h3>Using One Inbox for Everything</h3>

<p>Combining business emails, personal communications, subscriptions, and testing activities can create unnecessary clutter.</p>

<h3>Ignoring Email Management</h3>

<p>Regularly reviewing inbox organization can help improve productivity.</p>

<h3>Using Temporary Email for Long-Term Accounts</h3>

<p>Permanent accounts are generally better suited for important ongoing services.</p>

<h3>Overlooking Verification Emails</h3>

<p>Many registrations require email confirmation before access is granted.</p>

<h2>How InboxOro Helps Protect Your Primary Inbox</h2>

<p>InboxOro provides a temporary email service designed to support privacy-focused email management and inbox organization.</p>

<p>Common use cases include:</p>

<ul>
<li>Website registrations</li>
<li>Free trial access</li>
<li>Newsletter subscriptions</li>
<li>Verification emails</li>
<li>Application testing</li>
<li>Online service evaluations</li>
<li>Resource downloads</li>
</ul>

<p>By separating temporary signups from important communications, users can maintain a cleaner and more organized primary inbox.</p>

<h2>Frequently Asked Questions</h2>

<h3>What is a temporary email?</h3>

<p>A temporary email is a disposable inbox that can receive emails for a limited period and is commonly used for registrations and verification workflows.</p>

<h3>Can temporary email help reduce spam exposure?</h3>

<p>Using temporary inboxes for certain registrations may help reduce unwanted marketing emails in a primary inbox.</p>

<h3>Is temporary email useful for free trials?</h3>

<p>Yes. Many users utilize temporary inboxes when evaluating products and services through trial programs.</p>

<h3>Can temporary email receive verification emails?</h3>

<p>Temporary inboxes are commonly used to receive account activation links and registration confirmations.</p>

<h3>Is InboxOro affiliated with any third-party website or service?</h3>

<p>No. All trademarks and brand names belong to their respective owners. InboxOro is not affiliated with, endorsed by, or sponsored by any third-party brand mentioned.</p>

<h2>Conclusion</h2>

<p>Your primary inbox deserves protection from unnecessary clutter and excessive promotional messages. As online registrations continue to increase, managing email communications becomes more important than ever.</p>

<p>InboxOro provides a practical temporary email solution that helps users organize short-term registrations, receive verification emails, support privacy-focused email management, and maintain a cleaner primary inbox.</p>

<p>Whether you are downloading resources, testing software, exploring online services, subscribing to newsletters, or starting free trials, temporary email can help keep temporary activities separate from your most important communications.</p>
HTML;
}
}