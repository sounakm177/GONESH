<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Support\Carbon;

class BlogPostTwentySixSeeder extends Seeder
{
    
    // php artisan db:seed --class=BlogPostTwentySixSeeder    

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
                'title'               => 'Disposable Email vs Real Email: Which One to Use?',
                'slug'                => 'disposable-vs-real-email',
                'excerpt'             => 'Compare disposable email vs real email. Learn when to use each, protect your privacy, and keep your inbox clean with InboxOro.',
                'featured_image'      => 'disposable-vs-real-email.png',
                'featured_image_alt'  => 'Comparison between temporary email and real email inbox',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Disposable Email vs Real Email | InboxOro Guide',
                'meta_description'    => 'Learn the difference between disposable and real email. Discover when to use each and protect your inbox with InboxOro.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['temporary-email', 'disposable-email', 'privacy', 'email-security', 'comparison'],
                'body'                => $this->bodyDisposableVsRealEmail(),
            ],
        ];
    }

   private function bodyDisposableVsRealEmail(): string
{
    return <<<'HTML'
<p>In today’s digital world, email has become a core part of how we sign up, communicate, and verify accounts online. But not all email usage needs are the same. Some situations require a long-term, reliable email address, while others benefit from short-term, disposable solutions.</p>

<p>This raises a common question: <strong>should you use a disposable email or a real email?</strong></p>

<p>The answer depends on your use case. In this guide, we will explore the differences between disposable email and real email, when to use each, and how tools like <strong>InboxOro</strong> can help you manage your online presence more effectively.</p>

<h2 id="what-is-disposable-email">What is Disposable Email?</h2>

<p>A disposable email is a temporary email address that can be used for a short period of time. It allows users to receive messages without creating a permanent account or sharing personal information.</p>

<p>Services like <a href="https://inboxoro.com/">InboxOro</a> provide instant access to temporary inboxes that can receive verification emails, OTPs, and notifications.</p>

<p>These email addresses typically expire after a certain time, and all messages are automatically removed.</p>

<h3>Common Uses</h3>
<ul>
<li>Quick account signups</li>
<li>Receiving verification codes</li>
<li>Testing applications</li>
<li>Avoiding spam emails</li>
</ul>

<h2 id="what-is-real-email">What is Real Email?</h2>

<p>A real email address is a permanent email account that you use for daily communication. It is usually linked to your identity and used for important activities.</p>

<p>Real email is commonly used for:</p>

<ul>
<li>Personal communication</li>
<li>Business and professional use</li>
<li>Account recovery and security</li>
<li>Long-term subscriptions</li>
</ul>

<p>Unlike disposable email, real email accounts store messages permanently and provide features like backup, recovery, and authentication.</p>

<h2 id="key-differences">Key Differences Between Disposable and Real Email</h2>

<table>
<tr>
<th>Feature</th>
<th>Disposable Email</th>
<th>Real Email</th>
</tr>
<tr>
<td>Duration</td>
<td>Short-term</td>
<td>Long-term</td>
</tr>
<tr>
<td>Privacy</td>
<td>High</td>
<td>Moderate</td>
</tr>
<tr>
<td>Storage</td>
<td>Temporary</td>
<td>Permanent</td>
</tr>
<tr>
<td>Use Case</td>
<td>Verification, testing</td>
<td>Communication, recovery</td>
</tr>
<tr>
<td>Security</td>
<td>Basic</td>
<td>Advanced</td>
</tr>
</table>

<h2 id="when-to-use-disposable">When to Use Disposable Email</h2>

<p>Disposable email is ideal for situations where you do not want to share your personal email address.</p>

<h3>1. Account Verification</h3>
<p>Many platforms require email verification. Using a temporary email helps you receive codes without exposing your primary inbox.</p>

<p>Example: <a href="https://inboxoro.com/blog/email-for-verification-code">email for verification code</a></p>

<h3>2. Social Media Signup</h3>
<p>Temporary email is commonly used for signup on platforms like 
<a href="https://inboxoro.com/blog/temp-mail-for-snapchat">Snapchat</a>, 
<a href="https://inboxoro.com/blog/temp-mail-for-telegram">Telegram</a>, and 
<a href="https://inboxoro.com/blog/temp-mail-for-linkedin">LinkedIn</a>.</p>

<h3>3. Testing and Development</h3>
<p>Developers often use temporary email for testing email flows.</p>

<p>Useful tools include:</p>
<ul>
<li><a href="https://inboxoro.com/developer-email-testing-tool">developer email testing tool</a></li>
<li><a href="https://inboxoro.com/email-sandbox-tool">email sandbox tool</a></li>
<li><a href="https://inboxoro.com/temp-email-for-qa">temporary email for QA</a></li>
</ul>

<h3>4. Coupons and Promotions</h3>
<p>Many users prefer temporary email for accessing offers without receiving long-term promotional emails.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-coupons">temporary email for coupons</a></p>

<h3>5. Student Access</h3>
<p>Temporary email can also be useful for accessing trial resources or tools.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-students">temporary email for students</a></p>

<h2 id="when-to-use-real">When to Use Real Email</h2>

<p>Real email should be used in situations that require reliability and long-term access.</p>

<h3>1. Important Accounts</h3>
<p>Banking, business, and primary accounts should always use a real email.</p>

<h3>2. Account Recovery</h3>
<p>Only a real email provides reliable recovery options.</p>

<h3>3. Professional Communication</h3>
<p>Work-related communication requires a stable and secure email address.</p>

<h3>4. Long-Term Subscriptions</h3>
<p>Services that you use regularly should be linked to your personal email.</p>

<h2 id="pros-cons">Pros and Cons</h2>

<h3>Disposable Email Pros</h3>
<ul>
<li>Protects privacy</li>
<li>Reduces spam</li>
<li>Instant setup</li>
</ul>

<h3>Disposable Email Cons</h3>
<ul>
<li>Short lifespan</li>
<li>Limited security</li>
<li>No recovery options</li>
</ul>

<h3>Real Email Pros</h3>
<ul>
<li>Reliable and secure</li>
<li>Long-term storage</li>
<li>Supports recovery</li>
</ul>

<h3>Real Email Cons</h3>
<ul>
<li>Can receive spam</li>
<li>Linked to personal identity</li>
</ul>

<h2 id="security-comparison">Security Comparison</h2>

<p>Disposable email provides basic privacy protection by hiding your real email. However, it is not designed for handling sensitive information.</p>

<p>Real email accounts offer stronger security features such as authentication and recovery systems.</p>

<p>For safe usage:</p>
<ul>
<li>Use disposable email for temporary access</li>
<li>Use real email for important accounts</li>
</ul>

<h2 id="best-practices">Best Practices</h2>

<ul>
<li>Use temporary email for low-risk activities</li>
<li>Keep your real email for essential services</li>
<li>Avoid sharing sensitive data on temporary inboxes</li>
<li>Use strong passwords for important accounts</li>
</ul>

<h2 id="conclusion">Conclusion</h2>

<p>Choosing between <strong>disposable email vs real email</strong> depends on your needs. Both have their place in modern digital usage.</p>

<p>Disposable email is perfect for short-term tasks, verification, and testing. Real email is essential for long-term communication and security.</p>

<p>By using both wisely, you can protect your privacy, reduce spam, and maintain a cleaner digital experience.</p>

<p><strong>InboxOro</strong> makes it easy to use temporary email whenever you need a quick and private solution.</p>
HTML;
}
}