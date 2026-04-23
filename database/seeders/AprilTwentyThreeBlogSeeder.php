<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class AprilTwentyThreeBlogSeeder extends Seeder
{
    // php artisan db:seed --class=AprilTwentyThreeBlogSeeder    

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
                'title'               => 'Temp Mail for Pinterest Signup & Verification',
                'slug'                => 'temp-mail-for-pinterest',
                'excerpt'             => 'Use temp mail for Pinterest signup and verification. Receive emails instantly and keep your personal inbox private with InboxOro.',
                'featured_image'      => 'temp-mail-pinterest.png',
                'featured_image_alt'  => 'Temporary email inbox used for signup verification process',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Temp Mail for Pinterest Verification | InboxOro',
                'meta_description'    => 'Use temp mail for Pinterest verification. Get emails instantly and protect your real inbox with InboxOro.',
                'status'              => 'published',
                'is_featured'         => false,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => [
                    'pinterest',
                    'temporary-email',
                    'verification-email',
                    'privacy',
                    'signup'
                ],
                'body'                => $this->bodyTempMailPinterest(),
            ]
        ];
    }

    private function bodyTempMailPinterest(): string
{
    return <<<'HTML'
<p>If you want to sign up or explore a platform without sharing your personal email, using a <strong>temporary email for Pinterest signup</strong> can be a practical solution. Many users prefer to keep their main inbox private and free from unwanted messages.</p>

<p>A disposable email service like <strong>InboxOro</strong> helps you receive verification emails instantly without long-term exposure. It is simple, fast, and does not require registration.</p>

<h2 id="what-is-temp-mail">What is Temporary Email?</h2>

<p>Temporary email is a short-term email address that allows you to receive messages without using your real email. These inboxes are automatically deleted after a certain time.</p>

<p>It is commonly used for:</p>

<ul>
<li>Quick account signup</li>
<li>Email verification</li>
<li>Testing platforms</li>
<li>Avoiding spam emails</li>
</ul>

<h2 id="why-use-temp-mail">Why Use Temporary Email for Signup?</h2>

<p>Using your personal email for every online platform can lead to unnecessary clutter and exposure. Temporary email helps reduce that risk.</p>

<ul>
<li><strong>Privacy:</strong> Keeps your personal email safe</li>
<li><strong>No spam:</strong> Avoid marketing emails</li>
<li><strong>Instant access:</strong> Receive verification emails quickly</li>
<li><strong>Convenience:</strong> No signup required</li>
</ul>

<p>This method is commonly used for users who want to use online platforms without long-term commitment.</p>

<h2 id="how-to-use">How to Use Temporary Email for Verification</h2>

<p>Follow these steps:</p>

<ol>
<li>Open InboxOro and generate a temporary email</li>
<li>Enter it during signup</li>
<li>Wait for the verification email</li>
<li>Copy the code or click the link</li>
<li>Complete the signup process</li>
</ol>

<p>The entire process takes less than a minute.</p>

<h2 id="use-cases">Common Use Cases</h2>

<ul>
<li>Creating test or secondary accounts</li>
<li>Exploring platform features</li>
<li>Accessing gated content</li>
<li>Testing signup flows</li>
</ul>

<h2 id="benefits">Benefits of Using InboxOro</h2>

<h3>Instant Email Generation</h3>
<p>Get a working inbox immediately.</p>

<h3>Auto Deletion</h3>
<p>Emails are removed automatically after a short time.</p>

<h3>No Registration</h3>
<p>Use the service without creating an account.</p>

<h3>Clean Primary Inbox</h3>
<p>Your personal email remains free from spam.</p>

<h2 id="limitations">Limitations</h2>

<ul>
<li>Emails are not stored permanently</li>
<li>Not suitable for important accounts</li>
<li>Some platforms may restrict disposable emails</li>
</ul>

<p>For long-term usage, switching to a personal email is recommended.</p>

<h2 id="security">Security Tips</h2>

<ul>
<li>Avoid sharing sensitive information</li>
<li>Do not use for financial accounts</li>
<li>Use strong passwords</li>
</ul>

<h2 id="related-tools">Helpful Tools You Can Use</h2>

<p>If you want to use temporary email for different purposes, these tools from InboxOro can help:</p>

<ul>
<li><a href="https://inboxoro.com/temp-mail-for-instagram">Generate email for social media signup</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-twitter">Use disposable email for quick access</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-saas-signup">Access SaaS platforms without personal email</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-api-testing">Test email workflows easily</a></li>
</ul>

<p>These pages are designed for users who want fast, temporary access without long-term commitment.</p>

<h2 id="faq">Frequently Asked Questions</h2>

<h3>Can I use temp mail for verification?</h3>
<p>Yes, temporary email is commonly used to receive verification emails.</p>

<h3>Is InboxOro free?</h3>
<p>Yes, InboxOro provides free temporary email access.</p>

<h3>Do emails arrive instantly?</h3>
<p>In most cases, emails are delivered within seconds.</p>

<h3>Is it safe?</h3>
<p>Safe for short-term and non-sensitive use cases.</p>

<h2 id="conclusion">Conclusion</h2>

<p>Using a <strong>temporary email for Pinterest signup</strong> is a simple way to protect your privacy and avoid unnecessary emails. It allows you to explore platforms quickly while keeping your main inbox clean.</p>

<p>InboxOro makes temporary email accessible, fast, and easy to use for everyone.</p>
HTML;
}

}