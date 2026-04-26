<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Support\Carbon;


class AprilTwentyFourSeeder extends Seeder
{

    // php artisan db:seed --class=AprilTwentyFourSeeder    

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
                'blog_category_id'    => $cats['guides'],
                'title'               => 'Temp Mail for Quora Signup & Verification',
                'slug'                => 'temp-mail-for-quora',
                'excerpt'             => 'Use temp mail for Quora signup and verification. Receive emails instantly and protect your personal inbox with InboxOro.',
                'featured_image'      => 'temp-mail-quora.png',
                'featured_image_alt'  => 'Temporary email inbox used for account verification',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Temp Mail for Quora Verification | InboxOro',
                'meta_description'    => 'Use temp mail for Quora verification. Get emails instantly and keep your inbox private with InboxOro.',
                'status'              => 'published',
                'is_featured'         => false,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['quora', 'temporary-email', 'verification-email', 'privacy', 'signup'],
                'body'                => $this->bodyTempMailQuora(),
            ],
        ];
    }

    private function bodyTempMailQuora(): string
{
    return <<<'HTML'
<p>If you are looking for a simple way to sign up without sharing your personal email, using a <strong>temporary email for Quora signup</strong> can be a practical and privacy-friendly solution. Many users today prefer to keep their main inbox clean while still accessing platforms that require email verification.</p>

<p>A disposable email service like <strong>InboxOro</strong> allows you to generate a temporary email address instantly. This helps you receive verification messages without exposing your real email or committing to long-term communication.</p>

<p>This guide explains how temporary email works, why people use it, and how it can help during signup and verification processes in a safe and responsible way.</p>

<h2 id="what-is-temp-mail">What is Temporary Email?</h2>

<p>Temporary email, often called disposable email, is a short-term email address that can receive messages for a limited period. Unlike traditional email accounts, it does not require registration or personal information.</p>

<p>These email addresses are automatically deleted after a certain time, making them ideal for short-term use cases.</p>

<p>Temporary email is commonly used for:</p>

<ul>
<li>Quick account registration</li>
<li>Email verification</li>
<li>Testing applications and workflows</li>
<li>Avoiding spam and promotional emails</li>
</ul>

<p>InboxOro provides instant access to such email addresses, allowing users to receive messages without delays.</p>

<h2 id="why-use-temp-mail">Why Use Temporary Email for Signup?</h2>

<p>Many online platforms require email verification. While this helps improve security, it also means your email address may be stored and used for future communication.</p>

<p>For users who want to use online services without sharing their primary email, temporary email offers a convenient alternative.</p>

<h3>Privacy Protection</h3>
<p>Your personal email address remains hidden, reducing the chances of unwanted tracking or data exposure.</p>

<h3>Spam Reduction</h3>
<p>Using a disposable email helps avoid newsletters, promotions, and follow-up emails that may not be relevant.</p>

<h3>Quick Access</h3>
<p>You can receive verification emails instantly without going through a signup process.</p>

<h3>Flexibility</h3>
<p>Temporary email is useful for testing features, exploring platforms, or creating short-term accounts.</p>

<p>This approach is commonly used by individuals who prefer to separate their primary communication from temporary interactions online.</p>

<h2 id="how-to-use">How to Use Temporary Email for Verification</h2>

<p>Using InboxOro is simple and requires only a few steps:</p>

<ol>
<li>Open InboxOro and generate a temporary email address</li>
<li>Enter the email during the signup process</li>
<li>Wait for the verification message</li>
<li>Copy the code or click the verification link</li>
<li>Complete the signup process</li>
</ol>

<p>The entire process usually takes less than a minute and does not require any registration.</p>

<h2 id="real-world-use">Real-World Use Cases</h2>

<p>Temporary email is widely used in different scenarios. Here are some common examples:</p>

<h3>Testing Platform Features</h3>
<p>Users often explore features before committing. Temporary email allows quick access without long-term involvement.</p>

<h3>Creating Secondary Accounts</h3>
<p>Some users create additional accounts for testing, research, or content exploration.</p>

<h3>Accessing Gated Content</h3>
<p>Many platforms require email verification to access content. Temporary email provides a quick solution.</p>

<h3>Development and QA Testing</h3>
<p>Developers use disposable email to test signup flows and email delivery systems.</p>

<h2 id="benefits">Benefits of Using InboxOro</h2>

<h3>Instant Email Generation</h3>
<p>You can generate a working email address instantly without any signup process.</p>

<h3>Automatic Deletion</h3>
<p>Emails are removed after a short period, reducing long-term exposure.</p>

<h3>No Personal Data Required</h3>
<p>You do not need to provide personal information to use the service.</p>

<h3>Clean Inbox Experience</h3>
<p>Your primary email remains free from unnecessary messages.</p>

<h2 id="limitations">Limitations to Consider</h2>

<p>While temporary email is useful, it is important to understand its limitations:</p>

<ul>
<li>Emails are not stored permanently</li>
<li>Inbox may be accessible publicly</li>
<li>Not suitable for long-term or important accounts</li>
</ul>

<p>For accounts that require long-term access or recovery options, it is recommended to use a personal email address.</p>

<h2 id="security">Security and Responsible Use</h2>

<p>Temporary email should be used responsibly. Here are some best practices:</p>

<ul>
<li>Avoid sharing sensitive or personal information</li>
<li>Do not use it for financial or critical services</li>
<li>Use strong passwords for any accounts created</li>
</ul>

<p>This ensures that your usage remains safe and within acceptable guidelines.</p>

<h2 id="related-tools">Helpful Tools You Can Use</h2>

<p>If you want to use temporary email for different scenarios, InboxOro provides dedicated pages where you can generate a working inbox instantly:</p>

<ul>
<li><a href="https://inboxoro.com/temp-mail-for-facebook">Generate email for social media signup</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-instagram">Use temporary email for quick access</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-api-testing">Test email workflows and APIs</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-saas-signup">Access SaaS platforms without personal email</a></li>
</ul>

<p>These tools are commonly used for verification, testing, and short-term usage across different platforms.</p>

<h2 id="faq">Frequently Asked Questions</h2>

<h3>Can I receive verification emails using temporary email?</h3>
<p>Yes, temporary email is commonly used to receive verification messages instantly.</p>

<h3>Is InboxOro free to use?</h3>
<p>Yes, InboxOro provides free access to temporary email services.</p>

<h3>How long do emails stay available?</h3>
<p>Emails are available for a limited time before being automatically deleted.</p>

<h3>Is it safe to use temporary email?</h3>
<p>It is safe for short-term, non-sensitive use cases.</p>

<h2 id="conclusion">Conclusion</h2>

<p>Using a <strong>temporary email for Quora signup and verification</strong> is a practical way to maintain privacy while accessing online platforms. It helps reduce spam, keeps your inbox clean, and provides instant access without long-term commitment.</p>

<p>InboxOro makes this process simple, fast, and accessible. For users who want to use temporary email responsibly, it offers a convenient solution for modern online needs.</p>
HTML;
}

}
