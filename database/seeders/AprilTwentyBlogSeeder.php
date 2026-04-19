<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Support\Carbon;

class AprilTwentyBlogSeeder extends Seeder
{
    
    // php artisan db:seed --class=AprilTwentyBlogSeeder    
    
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
                'title'               => 'Temporary Email for Snapchat Verification (Fast & Free)',
                'slug'                => 'temp-mail-for-snapchat',
                'excerpt'             => 'Use a temporary email for Snapchat verification. Receive OTP instantly, avoid spam, and protect your privacy without using your personal email.',
                'featured_image'      => 'temp-mail-snapchat.png',
                'featured_image_alt'  => 'Temporary email inbox receiving Snapchat verification code',
                'author_name'         => 'inboxOro Team',
                'meta_title'          => 'Temporary Email for Snapchat Verification | inboxOro',
                'meta_description'    => 'Verify Snapchat using a temporary email. Get OTP instantly, avoid spam, and protect your real inbox.',
                'status'              => 'published',
                'is_featured'         => false,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['snapchat', 'temporary-email', 'verification-code', 'receive-otp', 'privacy'],
                'body'                => $this->bodyTempMailSnapchat(),
            ]
        ];
    }


    private function bodyTempMailSnapchat(): string
{
    return <<<'HTML'
<p>If you’re looking for a <strong>temporary email for Snapchat verification</strong>, you’re probably trying to create or access an account without using your personal email. That’s a really smart move if you care about privacy.</p>

<p>Snapchat is one of the most popular social apps out there, and it usually requires email verification during signup or when it runs security checks. While it’s good for safety, it also means your real email can end up getting spam, tracked, or stored long-term.</p>

<p>A temporary email keeps everything private and your main inbox clean.</p>

<h2 id="why-use-temp-mail-snapchat">Why Use Temporary Email for Snapchat?</h2>
<p>When you sign up with your real email on social platforms like Snapchat, a few annoying things usually happen:</p>
<ul>
<li>You start getting promotional emails and random notifications</li>
<li>Your data stays stored in their system long-term</li>
<li>Your inbox slowly gets cluttered with stuff you don’t want</li>
</ul>

<p>A <strong>temporary email for Snapchat</strong> fixes all of that. You verify once and never have to deal with the follow-up spam.</p>

<blockquote><strong>Privacy Tip:</strong> Use a disposable email for one-time verification and avoid unnecessary exposure.</blockquote>

<h2 id="how-to-use">How to Use Temporary Email for Snapchat Verification</h2>
<p>The whole process is super quick and takes less than a minute:</p>
<ol>
<li>Open inboxOro</li>
<li>Generate a temporary email address instantly</li>
<li>Enter it during Snapchat signup</li>
<li>Wait for the verification email to land in your inboxOro</li>
<li>Copy the OTP or click the verification link</li>
<li>Complete your account setup</li>
</ol>

<p>No signup. No personal details. Just open and go.</p>

<h2 id="benefits">Benefits of Using Temp Mail for Snapchat</h2>
<p>Here’s why this trick is so popular:</p>

<h3>Protect Your Privacy</h3>
<p>Your real email address stays completely hidden.</p>

<h3>No Spam</h3>
<p>The temporary inbox expires automatically, so spam never reaches you.</p>

<h3>Instant Verification</h3>
<p>You receive OTPs or verification links in real time.</p>

<h3>No Registration Required</h3>
<p>You can start using it immediately — zero account creation needed.</p>

<h2 id="common-use-cases">Common Use Cases</h2>
<ul>
<li>Creating multiple or secondary Snapchat accounts</li>
<li>Testing apps, features, or bots</li>
<li>Joining communities or groups anonymously</li>
</ul>

<h2 id="limitations">Limitations</h2>
<p>Temporary emails are great for quick tasks, but they’re not perfect for everything:</p>
<ul>
<li>Emails are short-lived and get deleted automatically</li>
<li>The inbox is public (anyone with the address can see the messages)</li>
<li>Some platforms occasionally block known disposable domains</li>
</ul>

<p>For long-term or serious use, it’s better to switch to a real email later.</p>

<h2 id="is-it-safe">Is It Safe?</h2>
<p>Yes — perfectly safe for temporary and non-critical usage.</p>

<p>Just avoid using it for:</p>
<ul>
<li>Your primary social accounts</li>
<li>Storing any personal or sensitive data</li>
<li>Account recovery</li>
</ul>

<h2 id="seo">Why Temporary Email for Snapchat Is Important</h2>
<p>Searches like <strong>temporary email for Snapchat</strong>, “Snapchat verification email”, and “Snapchat OTP email” have really strong user intent. People searching these terms are actively looking for a solution right now.</p>

<p>That makes this page excellent for targeted traffic and conversions.</p>

<h2 id="faq">Frequently Asked Questions</h2>
<h3>Can I use temporary email for Snapchat?</h3>
<p>Yes — it works for most verification steps, though some domains may occasionally get restricted.</p>

<h3>Is it free?</h3>
<p>Yes — completely free to use.</p>

<h3>Will OTP arrive instantly?</h3>
<p>Yes — in most cases the code or link shows up right away.</p>

<h3>Is it safe?</h3>
<p>Safe for temporary use only. Not recommended for your main account.</p>

<h2 id="conclusion">Conclusion</h2>
<p>Using a <strong>temporary email for Snapchat verification</strong> is a simple and effective way to protect your privacy and avoid spam.</p>

<p>It lets you verify your account quickly while keeping your personal inbox completely clean.</p>

<p><strong>Ready to sign up privately? Open inboxOro right now and grab a fresh temporary email for Snapchat — it takes literally 3 seconds.</strong></p>
HTML;
}
}