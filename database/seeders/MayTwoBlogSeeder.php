<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MayTwoBlogSeeder extends Seeder
{
    
    // php artisan db:seed --class=MayTwoBlogSeeder    
    
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
                'title'               => 'Temporary Email for Free Trials: Complete Guide',
                'slug'                => 'temp-email-for-free-trials-guide',
                'excerpt'             => 'Learn how to use temporary email for free trials. Avoid spam and protect your inbox with InboxOro.',
                'featured_image'      => 'temp-email-free-trials.png',
                'featured_image_alt'  => 'Using temporary email for accessing free trials safely',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Temp Email for Free Trials (2026 Guide)',
                'meta_description'    => 'Use temporary email for free trials safely. Avoid spam and protect your inbox with InboxOro.',
                'status'              => 'published',
                'is_featured'         => false,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['free-trials', 'temporary-email', 'privacy', 'spam-protection'],
                'body'                => $this->bodyTempEmailFreeTrials(),
            ],
        ];
    }

   private function bodyTempEmailFreeTrials(): string
{
    return <<<'HTML'
<p>Free trials are everywhere. From streaming platforms to SaaS tools, most services offer limited-time access in exchange for your email address. While this sounds like a great deal, it often comes with hidden costs—mainly spam, unwanted emails, and long-term marketing exposure.</p>

<p>This is why many users now prefer using a <strong>temporary email for free trials</strong>.</p>

<p>Instead of giving away your personal email, you can use a disposable address to access the trial, receive the verification code, and move on—without any long-term consequences.</p>

<p>In this guide, we will explore how temporary email works for free trials, its benefits, best practices, and how tools like <a href="https://inboxoro.com">InboxOro</a> can simplify the process.</p>

<h2>What is a Temporary Email?</h2>

<p>A temporary email is a short-lived email address that allows you to receive messages without creating a permanent account.</p>

<p>You can generate one instantly using:</p>

<ul>
<li><a href="https://inboxoro.com/temporary-email">temporary email</a></li>
<li><a href="https://inboxoro.com/fake-email">fake email</a></li>
<li><a href="https://inboxoro.com/10-minute-email">10 minute email</a></li>
</ul>

<p>These emails are commonly used for short-term access such as free trials.</p>

<h2>Why Use Temporary Email for Free Trials?</h2>

<h3>1. Avoid Marketing Emails</h3>
<p>Many services automatically add users to email campaigns after signup.</p>

<p>Using a temporary email prevents your inbox from being flooded.</p>

<p>Learn more: <a href="https://inboxoro.com/avoid-spam-email">avoid spam email</a></p>

<h3>2. Protect Your Privacy</h3>
<p>Your personal email is valuable data. Sharing it everywhere increases risk.</p>

<p>Example: <a href="https://inboxoro.com/protect-email-privacy">protect email privacy</a></p>

<h3>3. Quick and Easy Access</h3>
<p>Temporary email allows instant signup without registration.</p>

<h3>4. No Long-Term Commitment</h3>
<p>After the trial ends, the email disappears.</p>

<h2>How to Use Temporary Email for Free Trials</h2>

<p>Here is a simple step-by-step process:</p>

<ol>
<li>Go to <a href="https://inboxoro.com">InboxOro</a></li>
<li>Generate a temporary email instantly</li>
<li>Use it to sign up for the free trial</li>
<li>Receive verification email or OTP</li>
<li>Access the service</li>
</ol>

<p>This process takes less than a minute.</p>

<h2>Common Use Cases</h2>

<h3>1. Streaming Services</h3>
<p>Users often explore free content without committing long-term.</p>

<h3>2. SaaS Platforms</h3>
<p>Temporary email helps with signup on platforms like:</p>

<ul>
<li><a href="https://inboxoro.com/temp-mail-for-saas-signup">SaaS signup</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-api-testing">API testing</a></li>
</ul>

<h3>3. Online Tools</h3>
<p>Access tools without sharing personal email.</p>

<h3>4. Educational Platforms</h3>
<p>Students often test tools temporarily.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-students">students</a></p>

<h2>Benefits of Using Temporary Email</h2>

<ul>
<li>Instant access</li>
<li>No spam</li>
<li>No registration</li>
<li>Better privacy</li>
</ul>

<h2>Limitations</h2>

<ul>
<li>Temporary access only</li>
<li>No password recovery</li>
<li>Not suitable for important accounts</li>
</ul>

<h2>Best Practices</h2>

<ul>
<li>Use temporary email only for short-term access</li>
<li>Avoid sensitive accounts</li>
<li>Use real email for long-term subscriptions</li>
</ul>

<h2>Alternative Use Cases</h2>

<p>Temporary email is also useful for:</p>

<ul>
<li><a href="https://inboxoro.com/temp-email-for-coupons">Coupons</a></li>
<li><a href="https://inboxoro.com/temp-email-for-giveaways">Giveaways</a></li>
<li><a href="https://inboxoro.com/temp-email-for-downloads">Downloads</a></li>
</ul>

<h2>Conclusion</h2>

<p>Using a <strong>temporary email for free trials</strong> is a smart way to explore services without risking your personal inbox.</p>

<p>It helps reduce spam, protects your privacy, and gives you full control over your online activity.</p>

<p>With <strong>InboxOro</strong>, generating a temporary email is quick, simple, and effective for accessing free trials safely.</p>

<p>When used correctly, it becomes an essential tool for modern internet users.</p>
HTML;
}
}