<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Support\Carbon;


class AprilTwentyFiveSeeder extends Seeder
{

    // php artisan db:seed --class=AprilTwentyFiveSeeder    

    /**
     * Run the database seeds.
     */
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
                'blog_category_id'    => $cats['developer'],
                'title'               => 'Email Testing Tool for Developers (Free & Instant)',
                'slug'                => 'email-testing-tool',
                'excerpt'             => 'Test emails instantly using a temporary inbox. Perfect for developers, QA teams, and SaaS platforms.',
                'featured_image'      => 'email-testing-tool.png',
                'featured_image_alt'  => 'Developer testing email delivery in a temporary inbox interface',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Email Testing Tool (Free) | InboxOro',
                'meta_description'    => 'Use a temporary inbox to test email delivery, OTP, and workflows. Fast and secure email testing with InboxOro.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['email-testing', 'developer-tools', 'temporary-email', 'api-testing', 'qa-testing'],
                'body'                => $this->bodyEmailTestingTool(),
            ],
        ];
    }

    private function bodyEmailTestingTool(): string
{
    return <<<'HTML'
<p>Testing email functionality is a critical part of modern application development. Whether you are building a SaaS platform, implementing authentication, or sending transactional emails, having a reliable <strong>email testing tool</strong> can save time and prevent production issues.</p>

<p>For developers and QA teams, using a temporary inbox like <strong>InboxOro</strong> offers a simple and effective way to test email workflows without relying on personal email accounts.</p>

<p>This guide explains how email testing works, why it matters, and how temporary email tools can improve your development process.</p>

<h2 id="what-is-email-testing">What is Email Testing?</h2>

<p>Email testing refers to the process of verifying that your application can send, receive, and display emails correctly. This includes checking:</p>

<ul>
<li>Email delivery</li>
<li>OTP or verification codes</li>
<li>Links and formatting</li>
<li>Spam filtering behavior</li>
</ul>

<p>Without proper testing, users may face issues like missing emails, broken links, or delayed delivery.</p>

<h2 id="why-important">Why Email Testing is Important</h2>

<p>Email is often a core part of user authentication and communication. Even a small issue can lead to poor user experience.</p>

<h3>Ensure Reliable Delivery</h3>
<p>Testing helps confirm that emails are delivered successfully.</p>

<h3>Verify OTP and Links</h3>
<p>Authentication systems rely on correct email functionality.</p>

<h3>Improve User Experience</h3>
<p>Users expect fast and reliable email communication.</p>

<h3>Prevent Production Errors</h3>
<p>Testing before deployment reduces the risk of issues in live environments.</p>

<h2 id="how-temp-mail-helps">How Temporary Email Helps in Testing</h2>

<p>Using a temporary email service allows developers to simulate real-world scenarios without using personal accounts.</p>

<p>With InboxOro, you can generate an inbox instantly and start testing within seconds.</p>

<ul>
<li>No registration required</li>
<li>Instant inbox creation</li>
<li>Real-time email delivery</li>
<li>Automatic cleanup</li>
</ul>

<p>This makes it ideal for quick testing and repeated workflows.</p>

<h2 id="how-to-use">How to Use InboxOro for Email Testing</h2>

<ol>
<li>Open InboxOro and generate a temporary email address</li>
<li>Use the email in your application or testing environment</li>
<li>Trigger email sending (OTP, confirmation, etc.)</li>
<li>Check the inbox for received messages</li>
<li>Verify content, links, and formatting</li>
</ol>

<p>This process is fast and does not require any setup.</p>

<h2 id="use-cases">Common Use Cases for Developers</h2>

<h3>Authentication Testing</h3>
<p>Verify login, signup, and password reset emails.</p>

<h3>Transactional Emails</h3>
<p>Test order confirmations, notifications, and alerts.</p>

<h3>API Testing</h3>
<p>Check email delivery triggered via APIs.</p>

<h3>QA Automation</h3>
<p>Use temporary email in automated test flows.</p>

<h2 id="benefits">Benefits of Using InboxOro</h2>

<h3>Fast and Simple</h3>
<p>No setup required. Start testing instantly.</p>

<h3>Clean Environment</h3>
<p>Each test uses a fresh inbox.</p>

<h3>No Data Storage</h3>
<p>Emails are automatically removed after a short time.</p>

<h3>Privacy Friendly</h3>
<p>No need to expose personal email accounts.</p>

<h2 id="limitations">Limitations</h2>

<ul>
<li>Emails are temporary and not stored long-term</li>
<li>Not suitable for production monitoring</li>
<li>Some services may block disposable emails</li>
</ul>

<h2 id="best-practices">Best Practices for Email Testing</h2>

<ul>
<li>Test multiple scenarios (signup, reset, notifications)</li>
<li>Verify email formatting on different devices</li>
<li>Check spam folder behavior</li>
<li>Use multiple test cases for reliability</li>
</ul>

<h2 id="related-tools">Helpful Tools You Can Use</h2>

<p>InboxOro provides additional tools for different testing and signup scenarios:</p>

<ul>
<li><a href="https://inboxoro.com/temp-mail-for-api-testing">Test email APIs and workflows</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-saas-signup">Test SaaS platform registration</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-freelancing">Use temporary email for freelancing platforms</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-ai-tools">Test email signup for AI tools</a></li>
</ul>

<p>These tools are commonly used for development, testing, and temporary access.</p>

<h2 id="faq">Frequently Asked Questions</h2>

<h3>Can I test OTP emails?</h3>
<p>Yes, temporary email is commonly used to receive OTP and verification emails.</p>

<h3>Is InboxOro free?</h3>
<p>Yes, it is free to use.</p>

<h3>Do emails arrive instantly?</h3>
<p>Most emails are delivered within seconds.</p>

<h3>Is it safe for testing?</h3>
<p>Yes, for non-sensitive testing scenarios.</p>

<h2 id="conclusion">Conclusion</h2>

<p>An <strong>email testing tool</strong> is essential for modern development. It ensures reliable communication, improves user experience, and helps prevent errors.</p>

<p>InboxOro provides a simple and effective way to test emails using temporary inboxes. It is fast, private, and easy to use for developers and QA teams.</p>
HTML;
}

}