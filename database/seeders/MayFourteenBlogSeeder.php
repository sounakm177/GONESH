<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MayFourteenBlogSeeder extends Seeder
{
    
    // php artisan db:seed --class=MayFourteenBlogSeeder    
    
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
                'title'               => 'Why Temporary Email is Useful for Online Shopping',
                'slug'                => 'temporary-email-online-shopping',
                'excerpt'             => 'Learn why temporary email is useful for online shopping, coupons, and protecting your inbox from spam.',
                'featured_image'      => 'temp-email-online-shopping.png',
                'featured_image_alt'  => 'Using temporary email safely during online shopping',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Temporary Email for Online Shopping Guide',
                'meta_description'    => 'Use temporary email for online shopping to avoid spam and protect your personal inbox.',
                'status'              => 'published',
                'is_featured'         => false,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['online-shopping', 'temporary-email', 'privacy', 'spam-protection'],
                'body'                => $this->bodyTempEmailShopping(),
            ],
        ];
    }

private function bodyTempEmailShopping(): string
{
    return <<<'HTML'
<p>Online shopping has become part of everyday life. From clothing and electronics to food delivery and digital products, millions of people create accounts on shopping websites every day.</p>

<p>But there is one common issue almost every online shopper experiences: spam emails.</p>

<p>After signing up on shopping platforms, users often start receiving endless promotional emails, discount campaigns, newsletters, and marketing notifications. Over time, these emails clutter your inbox and make it difficult to find important messages.</p>

<p>This is one reason many users now prefer using temporary email for online shopping.</p>

<p>With tools like <a href="https://inboxoro.com">InboxOro</a>, users can generate a temporary email instantly and use it for short-term shopping activities while protecting their personal inbox.</p>

<h2>What is Temporary Email?</h2>

<p>A temporary email is a disposable email address designed for short-term use. It allows users to receive emails instantly without creating a permanent account.</p>

<p>Examples include:</p>

<ul>
<li><a href="https://inboxoro.com/temporary-email">temporary email</a></li>
<li><a href="https://inboxoro.com/fake-email">fake email</a></li>
<li><a href="https://inboxoro.com/10-minute-email">10 minute email</a></li>
</ul>

<p>These addresses are commonly used for verification, coupons, and online registrations.</p>

<h2>Why Online Shopping Creates Spam</h2>

<p>Many ecommerce websites collect email addresses for:</p>

<ul>
<li>Order confirmations</li>
<li>Marketing campaigns</li>
<li>Discount offers</li>
<li>Customer engagement</li>
</ul>

<p>While these emails can sometimes be useful, they often become excessive.</p>

<p>Some platforms may continue sending promotional emails for months or years after a single purchase.</p>

<h2>How Temporary Email Helps</h2>

<h3>1. Keeps Your Inbox Clean</h3>

<p>Using temporary email prevents promotional emails from reaching your personal inbox.</p>

<p>Learn more: <a href="https://inboxoro.com/spam-free-email">spam free email</a></p>

<h3>2. Protects Privacy</h3>

<p>Your personal email is connected to many parts of your digital identity.</p>

<p>Temporary email helps reduce unnecessary exposure.</p>

<p>Example: <a href="https://inboxoro.com/protect-email-privacy">protect email privacy</a></p>

<h3>3. Useful for One-Time Purchases</h3>

<p>If you only plan to buy once from a website, temporary email can be practical.</p>

<h3>4. Easy Coupon Access</h3>

<p>Many shopping platforms require email signup for discounts and coupons.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-coupons">temp email for coupons</a></p>

<h2>Common Shopping Use Cases</h2>

<h3>1. Discount Coupons</h3>

<p>Temporary email is commonly used to access promotional offer.</p>

<h3>2. Limited-Time Sales</h3>

<p>Users often sign up temporarily during seasonal sales events.</p>

<h3>3. Digital Downloads</h3>

<p>Some shopping platforms require email verification before downloads.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-downloads">downloads</a></p>

<h3>4. Giveaways</h3>

<p>Many giveaways require email participation.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-giveaways">giveaways</a></p>

<h2>How to Use Temporary Email for Shopping</h2>

<ol>
<li>Visit <a href="https://inboxoro.com">InboxOro</a></li>
<li>Generate a temporary email address</li>
<li>Use it during shopping signup</li>
<li>Receive verification messages instantly</li>
</ol>

<p>The process is simple and takes only seconds.</p>

<h2>When to Use Real Email Instead</h2>

<p>Temporary email is useful for many shopping situations, but real email is still important for:</p>

<ul>
<li>Important purchase receipts</li>
<li>Long-term ecommerce accounts</li>
<li>Warranty information</li>
<li>Order tracking</li>
</ul>

<p>If you regularly use shopping platform, a permanent email may be the better choice.</p>

<h2>Privacy and Security Considerations</h2>

<p>Temporary email should only be used for low-risk activities.</p>

<p>Avoid using disposable email for:</p>

<ul>
<li>Financial accounts</li>
<li>Sensitive personal information</li>
<li>Long-term account recovery</li>
</ul>

<p>For secure accounts, always use a trusted permanent email address.</p>

<h2>Benefits of Temporary Email for Shopping</h2>

<ul>
<li>Reduces spam</li>
<li>Protects privacy</li>
<li>Quick access to coupons</li>
<li>Instant signup</li>
</ul>

<h2>Best Practices</h2>

<ul>
<li>Use temporary email for short-term shopping activities</li>
<li>Keep important purchases connected to real email</li>
<li>Avoid sharing sensitive information unnecessarily</li>
</ul>

<h2>Conclusion</h2>

<p>Online shopping often leads to unnecessary promotional emails and marketing spam. Using a temporary email helps protect your personal inbox while still giving you access to discounts, coupons, and quick registrations.</p>

<p>With <strong>InboxOro</strong>, users can instantly generate temporary email addresses for safer and cleaner online shopping experiences.</p>

<p>Used wisely, temporary email becomes a practical privacy tool for modern ecommerce activity.</p>
HTML;
}
}