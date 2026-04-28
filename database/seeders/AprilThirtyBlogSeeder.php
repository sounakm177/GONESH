<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AprilThirtyBlogSeeder extends Seeder
{
    
    // php artisan db:seed --class=AprilThirtyBlogSeeder    
    
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
                'title'               => 'How to Create Anonymous Email Without Registration',
                'slug'                => 'anonymous-email-without-registration',
                'excerpt'             => 'Learn how to create anonymous email without registration. Protect your identity and receive emails instantly.',
                'featured_image'      => 'anonymous-email.png',
                'featured_image_alt'  => 'Anonymous email privacy concept with secure communication',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Anonymous Email Without Registration | InboxOro',
                'meta_description'    => 'Create anonymous email instantly without signup. Stay private and avoid spam using InboxOro.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['anonymous-email', 'privacy', 'temporary-email', 'no-signup'],
                'body'                => $this->bodyAnonymousEmail(),
            ],
        ];
    }

   private function bodyAnonymousEmail(): string
{
    return <<<'HTML'
<p>In a world where almost every website asks for your email address, maintaining privacy online has become increasingly difficult. Whether you are signing up for a service, downloading a resource, or testing a platform, your email is often the first piece of information requested.</p>

<p>This is where anonymous email comes in.</p>

<p>If you are looking for a way to create an <strong>anonymous email without registration</strong>, you are not alone. Many users today prefer quick, private, and hassle-free solutions that do not require sharing personal details.</p>

<p>In this guide, we will explain how anonymous email works, why people use it, and how you can create one instantly using tools like <a href="https://inboxoro.com">InboxOro</a>.</p>

<h2>What is Anonymous Email?</h2>

<p>An anonymous email is an email address that is not linked to your personal identity. It allows you to receive messages without providing your name, phone number, or other personal information.</p>

<p>Unlike traditional email accounts, anonymous email does not require registration or verification steps.</p>

<p>It is commonly used for:</p>

<ul>
<li>Quick signups</li>
<li>Testing applications</li>
<li>Receiving verification codes</li>
<li>Protecting personal identity</li>
</ul>

<h2>Why Use Anonymous Email Without Registration?</h2>

<h3>1. Protect Your Privacy</h3>
<p>Your real email contains personal and professional information. Using an anonymous email keeps that data safe.</p>

<p>Learn more: <a href="https://inboxoro.com/privacy-email">privacy email</a></p>

<h3>2. Avoid Spam</h3>
<p>Many websites send marketing emails after signup. Anonymous email helps you avoid unwanted messages.</p>

<p>Example: <a href="https://inboxoro.com/avoid-spam-email">avoid spam email</a></p>

<h3>3. Instant Access</h3>
<p>No signup means no waiting. You can start using the email immediately.</p>

<h3>4. No Personal Data Required</h3>
<p>You don’t need to share your name, phone number, or any personal details.</p>

<h2>How to Create Anonymous Email Without Registration</h2>

<p>Creating an anonymous email using InboxOro is simple:</p>

<ol>
<li>Visit <a href="https://inboxoro.com">InboxOro</a></li>
<li>Get a temporary email instantly</li>
<li>Use it for signup or verification</li>
<li>Receive emails in real time</li>
</ol>

<p>No registration, no password, no setup.</p>

<h2>Where Anonymous Email is Commonly Used</h2>

<h3>1. Account Signup</h3>
<p>Anonymous email is commonly used for signup on platforms like:</p>

<ul>
<li><a href="https://inboxoro.com/temp-mail-for-instagram">Instagram</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-facebook">Facebook</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-twitter">Twitter</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-reddit">Reddit</a></li>
</ul>

<h3>2. Receiving Verification Codes</h3>
<p>Many users rely on anonymous email for OTP and verification.</p>

<ul>
<li><a href="https://inboxoro.com/email-for-otp">Email for OTP</a></li>
<li><a href="https://inboxoro.com/email-for-verification-code">Verification email</a></li>
</ul>

<h3>3. Free Trials</h3>
<p>Access services without long-term commitment.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-free-trials">free trials</a></p>

<h3>4. Downloads and Resources</h3>
<p>Many websites require email for downloads.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-downloads">downloads</a></p>

<h3>5. Testing and Development</h3>
<p>Developers use anonymous email for testing workflows.</p>

<ul>
<li><a href="https://inboxoro.com/email-testing-tool">email testing tool</a></li>
<li><a href="https://inboxoro.com/mock-email-service">mock email service</a></li>
</ul>

<h2>Benefits of Anonymous Email</h2>

<ul>
<li>Protects identity</li>
<li>Reduces spam</li>
<li>Quick and easy to use</li>
<li>No signup required</li>
</ul>

<h2>Limitations to Consider</h2>

<ul>
<li>Temporary access only</li>
<li>No password recovery</li>
<li>Not suitable for sensitive accounts</li>
</ul>

<h2>Best Practices</h2>

<ul>
<li>Use anonymous email for short-term tasks</li>
<li>Avoid sharing sensitive information</li>
<li>Use real email for important accounts</li>
</ul>

<h2>Conclusion</h2>

<p>Creating an <strong>anonymous email without registration</strong> is one of the easiest ways to protect your privacy online. It allows you to access services quickly while keeping your personal inbox secure.</p>

<p>With tools like <strong>InboxOro</strong>, you can generate a temporary email instantly and use it for a wide range of online activities.</p>

<p>Used wisely, anonymous email is a powerful tool for maintaining control over your digital identity.</p>
HTML;
}
}