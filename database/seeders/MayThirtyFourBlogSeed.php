<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MayTwentyNineTwnetyFourBlogSeed extends Seeder
{
    
    // php artisan db:seed --class=MayTwentyNineTwnetyFourBlogSeed    
    
    public function run(): void
    {
        $service = app(BlogService::class);

        // ── Fetch category ids ────────────────────────────────────

        // BlogCategory::create([
        //     'name'       => 'Marketing',
        //     'slug'       => 'marketing',
        //     'color'      => '#33b208',
        //     'sort_order' => 7,
        // ]);

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
                'title'               => 'Anonymous Email for Secure Browsing in 2026',
                'slug'                => 'anonymous-email-for-secure-browsing',
                'excerpt'             => 'Learn how anonymous email services help users browse websites more privately while reducing spam and protecting personal inboxes.',
                'featured_image'      => 'anonymous-email-for-secure-browsing.png',
                'featured_image_alt'  => 'Secure anonymous email browsing dashboard on modern devices',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Anonymous Email for Secure Browsing in 2026',
                'meta_description'    => 'Use anonymous email for secure browsing, temporary signup, spam protection, and online privacy in 2026.',
                'status'              => 'published',
                'is_featured'         => false,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => [
                    'anonymous-email',
                    'temporary-email',
                    'privacy',
                    'secure-browsing'
                ],
                'body'                => $this->bodyAnonymousEmailForSecureBrowsing(),
            ],
        ];
    }
 
    
