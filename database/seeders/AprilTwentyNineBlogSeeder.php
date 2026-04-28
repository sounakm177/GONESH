<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AprilTwentyNineBlogSeeder extends Seeder
{
    
    // php artisan db:seed --class=AprilTwentyNineBlogSeeder    
    
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
                'title'               => 'Why You Should Stop Using Your Real Email Everywhere',
                'slug'                => 'stop-using-real-email-everywhere',
                'excerpt'             => 'Still using your real email everywhere? Learn why it’s risky and how to protect your inbox with smarter alternatives.',
                'featured_image'      => 'stop-using-real-email.png',
                'featured_image_alt'  => 'Overloaded inbox with spam emails and notifications',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Stop Using Your Real Email Everywhere | InboxOro',
                'meta_description'    => 'Using your real email everywhere is risky. Learn how to protect privacy and reduce spam using temporary email.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['privacy', 'spam-protection', 'email-safety', 'temporary-email'],
                'body'                => $this->bodyStopRealEmail(),
            ],
        ];
    }

    private function bodyStopRealEmail(): string
{
    return <<<'HTML'
<p>Most people use their real email address for everything—social media, online shopping, free trials, downloads, and more. At first, this seems convenient. One email, one place, everything organized.</p>

<p>But over time, this habit creates serious problems.</p>

<p>Your inbox becomes overloaded with promotional emails, your personal data spreads across multiple platforms, and your privacy slowly decreases without you even noticing.</p>

<p>This raises an important question: <strong>should you really use your real email everywhere?</strong></p>

<p>The answer is simple: not always.</p>

<p>In this guide, we’ll explore why using your primary email for everything can be risky—and how smarter alternatives like <a href="https://inboxoro.com">InboxOro</a> can help you take control of your digital life.</p>

<h2>The Hidden Problem With Using Your Real Email Everywhere</h2>

<p>At first, sharing your email address feels harmless. You sign up for a website, verify your account, and move on. But every time you do this, your email gets stored in a database.</p>

<p>Over time, this creates a chain reaction.</p>

<h3>1. Your Email Gets Shared</h3>
<p>Many platforms store and sometimes share user data. Even if done legally, your email can end up in multiple systems.</p>

<h3>2. You Start Receiving More Emails</h3>
<p>Marketing emails, newsletters, and promotions begin to fill your inbox.</p>

<h3>3. Your Inbox Becomes Unmanageable</h3>
<p>Important emails get buried under unnecessary messages.</p>

<p>This is one of the main reasons users look for solutions like <a href="https://inboxoro.com/spam-free-email">spam free email</a>.</p>

<h2>Spam Is Only the Beginning</h2>

<p>Spam is the most visible problem—but not the most serious one.</p>

<p>Using your real email everywhere can also lead to:</p>

<ul>
<li>Unwanted tracking</li>
<li>Data exposure</li>
<li>Security risks</li>
</ul>

<p>Even a single data breach can expose your email address, which may then be used for phishing or other unwanted activities.</p>

<h2>Why Websites Ask for Your Email</h2>

<p>Most platforms require an email address for:</p>

<ul>
<li>Account verification</li>
<li>Communication</li>
<li>Marketing and updates</li>
</ul>

<p>While these reasons are valid, not every situation requires your primary email.</p>

<p>For users who want to use online services without long-term commitment, temporary email can be a practical alternative.</p>

<h2>A Smarter Approach: Use Temporary Email</h2>

<p>Instead of using your real email everywhere, you can use a temporary email for low-risk activities.</p>

<p>With tools like <a href="https://inboxoro.com/temporary-email">temporary email</a>, you can generate an email address instantly and use it for short-term needs.</p>

<p>This approach helps you:</p>

<ul>
<li>Protect your personal inbox</li>
<li>Avoid spam</li>
<li>Maintain privacy</li>
</ul>

<h2>When You Should NOT Use Your Real Email</h2>

<p>Here are situations where using your primary email may not be necessary:</p>

<h3>1. Free Trials</h3>
<p>Many services require email verification for trials.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-free-trials">temp email for free trials</a></p>

<h3>2. Social Media Signup</h3>
<p>Temporary email is commonly used for signup on platforms like:</p>

<ul>
<li><a href="https://inboxoro.com/temp-mail-for-instagram">Instagram</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-facebook">Facebook</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-twitter">Twitter</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-discord">Discord</a></li>
</ul>

<h3>3. Downloads and Resources</h3>
<p>Many websites require email access for downloads.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-downloads">temp email for downloads</a></p>

<h3>4. Coupons and Offers</h3>
<p>Temporary email is useful for accessing deals.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-coupons">temp email for coupons</a></p>

<h3>5. Surveys and Giveaways</h3>
<p>These often lead to follow-up emails.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-surveys">temp email for surveys</a></p>

<h2>When You SHOULD Use Your Real Email</h2>

<p>Your real email is still important for certain activities.</p>

<h3>1. Banking and Financial Accounts</h3>
<p>Always use a secure, permanent email.</p>

<h3>2. Work and Professional Communication</h3>
<p>Business interactions require reliability.</p>

<h3>3. Account Recovery</h3>
<p>Only real email ensures long-term access.</p>

<h2>Developers and Advanced Use Cases</h2>

<p>Temporary email is not just for casual users. Developers and QA teams also use it for testing.</p>

<p>Tools include:</p>

<ul>
<li><a href="https://inboxoro.com/email-testing-tool">Email testing tool</a></li>
<li><a href="https://inboxoro.com/email-sandbox-tool">Email sandbox tool</a></li>
<li><a href="https://inboxoro.com/developer-email-testing-tool">Developer email testing tool</a></li>
</ul>

<p>This helps simulate real-world email scenarios without using personal inboxes.</p>

<h2>How to Transition Smartly</h2>

<p>You don’t need to stop using your real email completely. Instead, use a balanced approach.</p>

<ul>
<li>Use real email for important accounts</li>
<li>Use temporary email for short-term tasks</li>
<li>Separate personal and temporary usage</li>
</ul>

<p>This approach gives you the best of both worlds.</p>

<h2>Conclusion</h2>

<p>Using your real email everywhere may seem convenient, but it comes with long-term drawbacks. From spam to privacy concerns, the risks add up over time.</p>

<p>By using temporary email for the right situations, you can protect your inbox, reduce unwanted messages, and maintain better control over your digital identity.</p>

<p><strong>InboxOro</strong> makes it easy to generate temporary email addresses instantly, giving you a smarter way to manage your online activity.</p>
HTML;
}
}