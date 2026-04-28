<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AprilTwentyEightBlogSeeder extends Seeder
{
    
    // php artisan db:seed --class=AprilTwentyEightBlogSeeder    
    
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
                'blog_category_id'    => $cats['email-tips'],
                'title'               => 'Best Use Cases for Temporary Email in 2026',
                'slug'                => 'best-temp-email-use-cases-2026',
                'excerpt'             => 'Discover the best use cases for temporary email in 2026. Protect privacy, avoid spam, and simplify online signups.',
                'featured_image'      => 'temp-email-use-cases-2026.png',
                'featured_image_alt'  => 'Different use cases of temporary email in modern digital life',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Best Uses of Temporary Email (2026 Guide)',
                'meta_description'    => 'Learn the best use cases for temporary email. Avoid spam, protect privacy, and use InboxOro smartly.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['temporary-email', 'use-cases', 'privacy', 'spam-protection'],
                'body'                => $this->bodyTempMailUseCases2026(),
            ],
        ];
    }
private function bodyTempMailUseCases2026(): string
{
    return <<<'HTML'
<p>The way people use email has changed significantly over the past few years. With increasing concerns about privacy, spam, and data exposure, more users are turning to temporary email solutions for everyday online activities.</p>

<p>But many still ask: <strong>when should you actually use a temporary email?</strong></p>

<p>In this guide, we will explore the <strong>best use cases for temporary email in 2026</strong>, helping you understand when it makes sense to use a disposable inbox and when it is better to stick with your primary email.</p>

<p>Tools like <a href="https://inboxoro.com">InboxOro</a> make it easy to generate a temporary email instantly, but using it effectively requires understanding the right scenarios.</p>

<h2>What is Temporary Email?</h2>

<p>A temporary email is a short-lived email address designed for quick and anonymous use. It allows users to receive messages without creating a permanent account.</p>

<p>You can generate one instantly using:</p>

<ul>
<li><a href="https://inboxoro.com/temporary-email-generator">Temporary email generator</a></li>
<li><a href="https://inboxoro.com/fake-email">Fake email</a></li>
<li><a href="https://inboxoro.com/10-minute-email">10 minute email</a></li>
</ul>

<p>These emails are commonly used for verification, testing, and short-term access.</p>

<h2>1. Account Signup and Verification</h2>

<p>One of the most common use cases is signing up for websites that require email verification.</p>

<p>Temporary email helps with signup on platforms like:</p>

<ul>
<li><a href="https://inboxoro.com/temp-mail-for-discord">Discord</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-instagram">Instagram</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-facebook">Facebook</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-linkedin">LinkedIn</a></li>
</ul>

<p>This allows users to complete registration without exposing their personal email.</p>

<h2>2. Receiving OTP and Verification Codes</h2>

<p>Temporary email is widely used for receiving one-time passwords and verification links.</p>

<p>Useful pages:</p>

<ul>
<li><a href="https://inboxoro.com/email-for-otp">Email for OTP</a></li>
<li><a href="https://inboxoro.com/receive-otp-online">Receive OTP online</a></li>
<li><a href="https://inboxoro.com/email-for-verification-code">Email for verification code</a></li>
</ul>

<p>This is a quick and efficient way to access accounts without long-term commitment.</p>

<h2>3. Avoiding Spam and Promotional Emails</h2>

<p>Many websites automatically add users to marketing lists. Using a temporary email prevents your main inbox from being flooded.</p>

<p>Learn more:</p>

<ul>
<li><a href="https://inboxoro.com/avoid-spam-email">Avoid spam email</a></li>
<li><a href="https://inboxoro.com/spam-free-email">Spam free email</a></li>
</ul>

<p>This is especially useful when accessing free content or signing up for newsletters.</p>

<h2>4. Free Trials and Subscriptions</h2>

<p>Temporary email is commonly used to access free trials without long-term commitment.</p>

<p>Example:</p>

<ul>
<li><a href="https://inboxoro.com/temp-email-for-free-trials">Temp email for free trials</a></li>
</ul>

<p>This helps users explore services without sharing personal information.</p>

<h2>5. Online Shopping and Coupons</h2>

<p>Temporary email is often used for deals, discounts, and coupon access.</p>

<ul>
<li><a href="https://inboxoro.com/temp-email-for-coupons">Temp email for coupons</a></li>
<li><a href="https://inboxoro.com/temp-email-for-online-shopping">Temp email for shopping</a></li>
</ul>

<p>This avoids long-term promotional emails after purchase.</p>

<h2>6. Testing and Development</h2>

<p>Developers use temporary email to test email functionality.</p>

<p>Useful tools:</p>

<ul>
<li><a href="https://inboxoro.com/email-testing-tool">Email testing tool</a></li>
<li><a href="https://inboxoro.com/email-sandbox-tool">Email sandbox tool</a></li>
<li><a href="https://inboxoro.com/developer-email-testing-tool">Developer email testing tool</a></li>
</ul>

<p>This ensures that email workflows function correctly before deployment.</p>

<h2>7. Surveys, Downloads, and Giveaways</h2>

<p>Temporary email is perfect for accessing gated content.</p>

<ul>
<li><a href="https://inboxoro.com/temp-email-for-surveys">Surveys</a></li>
<li><a href="https://inboxoro.com/temp-email-for-downloads">Downloads</a></li>
<li><a href="https://inboxoro.com/temp-email-for-giveaways">Giveaways</a></li>
</ul>

<p>This helps users avoid follow-up emails and marketing sequences.</p>

<h2>8. Students and Learning Platforms</h2>

<p>Students often use temporary email for accessing tools and resources.</p>

<ul>
<li><a href="https://inboxoro.com/temp-email-for-students">Temp email for students</a></li>
</ul>

<p>This is useful for short-term learning and experimentation.</p>

<h2>9. Anonymous Browsing and Privacy</h2>

<p>Temporary email helps protect identity and maintain anonymity.</p>

<ul>
<li><a href="https://inboxoro.com/anonymous-email">Anonymous email</a></li>
<li><a href="https://inboxoro.com/privacy-email">Privacy email</a></li>
</ul>

<p>This is useful for users who prioritize digital privacy.</p>

<h2>10. API Testing and SaaS Platforms</h2>

<p>Temporary email is widely used for testing SaaS applications.</p>

<ul>
<li><a href="https://inboxoro.com/temp-mail-for-api-testing">API testing</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-saas-signup">SaaS signup</a></li>
</ul>

<p>This allows developers to simulate real user scenarios.</p>

<h2>When NOT to Use Temporary Email</h2>

<p>While temporary email is useful, it should not be used for:</p>

<ul>
<li>Banking and financial accounts</li>
<li>Important personal accounts</li>
<li>Long-term subscriptions</li>
</ul>

<p>For these cases, always use a real email address.</p>

<h2>Conclusion</h2>

<p>Temporary email has become an essential tool in modern digital life. From avoiding spam to testing applications, its use cases continue to grow.</p>

<p>By using temporary email wisely, you can protect your privacy, reduce unwanted emails, and simplify your online experience.</p>

<p>With tools like <strong>InboxOro</strong>, generating a temporary email is fast, simple, and effective for everyday needs.</p>
HTML;
}
}