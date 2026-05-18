<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MayNineTeenBlogSeeder extends Seeder
{
    
    // php artisan db:seed --class=MayNineTeenBlogSeeder    
    
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
                'title'               => 'How to Create Email Without Phone Number',
                'slug'                => 'create-email-without-phone-number',
                'excerpt'             => 'Learn how users create email accounts without phone verification while improving online privacy and reducing spam.',
                'featured_image'      => 'create-email-without-phone-number.png',
                'featured_image_alt'  => 'Anonymous email without phone number verification',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Create Email Without Phone Number',
                'meta_description'    => 'Discover privacy-focused ways to create email without phone verification using temporary email tools.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => [
                    'anonymous-email',
                    'privacy-email',
                    'temporary-email',
                    'no-phone-verification'
                ],
                'body'                => $this->bodyCreateEmailWithoutPhoneNumber(),
            ],
        ];
    }
 
    
    private function bodyCreateEmailWithoutPhoneNumber(): string
{
    return <<<'HTML'
<p>Creating an email account without sharing a personal phone number has become an important privacy concern for many internet users in 2026. People are now more aware of how frequently personal information is collected during online registrations, app signups, free trials, and digital services.</p>

<p>Many websites and online platforms request phone verification as part of account creation. While verification systems are designed for security purposes, some users prefer not to connect their private mobile number to every online account they create.</p>

<p>This is why interest in privacy-focused email solutions and temporary email services continues to grow rapidly.</p>

<p>Services like <a href="https://inboxoro.com">InboxOro</a> help users create temporary inboxes instantly for short-term registrations, verification emails, testing workflows, and online privacy protection.</p>

<p>This guide explains how users create email accounts without phone numbers, why temporary email has become popular, and how disposable inboxes help reduce spam exposure while improving digital privacy.</p>

<h2>Why Users Want Email Without Phone Number Verification</h2>

<p>Modern internet users are becoming increasingly careful about sharing personal information online.</p>

<p>Phone numbers are often connected to:</p>

<ul>
<li>Personal identity</li>
<li>Location data</li>
<li>Advertising systems</li>
<li>Account recovery profiles</li>
<li>Marketing databases</li>
</ul>

<p>Some users simply prefer keeping their private mobile number separate from temporary registrations and low-priority online accounts.</p>

<p>Others want to avoid:</p>

<ul>
<li>Marketing calls</li>
<li>SMS spam</li>
<li>Promotional campaigns</li>
<li>Unwanted account tracking</li>
<li>Privacy concerns</li>
</ul>

<p>This is one reason why temporary email services are now commonly used for short-term online activities.</p>

<h2>What Is a Temporary Email?</h2>

<p>A temporary email is a disposable inbox that allows users to receive emails instantly without creating a permanent account.</p>

<p>Temporary inboxes are commonly used for:</p>

<ul>
<li>Verification emails</li>
<li>OTP codes</li>
<li>Free trial registrations</li>
<li>Testing workflows</li>
<li>Anonymous signups</li>
<li>Privacy-focused browsing</li>
</ul>

<p>Helpful resources include:</p>

<ul>
<li><a href="https://inboxoro.com/free-temp-mail-no-signup">free temp mail no signup</a></li>
<li><a href="https://inboxoro.com/free-temp-mail-no-login">free temp mail no login</a></li>
<li><a href="https://inboxoro.com/how-to-create-temp-email">how to create temp email</a></li>
<li><a href="https://inboxoro.com/best-temporary-email-service">best temporary email service</a></li>
</ul>

<h2>How Temporary Email Helps Protect Privacy</h2>

<p>Temporary email reduces how often users expose their personal inbox online.</p>

<p>Instead of sharing a primary email address everywhere, users can create disposable inboxes for short-term registrations.</p>

<p>This helps reduce:</p>

<ul>
<li>Spam emails</li>
<li>Marketing newsletters</li>
<li>Promotional campaigns</li>
<li>Data collection exposure</li>
<li>Inbox clutter</li>
</ul>

<p>Helpful privacy pages:</p>

<ul>
<li><a href="https://inboxoro.com/protect-email-privacy">protect email privacy</a></li>
<li><a href="https://inboxoro.com/privacy-email">privacy email</a></li>
<li><a href="https://inboxoro.com/protect-identity-with-temp-email">protect identity with temp email</a></li>
<li><a href="https://inboxoro.com/email-privacy-for-online-accounts">email privacy for online accounts</a></li>
</ul>

<h2>Common Use Cases for Temporary Email</h2>

<h3>1. Free Trial Registrations</h3>

<p>Many users test software products and online platforms before committing to long-term subscriptions.</p>

<p>Temporary inboxes help users receive verification emails without exposing their personal inbox to future marketing campaigns.</p>

<p>Useful resources:</p>

<ul>
<li><a href="https://inboxoro.com/temp-email-for-free-trials">temp email for free trials</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-saas-signup">temp mail for SaaS signup</a></li>
<li><a href="https://inboxoro.com/temp-email-for-online-business">temp email for online business</a></li>
</ul>

<h3>2. Social Media and Community Platforms</h3>

<p>Temporary email is commonly used for users who want to create short-term accounts on community and social platforms.</p>

<p>Helpful pages:</p>

<ul>
<li><a href="https://inboxoro.com/temp-mail-for-facebook">temp mail for Facebook</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-linkedin">temp mail for LinkedIn</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-quora">temp mail for Quora</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-pinterest">temp mail for Pinterest</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-telegram">temp mail for Telegram</a></li>
</ul>

<p>These pages are intended for users who want to use temporary email during online registrations and verification workflows.</p>

<h3>3. Online Shopping and Ecommerce</h3>

<p>Many ecommerce websites request account creation before discounts, coupons, or promotions become available.</p>

<p>Temporary email helps users protect their inbox from future marketing spam.</p>

<p>Helpful pages:</p>

<ul>
<li><a href="https://inboxoro.com/temp-email-for-online-shopping">temp email for online shopping</a></li>
<li><a href="https://inboxoro.com/temp-email-for-coupons">temp email for coupons</a></li>
<li><a href="https://inboxoro.com/temp-email-for-giveaways">temp email for giveaways</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-flipkart">temp mail for Flipkart</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-alibaba">temp mail for Alibaba</a></li>
</ul>

<h3>4. Developers and QA Testing</h3>

<p>Developers often test signup systems, email workflows, and onboarding automation using temporary inboxes.</p>

<p>Useful pages:</p>

<ul>
<li><a href="https://inboxoro.com/temp-email-for-testers">temp email for testers</a></li>
<li><a href="https://inboxoro.com/temp-email-for-developers">temp email for developers</a></li>
<li><a href="https://inboxoro.com/mock-email-service">mock email service</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-api-testing">temp mail for API testing</a></li>
<li><a href="https://inboxoro.com/temp-mail-for-github">temp mail for GitHub</a></li>
</ul>

<h2>Can Temporary Email Receive OTP and Verification Codes?</h2>

<p>Yes. Many temporary inboxes support receiving verification messages and one-time passwords for short-term access.</p>

<p>Helpful pages:</p>

<ul>
<li><a href="https://inboxoro.com/receive-otp-online">receive OTP online</a></li>
<li><a href="https://inboxoro.com/email-for-otp">email for OTP</a></li>
<li><a href="https://inboxoro.com/how-to-get-free-email-for-otp">how to get free email for OTP</a></li>
<li><a href="https://inboxoro.com/how-to-receive-verification-email-online">receive verification email online</a></li>
<li><a href="https://inboxoro.com/best-email-for-verification-codes">best email for verification codes</a></li>
</ul>

<h2>Temporary Email vs Permanent Email</h2>

<p>Temporary email and permanent email serve different purposes.</p>

<p>Permanent email is best for:</p>

<ul>
<li>Banking</li>
<li>Business communication</li>
<li>Personal identity</li>
<li>Long-term account recovery</li>
</ul>

<p>Temporary email is commonly used for:</p>

<ul>
<li>Short-term signups</li>
<li>Testing workflows</li>
<li>Verification emails</li>
<li>Privacy-focused registrations</li>
</ul>

<p>Comparison pages:</p>

<ul>
<li><a href="https://inboxoro.com/temp-mail-vs-gmail">temp mail vs gmail</a></li>
<li><a href="https://inboxoro.com/temp-mail-vs-permanent-email">temp mail vs permanent email</a></li>
<li><a href="https://inboxoro.com/temp-mail-vs-protonmail">temp mail vs protonmail</a></li>
<li><a href="https://inboxoro.com/temp-mail-vs-email-alias">temp mail vs email alias</a></li>
</ul>

<h2>Best Practices When Using Temporary Email</h2>

<p>Temporary email is best used for low-risk and short-term online activities.</p>

<ul>
<li>Use permanent email for important personal accounts</li>
<li>Avoid storing sensitive information in disposable inboxes</li>
<li>Use temporary inboxes for signups and testing</li>
<li>Do not rely on temporary inboxes for critical account recovery</li>
</ul>

<h2>Why Many Users Choose InboxOro</h2>

<p>InboxOro helps users instantly generate temporary inboxes for safer online registrations and privacy-focused browsing.</p>

<p>Users commonly use InboxOro for:</p>

<ul>
<li>Temporary signups</li>
<li>Verification emails</li>
<li>Online privacy</li>
<li>Spam reduction</li>
<li>Testing workflows</li>
</ul>

<p>Helpful resources include:</p>

<ul>
<li><a href="https://inboxoro.com/best-anonymous-email-provider">best anonymous email provider</a></li>
<li><a href="https://inboxoro.com/best-fake-email-generator-free">best fake email generator free</a></li>
<li><a href="https://inboxoro.com/secure-email-with-temp-mail">secure email with temp mail</a></li>
<li><a href="https://inboxoro.com/temp-mail-with-secure-inbox">temp mail with secure inbox</a></li>
<li><a href="https://inboxoro.com/temp-mail-with-instant-access">temp mail with instant access</a></li>
</ul>

<h2>Frequently Asked Questions</h2>

<h3>Is temporary email legal?</h3>

<p>Temporary email services are legal in most regions when used responsibly and for lawful purposes.</p>

<h3>Can temporary email help reduce spam?</h3>

<p>Yes. Disposable inboxes help reduce marketing emails and unwanted newsletters reaching your primary inbox.</p>

<h3>Is temporary email safe for important accounts?</h3>

<p>Important financial and personal accounts should always use secure permanent email addresses.</p>

<h2>Conclusion</h2>

<p>Creating email accounts without sharing a personal phone number has become increasingly important for users who care about online privacy and spam reduction.</p>

<p>Temporary email services help users receive verification emails while reducing unnecessary exposure of personal contact information.</p>

<p>With platforms like <strong>InboxOro</strong>, users can instantly create disposable inboxes for safer, cleaner, and more privacy-focused online registrations.</p>
HTML;
}

}