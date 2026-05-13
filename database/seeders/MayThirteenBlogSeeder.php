<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MayThirteenBlogSeeder extends Seeder
{
    
    // php artisan db:seed --class=MayThirteenBlogSeeder    
    
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
                'blog_category_id'    => $cats['privacy'],
                'title'               => 'How Temporary Email Helps Protect Your Online Privacy',
                'slug'                => 'temporary-email-online-privacy',
                'excerpt'             => 'Learn how temporary email protects your online privacy, reduces spam, and keeps your personal inbox secure.',
                'featured_image'      => 'temporary-email-privacy.png',
                'featured_image_alt'  => 'Digital privacy concept with temporary email protection',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Temporary Email and Online Privacy Guide',
                'meta_description'    => 'Discover how temporary email helps protect privacy and reduce spam while browsing online.',
                'status'              => 'published',
                'is_featured'         => false,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['privacy', 'temporary-email', 'spam-protection', 'online-security'],
                'body'                => $this->bodyTempEmailPrivacy(),
            ],
        ];
    }

private function bodyTempEmailPrivacy(): string
{
    return <<<'HTML'
<p>Online privacy has become one of the biggest concerns in the digital world. Every signup, download, free trial, or online registration asks for your email address. Over time, your personal inbox becomes connected to dozens or even hundreds of platforms.</p>

<p>Many users do not realize how much information their email address can reveal.</p>

<p>Your email is often linked to shopping accounts, social media profiles, subscriptions, and other online activities. Once shared across multiple platforms, it becomes difficult to maintain privacy.</p>

<p>This is one reason temporary email services have become increasingly popular.</p>

<p>Using a temporary email allows users to access online services without exposing their personal inbox. Tools like <a href="https://inboxoro.com">InboxOro</a> help users generate temporary email addresses instantly for safer and cleaner online activity.</p>

<h2>What is Online Privacy?</h2>

<p>Online privacy refers to protecting your personal information while using internet services.</p>

<p>This includes:</p>

<ul>
<li>Email addresses</li>
<li>Personal identity</li>
<li>Browsing activity</li>
<li>Communication data</li>
</ul>

<p>Many websites collect user data for analytics, marketing, or account management. While some data collection is necessary, users increasingly prefer minimizing unnecessary exposure.</p>

<h2>Why Your Email Address Matters</h2>

<p>Your email address is more than just communication tool. It often becomes your digital identity.</p>

<p>When your email is shared across multiple websites, several things can happen:</p>

<ul>
<li>You receive spam emails</li>
<li>Your inbox becomes overloaded</li>
<li>Your information may spread across marketing systems</li>
<li>You become vulnerable to phishing attempts</li>
</ul>

<p>This is why many people now prefer using:</p>

<ul>
<li><a href="https://inboxoro.com/privacy-email">privacy email</a></li>
<li><a href="https://inboxoro.com/anonymous-email">anonymous email</a></li>
<li><a href="https://inboxoro.com/temporary-email">temporary email</a></li>
</ul>

<h2>How Temporary Email Works</h2>

<p>A temporary email is a disposable email address designed for short-term use.</p>

<p>You can generate one instantly and use it for:</p>

<ul>
<li>Verification codes</li>
<li>Free trials</li>
<li>Downloads</li>
<li>Quick signups</li>
</ul>

<p>Unlike permanent email accounts, temporary emails expire automatically after a certain period.</p>

<p>Examples include:</p>

<ul>
<li><a href="https://inboxoro.com/10-minute-email">10 minute email</a></li>
<li><a href="https://inboxoro.com/fake-email-generator">fake email generator</a></li>
<li><a href="https://inboxoro.com/throwaway-email">throwaway email</a></li>
</ul>

<h2>Main Privacy Benefits of Temporary Email</h2>

<h3>1. Reduces Spam</h3>

<p>One of the biggest advantages is avoiding promotional emails.</p>

<p>Many websites automatically add users to marketing campaigns after signup.</p>

<p>Using temporary email prevent your real inbox from being flooded.</p>

<p>Learn more: <a href="https://inboxoro.com/avoid-spam-email">avoid spam email</a></p>

<h3>2. Protects Personal Identity</h3>

<p>Temporary email helps separate your personal identity from short-term online activity.</p>

<p>This reduces unnecessary exposure.</p>

<h3>3. Minimizes Data Sharing</h3>

<p>Every time you use your personal email, your information becomes part of another database.</p>

<p>Temporary email reduces the amount of personal data shared online.</p>

<h3>4. Safer Testing Environment</h3>

<p>Developers and testers often use temporary email for QA and testing.</p>

<p>Useful tools:</p>

<ul>
<li><a href="https://inboxoro.com/email-testing-tool">email testing tool</a></li>
<li><a href="https://inboxoro.com/mock-email-service">mock email service</a></li>
<li><a href="https://inboxoro.com/email-sandbox-tool">email sandbox tool</a></li>
</ul>

<h2>Common Use Cases</h2>

<h3>1. Social Media Signup</h3>

<p>Temporary email is commonly used for signup on platforms like:</p>

<ul>
<li><a href="https://inboxoro.com/temp-mail-for-instagram">Instagram</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-facebook">Facebook</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-discord">Discord</a></li>
</ul>

<p>It helps users avoid long-term promotional emails.</p>

<h3>2. Verification and OTP</h3>

<p>Users often need quick access to verification messages.</p>

<p>Examples:</p>

<ul>
<li><a href="https://inboxoro.com/email-for-otp">email for OTP</a></li>
<li><a href="https://inboxoro.com/receive-otp-online">receive OTP online</a></li>
</ul>

<h3>3. Free Trials</h3>

<p>Temporary email is useful for testing services without long-term commitment.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-free-trials">free trials</a></p>

<h3>4. Downloads and Resources</h3>

<p>Many websites require email access before downloads.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-downloads">downloads</a></p>

<h2>When You Should Use Real Email Instead</h2>

<p>Temporary email is useful for privacy, but it should not replace your main email completely.</p>

<p>Always use your real email for:</p>

<ul>
<li>Banking accounts</li>
<li>Business communication</li>
<li>Password recovery</li>
<li>Long-term subscriptions</li>
</ul>

<h2>Best Practices for Privacy</h2>

<ul>
<li>Use temporary email for low-risk activities</li>
<li>Do not share sensitive information</li>
<li>Separate personal and temporary usage</li>
<li>Use strong passwords for important accounts</li>
</ul>

<h2>Conclusion</h2>

<p>Protecting online privacy is becoming more important every year. Your email address connects many parts of your digital life, which is why using it carefully matters.</p>

<p>Temporary email helps reduce spam, protect personal identity, and limit unnecessary data sharing.</p>

<p>With tools like <strong>InboxOro</strong>, users can generate temporary email instantly and enjoy a cleaner, safer online experience.</p>

<p>Used correctly, temporary email becomes a practical and effective privacy tool for modern internet users.</p>
HTML;
} 
}