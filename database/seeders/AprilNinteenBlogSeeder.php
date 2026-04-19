<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AprilNinteenBlogSeeder extends Seeder
{
    
    // php artisan db:seed --class=AprilNinteenBlogSeeder    
    
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
                'title'               => 'Temporary Email for LinkedIn Verification (Fast & Secure)',
                'slug'                => 'temp-mail-for-linkedin',
                'excerpt'             => 'Use a temporary email for LinkedIn verification. Receive OTP instantly, avoid spam, and protect your privacy without using your personal email.',
                'featured_image'      => 'temp-mail-linkedin.png',
                'featured_image_alt'  => 'Temporary email inbox used for LinkedIn verification code',
                'author_name'         => 'inboxOro Team',
                'meta_title'          => 'Temporary Email for LinkedIn Verification | inboxOro',
                'meta_description'    => 'Verify LinkedIn using a temporary email. Get OTP instantly, avoid spam, and keep your personal inbox secure.',
                'status'              => 'published',
                'is_featured'         => false,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['linkedin', 'temporary-email', 'verification-code', 'privacy', 'receive-otp'],
                'body'                => $this->bodyTempMailLinkedin(),
            ]
        ];
    }


    private function bodyTempMailLinkedin(): string
{
    return <<<'HTML'
<p>If you’re looking for a <strong>temporary email for LinkedIn verification</strong>, you’re probably trying to create or access an account without handing over your personal email. That’s a really smart and privacy-conscious move.</p>

<p>LinkedIn is the go-to professional network for millions of people. Like almost every other platform, it requires email verification during signup or when it does security checks. The downside? Your real email ends up stored, tracked, and sometimes hit with promotional emails you never asked for.</p>

<p>A temporary email keeps you in full control and your main inbox clean.</p>

<h2 id="why-use-temp-mail-linkedin">Why Use Temporary Email for LinkedIn?</h2>
<p>When you sign up with your real email, a few frustrating things usually happen:</p>
<ul>
<li>You start getting promotional emails and connection requests</li>
<li>Your data stays in their system long-term</li>
<li>Your inbox slowly gets cluttered with stuff you don’t need</li>
</ul>

<p>A <strong>temporary email for LinkedIn</strong> avoids all of that completely. You verify once and move on without any follow-up spam.</p>

<blockquote><strong>Quick Tip:</strong> Use a disposable email for one-time verification and protect your primary inbox.</blockquote>

<h2 id="how-to-use">How to Use Temporary Email for LinkedIn Verification</h2>
<p>The whole process is super simple and takes less than a minute:</p>
<ol>
<li>Open inboxOro</li>
<li>Generate a temporary email address instantly</li>
<li>Enter it on the LinkedIn signup page</li>
<li>Wait for the verification email to arrive in your inboxOro</li>
<li>Copy the OTP or click the verification link</li>
<li>Complete your account setup</li>
</ol>

<p>No signup. No personal details required. Just open and go.</p>

<h2 id="benefits">Benefits of Using Temp Mail for LinkedIn</h2>
<p>Here’s why this trick is so popular:</p>

<h3>Privacy Protection</h3>
<p>Your real email address stays completely hidden.</p>

<h3>No Spam</h3>
<p>The temporary inbox expires automatically, so spam never reaches you.</p>

<h3>Quick Verification</h3>
<p>You receive the verification email or OTP instantly.</p>

<h3>No Signup Required</h3>
<p>You can start using it immediately — zero account creation needed.</p>

<h2 id="use-cases">Common Use Cases</h2>
<ul>
<li>Creating secondary or “alt” LinkedIn accounts</li>
<li>Testing business tools or integrations</li>
<li>Accessing limited features or trial accounts</li>
</ul>

<h2 id="limitations">Limitations</h2>
<p>Temporary emails work great for quick tasks, but they’re not perfect for everything:</p>
<ul>
<li>The inbox expires and gets deleted automatically</li>
<li>Emails can’t be recovered later</li>
<li>Some platforms occasionally block known disposable domains</li>
</ul>

<p>For long-term professional use on LinkedIn, it’s usually better to switch to a real email later.</p>

<h2 id="is-it-safe">Is It Safe?</h2>
<p>Yes — perfectly safe for temporary or secondary accounts.</p>

<p>Just avoid using it for:</p>
<ul>
<li>Your primary LinkedIn account</li>
<li>Important business communication</li>
</ul>

<h2 id="seo">Why Temporary Email for LinkedIn Is Valuable</h2>
<p>Searches like <strong>temporary email for LinkedIn</strong>, “LinkedIn verification email”, and “LinkedIn OTP email” bring highly targeted users who are actively looking for a solution right now.</p>

<p>That makes this one of the strongest long-tail keywords in the temp-mail niche.</p>

<h2 id="faq">Frequently Asked Questions</h2>
<h3>Can I use temporary email for LinkedIn?</h3>
<p>Yes — it works for most verification steps, though some domains may occasionally get restricted.</p>

<h3>Is it free?</h3>
<p>Yes — completely free to use.</p>

<h3>Will I receive OTP instantly?</h3>
<p>Yes — in most cases the code or link arrives right away.</p>

<h3>Is it safe?</h3>
<p>Safe for temporary use, but not recommended for your main professional account.</p>

<h2 id="conclusion">Conclusion</h2>
<p>Using a <strong>temporary email for LinkedIn verification</strong> is a quick and effective way to protect your privacy while still getting your account set up fast.</p>

<p>It keeps spam away, stops unnecessary tracking, and lets you stay in control of your personal data.</p>

<p><strong>Ready to sign up privately? Open inboxOro right now and grab a fresh temporary email for LinkedIn — it takes literally 3 seconds.</strong></p>
HTML;
}

}