private function bodyAnonymousEmailForSecureBrowsing(): string
{
    return <<<'HTML'
<p>Online privacy has become increasingly important in 2026 as more websites, apps, and online services request email registration before allowing access to content or features.</p>

<p>Many internet users now prefer using anonymous email services for secure browsing, temporary registrations, and privacy-focused online activity.</p>

<p>Using a personal email address everywhere online can often lead to:</p>

<ul>
<li>Spam emails</li>
<li>Marketing overload</li>
<li>Privacy concerns</li>
<li>Inbox clutter</li>
<li>Tracking-related risks</li>
</ul>

<p>That is why many users now choose platforms like <strong>InboxOro</strong> to generate temporary inboxes for safer browsing workflows and online verification.</p>

<p>Anonymous email services help users keep personal inboxes protected while browsing websites, testing online services, signing up for free tools, and accessing temporary online platforms.</p>

<h2>What Is an Anonymous Email?</h2>

<p>An anonymous email is a temporary or privacy-focused email address commonly used for online activities where users prefer not to expose their permanent personal inbox.</p>

<p>These inboxes are commonly used for:</p>

<ul>
<li>Secure browsing</li>
<li>Temporary registrations</li>
<li>Online verification</li>
<li>Free trial signups</li>
<li>Spam prevention</li>
<li>Testing online services</li>
</ul>

<p>Helpful resources:</p>

<ul>
<li><a href="/anonymous-email-for-testing">anonymous email for testing</a></li>
<li><a href="/anonymous-email-for-verification">anonymous email for verification</a></li>
<li><a href="/anonymous-email-for-online-accounts">anonymous email for online accounts</a></li>
<li><a href="/secure-anonymous-email">secure anonymous email</a></li>
</ul>

<h2>Why Users Prefer Anonymous Email for Secure Browsing</h2>

<p>Many websites now require email registration before users can:</p>

<ul>
<li>Access content</li>
<li>Download files</li>
<li>Join communities</li>
<li>Start free trials</li>
<li>Use online tools</li>
</ul>

<p>Using an anonymous inbox helps reduce exposure of personal email addresses during temporary online activity.</p>

<p>This approach is commonly used for users who want to browse websites more privately while reducing long-term spam.</p>

<h2>Reduce Spam and Promotional Emails</h2>

<p>One of the most common reasons people use anonymous inboxes is spam reduction.</p>

<p>Many websites send:</p>

<ul>
<li>Marketing campaigns</li>
<li>Newsletters</li>
<li>Product promotions</li>
<li>Automated notifications</li>
<li>Third-party advertising emails</li>
</ul>

<p>Temporary inboxes help separate temporary online activity from important personal communication.</p>

<p>Helpful pages:</p>

<ul>
<li><a href="/secure-email-for-privacy">secure email for privacy</a></li>
<li><a href="/secure-disposable-email">secure disposable email</a></li>
<li><a href="/temp-mail-without-limits">temp mail without limits</a></li>
<li><a href="/temp-mail-without-restrictions">temp mail without restrictions</a></li>
</ul>

<h2>Anonymous Email for Verification Workflows</h2>

<p>Many users create temporary inboxes for verification workflows on websites and apps.</p>

<p>Anonymous inboxes can commonly receive:</p>

<ul>
<li>Verification emails</li>
<li>OTP codes</li>
<li>Activation links</li>
<li>Password reset emails</li>
<li>Temporary access emails</li>
</ul>

<p>This is commonly used for users who want quick verification access without sharing their primary inbox.</p>

<p>Helpful resources:</p>

<ul>
<li><a href="/anonymous-email-for-otp">anonymous email for otp</a></li>
<li><a href="/secure-email-for-verification">secure email for verification</a></li>
<li><a href="/fast-email-for-verification">fast email for verification</a></li>
<li><a href="/instant-email-for-otp">instant email for otp</a></li>
</ul>

<h2>Secure Browsing on Public Networks</h2>

<p>Users browsing on public Wi-Fi or shared networks often prefer anonymous inboxes for temporary online activity.</p>

<p>This helps reduce unnecessary exposure of personal contact information across multiple websites.</p>

<p>Privacy-focused users commonly use anonymous email services while:</p>

<ul>
<li>Traveling</li>
<li>Using public internet connections</li>
<li>Testing online platforms</li>
<li>Exploring new services</li>
<li>Registering on unfamiliar websites</li>
</ul>

<h2>Anonymous Email for Free Trials</h2>

<p>Many users use temporary inboxes for trying online services before committing long-term.</p>

<p>Anonymous email workflows are commonly used for:</p>

<ul>
<li>SaaS platform testing</li>
<li>Educational tools</li>
<li>Online productivity apps</li>
<li>Temporary subscriptions</li>
<li>Digital service evaluation</li>
</ul>

<p>Helpful pages:</p>

<ul>
<li><a href="/anonymous-email-for-free-trials">anonymous email for free trials</a></li>
<li><a href="/quick-email-for-signup">quick email for signup</a></li>
<li><a href="/instant-email-for-registration">instant email for registration</a></li>
<li><a href="/temp-mail-without-signup-required">temp mail without signup required</a></li>
</ul>

<h2>Developer and QA Testing Workflows</h2>

<p>Developers and QA teams frequently use anonymous inbox systems while testing applications and verification flows.</p>

<p>Common use cases include:</p>

<ul>
<li>Signup flow testing</li>
<li>Email delivery testing</li>
<li>OTP testing</li>
<li>Password recovery testing</li>
<li>Automation testing</li>
</ul>

<p>Temporary inboxes help developers create multiple test accounts quickly during application development.</p>

<p>Helpful resources:</p>

<ul>
<li><a href="/secure-email-for-testing">secure email for testing</a></li>
<li><a href="/fast-email-for-testing">fast email for testing</a></li>
<li><a href="/instant-temp-mail-generator">instant temp mail generator</a></li>
<li><a href="/quick-temporary-email">quick temporary email</a></li>
</ul>

<h2>Benefits of Temporary Anonymous Inbox Systems</h2>

<h3>Fast Inbox Generation</h3>

<p>Users can instantly generate temporary inboxes without complex registration workflows.</p>

<h3>Privacy Protection</h3>

<p>Anonymous email services help reduce unnecessary sharing of permanent email addresses.</p>

<h3>Reduced Inbox Clutter</h3>

<p>Temporary registrations remain separate from important personal communication.</p>

<h3>Quick Verification Access</h3>

<p>Users can receive temporary verification email and OTP codes rapidly.</p>

<h3>Improved Online Organization</h3>

<p>Separate inboxes help users organize testing, browsing, and temporary signups more efficiently.</p>

<h2>Why Many Users Choose InboxOro</h2>

<p>InboxOro helps users create temporary inboxes for secure browsing, online verification, spam prevention, developer testing, and temporary registrations.</p>

<p>The platform is commonly used for users who want:</p>

<ul>
<li>Fast temporary inbox generation</li>
<li>Privacy-focused browsing</li>
<li>Spam-free registrations</li>
<li>Secure verification workflows</li>
<li>Quick OTP access</li>
<li>Temporary online accounts</li>
</ul>

<p>InboxOro provides a clean and simple temporary inbox experience for modern internet users.</p>

<p>Helpful pages:</p>

<ul>
<li><a href="/secure-temp-mail-service">secure temp mail service</a></li>
<li><a href="/fast-temp-mail-service">fast temp mail service</a></li>
<li><a href="/temp-mail-without-phone">temp mail without phone</a></li>
<li><a href="/temp-mail-without-password">temp mail without password</a></li>
<li><a href="/temp-mail-without-delay">temp mail without delay</a></li>
<li><a href="/temp-mail-without-expiry-limit">temp mail without expiry limit</a></li>
</ul>

<h2>Frequently Asked Questions</h2>

<h3>Why do people use anonymous email services?</h3>

<p>Users commonly use anonymous inboxes for secure browsing, spam prevention, temporary registrations, and privacy-focused online activity.</p>

<h3>Can anonymous inboxes receive verification emails?</h3>

<p>Yes. Many temporary inbox systems support verification email, activation links, and OTP workflows.</p>

<h3>Are anonymous inboxes useful for developers?</h3>

<p>Developers commonly use temporary inboxes for testing applications, verification systems, and signup workflows.</p>

<h3>Do anonymous inboxes help protect privacy?</h3>

<p>Temporary inboxes help reduce exposure of permanent personal email addresses across multiple websites and online services.</p>

<h2>Conclusion</h2>

<p>Anonymous email services continue becoming more important as online privacy concerns grow in 2026.</p>

<p>From secure browsing and temporary registrations to developer testing and spam prevention, anonymous inbox systems provide practical privacy-focused solutions for modern internet users.</p>

<p>Platforms like <strong>InboxOro</strong> help users instantly create temporary inboxes for safer online browsing, verification workflows, and disposable online communication.</p>
HTML;
}
}