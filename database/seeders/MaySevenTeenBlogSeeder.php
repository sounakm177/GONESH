<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MayFifteenBlogSeeder extends Seeder
{
    
    // php artisan db:seed --class=MayFifteenBlogSeeder    
    
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
                'blog_category_id'    => $cats['developer'],
                'title'               => 'How Developers Use Temporary Email for Testing',
                'slug'                => 'developers-use-temp-email-testing',
                'excerpt'             => 'Learn how developers use temporary email for QA testing, email verification, and application workflows.',
                'featured_image'      => 'developer-temp-email-testing.png',
                'featured_image_alt'  => 'Developer testing email workflow using temporary inbox',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Temporary Email for Developer Testing Guide',
                'meta_description'    => 'Discover how developers use temporary email for QA, testing, verification, and sandbox workflows.',
                'status'              => 'published',
                'is_featured'         => false,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => ['developer-tools', 'email-testing', 'temporary-email', 'qa-testing'],
                'body'                => $this->bodyDeveloperTempEmailTesting(),
            ],
        ];
    }

private function bodyDeveloperTempEmailTesting(): string
{
    return <<<'HTML'
<p>Email functionality is one of the most important parts of modern applications. From user registration and password recovery to OTP verification and notifications, almost every platform depends on email workflows.</p>

<p>For developers, testing these systems properly is essential.</p>

<p>This is where temporary email services become extremely useful.</p>

<p>Instead of using personal inboxe repeatedly during development, many developers use temporary email tools to simplify testing, improve workflow efficiency, and maintain clean testing environments.</p>

<p>Platforms like <a href="https://inboxoro.com">InboxOro</a> provide instant temporary email access that can help developers test applications safely and efficiently.</p>

<h2>Why Email Testing Matters</h2>

<p>Email workflows are often critical to user experience.</p>

<p>Common examples include:</p>

<ul>
<li>Account verification</li>
<li>Password reset emails</li>
<li>OTP delivery</li>
<li>Welcome messages</li>
<li>Transactional notifications</li>
</ul>

<p>If these systems fail, users may not be able to access important parts of an application.</p>

<p>Proper testing helps developers identify problems early.</p>

<h2>Challenges Developers Face During Email Testing</h2>

<p>Testing email systems using personal inboxes can quickly become frustrating.</p>

<p>Common issues include:</p>

<ul>
<li>Inbox clutter</li>
<li>Repeated registrations</li>
<li>Managing multiple accounts</li>
<li>Spam filtering problems</li>
<li>Testing delays</li>
</ul>

<p>Temporary email solves many of these challenges.</p>

<h2>What is Temporary Email?</h2>

<p>A temporary email is disposable email address designed for short-term usage.</p>

<p>It allows developers to receive emails instantly without creating permanent accounts.</p>

<p>Examples include:</p>

<ul>
<li><a href="https://inboxoro.com/temporary-email">temporary email</a></li>
<li><a href="https://inboxoro.com/fake-email-for-testing">fake email for testing</a></li>
<li><a href="https://inboxoro.com/temporary-email-for-testing">temporary email for testing</a></li>
</ul>

<h2>How Developers Use Temporary Email</h2>

<h3>1. Registration Flow Testing</h3>

<p>Developers frequently test signup systems.</p>

<p>Temporary email allows repeated account creation without managing multiple personal inboxes.</p>

<h3>2. OTP Verification Testing</h3>

<p>Applications often send verification codes through email.</p>

<p>Useful pages:</p>

<ul>
<li><a href="https://inboxoro.com/email-for-otp">email for OTP</a></li>
<li><a href="https://inboxoro.com/receive-otp-online">receive OTP online</a></li>
</ul>

<p>Developers can quickly verify whether OTP workflows function correctly.</p>

<h3>3. QA and Staging Environment Testing</h3>

<p>QA teams commonly use temporary inboxes while testing staging applications.</p>

<p>Example tools:</p>

<ul>
<li><a href="https://inboxoro.com/temp-email-for-qa">temp email for QA</a></li>
<li><a href="https://inboxoro.com/email-sandbox-tool">email sandbox tool</a></li>
</ul>

<h3>4. API and Automation Testing</h3>

<p>Developers testing APIs often need temporary inboxes for automated workflows.</p>

<p>Example: <a href="https://inboxoro.com/temp-mail-for-api-testing">API testing</a></p>

<h3>5. SaaS Signup Testing</h3>

<p>Temporary email helps developers simulate real user onboarding flows.</p>

<p>Example: <a href="https://inboxoro.com/temp-mail-for-saas-signup">SaaS signup</a></p>

<h2>Benefits of Temporary Email for Developers</h2>

<h3>1. Faster Testing</h3>

<p>Developers can instantly generate inboxes without registration.</p>

<h3>2. Cleaner Workflow</h3>

<p>No need to manage multiple personal accounts.</p>

<h3>3. Better Isolation</h3>

<p>Each test flow can use unique inbox.</p>

<h3>4. Reduced Spam</h3>

<p>Testing emails do not clutter real inboxes.</p>

<p>Learn more: <a href="https://inboxoro.com/avoid-spam-email">avoid spam email</a></p>

<h2>Temporary Email vs Traditional Testing Inbox</h2>

<p>Traditional inboxes are useful for long-term communication, but they can become difficult to manage during repetitive testing.</p>

<p>Temporary email is better suited for:</p>

<ul>
<li>Rapid testing</li>
<li>Disposable workflows</li>
<li>Automation</li>
<li>Short-term verification</li>
</ul>

<h2>Security Considerations</h2>

<p>Temporary email should not be used for sensitive production accounts.</p>

<p>Developers should avoid using disposable inboxes for:</p>

<ul>
<li>Confidential company data</li>
<li>Financial systems</li>
<li>Permanent administrator accounts</li>
</ul>

<p>Temporary email works best for testing environments and non-sensitive workflows.</p>

<h2>Best Practices for Developers</h2>

<ul>
<li>Use separate inboxes for different test cases</li>
<li>Automate email testing when possible</li>
<li>Combine temporary email with staging environments</li>
<li>Avoid storing sensitive information in disposable inboxes</li>
</ul>

<h2>Why InboxOro is Useful for Testing</h2>

<p>InboxOro provides instant temporary email access for developers who need fast and reliable inbox generation.</p>

<p>Useful tools include:</p>

<ul>
<li><a href="https://inboxoro.com/developer-email-testing-tool">developer email testing tool</a></li>
<li><a href="https://inboxoro.com/mock-email-service">mock email service</a></li>
<li><a href="https://inboxoro.com/email-testing-tool">email testing tool</a></li>
</ul>

<p>These tools help streamline testing workflows and improve efficiency.</p>

<h2>Conclusion</h2>

<p>Email testing is an essential part of application development. Temporary email helps developers simplify testing, avoid inbox clutter, and improve workflow efficiency.</p>

<p>From OTP verification and QA testing to API workflows and SaaS onboarding, temporary inboxes provide practical advantages for modern development teams.</p>

<p>With <strong>InboxOro</strong>, developers can instantly generate temporary inboxes and create cleaner, faster, and more flexible testing environments.</p>
HTML;
}
}