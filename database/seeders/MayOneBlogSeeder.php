<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MayOneBlogSeeder extends Seeder
{
    
    // php artisan db:seed --class=MayOneBlogSeeder    
    
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
                'title'               => 'Free Email for Verification Code (No Signup Required)',
                'slug'                => 'free-email-for-verification-code',
                'excerpt'             => 'Get a free email for verification codes instantly. No signup required. Receive OTPs securely with InboxOro.',
                'featured_image'      => 'email-verification-free.png',
                'featured_image_alt'  => 'Receiving verification code in a temporary email inbox',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Free Email for Verification Code | InboxOro',
                'meta_description'    => 'Receive verification codes instantly using free temporary email. No signup required with InboxOro.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['verification-email', 'otp', 'temporary-email', 'no-signup'],
                'body'                => $this->bodyFreeEmailVerification(),
            ],
        ];
    }

   private function bodyFreeEmailVerification(): string
{
    return <<<'HTML'
<p>Many online platforms require email verification before allowing access to their services. Whether you are signing up for a new account, testing an application, or accessing a free trial, receiving a verification code is often the first step.</p>

<p>But not everyone wants to use their personal email for every signup.</p>

<p>This is where a <strong>free email for verification code</strong> becomes useful. It allows you to receive OTPs and verification messages instantly without sharing your real email address.</p>

<p>In this guide, we will explain how it works, when to use it, and how you can get started instantly using <a href="https://inboxoro.com">InboxOro</a>.</p>

<h2>What is a Free Email for Verification Code?</h2>

<p>A free email for verification is a temporary email address that can receive messages such as OTPs, confirmation links, and verification codes.</p>

<p>Unlike traditional email accounts, it does not require registration or personal information.</p>

<p>You can generate one instantly using:</p>

<ul>
<li><a href="https://inboxoro.com/temporary-email-generator">temporary email generator</a></li>
<li><a href="https://inboxoro.com/fake-email-generator">fake email generator</a></li>
<li><a href="https://inboxoro.com/10-minute-email">10 minute email</a></li>
</ul>

<p>These tools are designed for quick and short-term use.</p>

<h2>Why Use a Free Email for Verification?</h2>

<h3>1. Protect Your Personal Email</h3>
<p>Using your real email everywhere increases the risk of spam and data exposure.</p>

<p>Learn more: <a href="https://inboxoro.com/protect-email-privacy">protect email privacy</a></p>

<h3>2. Avoid Spam</h3>
<p>Temporary email prevents your inbox from being filled with promotional messages.</p>

<p>Example: <a href="https://inboxoro.com/avoid-spam-email">avoid spam email</a></p>

<h3>3. Instant Access</h3>
<p>You can receive verification codes immediately without signup.</p>

<h3>4. No Registration Required</h3>
<p>No forms, no passwords, no personal data needed.</p>

<h2>How to Get a Free Email for Verification Code</h2>

<p>Using InboxOro is simple and fast:</p>

<ol>
<li>Go to <a href="https://inboxoro.com">InboxOro</a></li>
<li>Generate a temporary email instantly</li>
<li>Use it during signup</li>
<li>Receive the verification code in real time</li>
</ol>

<p>The entire process takes just a few seconds.</p>

<h2>Where You Can Use It</h2>

<p>A free verification email is commonly used for signup on platforms like:</p>

<ul>
<li><a href="https://inboxoro.com/temp-mail-for-discord">Discord</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-instagram">Instagram</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-facebook">Facebook</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-linkedin">LinkedIn</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-telegram">Telegram</a></li>
</ul>

<p>It is commonly used for verification purposes without long-term commitment.</p>

<h2>Use Cases</h2>

<h3>1. Account Registration</h3>
<p>Quick signup without exposing your real email.</p>

<h3>2. OTP Verification</h3>
<p>Receive codes instantly using:</p>

<ul>
<li><a href="https://inboxoro.com/email-for-otp">email for OTP</a></li>
<li><a href="https://inboxoro.com/receive-otp-online">receive OTP online</a></li>
</ul>

<h3>3. Testing Applications</h3>
<p>Developers use temporary email for testing email workflows.</p>

<ul>
<li><a href="https://inboxoro.com/email-testing-tool">email testing tool</a></li>
<li><a href="https://inboxoro.com/email-sandbox-tool">email sandbox tool</a></li>
</ul>

<h3>4. Free Trials</h3>
<p>Access services without long-term commitment.</p>

<p>Example: <a href="https://inboxoro.com/temp-email-for-free-trials">free trials</a></p>

<h2>Benefits</h2>

<ul>
<li>Free and instant access</li>
<li>No registration required</li>
<li>Protects privacy</li>
<li>Reduces spam</li>
</ul>

<h2>Limitations</h2>

<ul>
<li>Temporary access only</li>
<li>No account recovery</li>
<li>Not suitable for sensitive accounts</li>
</ul>

<h2>Best Practices</h2>

<ul>
<li>Use for short-term verification only</li>
<li>Avoid sensitive information</li>
<li>Use real email for important accounts</li>
</ul>

<h2>Conclusion</h2>

<p>A <strong>free email for verification code</strong> is a simple and effective way to access online services without sharing your personal email address.</p>

<p>It helps protect your privacy, reduce spam, and speed up the signup process.</p>

<p>With <strong>InboxOro</strong>, you can generate a temporary email instantly and receive verification codes in seconds.</p>

<p>Used wisely, it is a powerful tool for managing your online experience safely and efficiently.</p>
HTML;
}
}