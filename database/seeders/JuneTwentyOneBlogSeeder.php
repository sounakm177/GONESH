<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JuneTwentyOneBlogSeeder extends Seeder
{
    

    // php artisan db:seed --class=JuneTwentyOneBlogSeeder    
    
    public function run(): void
    {
        $service = app(BlogService::class);

        // ── Fetch category ids ────────────────────────────────────

        // BlogCategory::create([
        //     'name'       => 'Verification',
        //     'slug'       => 'verification',
        //     'color'      => '#33b208',
        //     'sort_order' => 14,
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
                'blog_category_id'    => $cats['verification'],
                'title'               => 'Temporary Email for Verification and Account Registration',
                'slug'                => 'temporary-email-for-verification-and-account-registration',
                'excerpt'             => 'Learn how temporary email helps manage verification emails, OTP messages, account activation, and registration workflows.',
                'featured_image'      => 'temporary-email-for-verification-and-account-registration.png',
                'featured_image_alt'  => 'Email verification and account registration workflow',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Temporary Email for Verification and Account Registration',
                'meta_description'    => 'Discover how temporary email supports email verification, account activation, OTP delivery, and registration workflows.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => [
                    'temporary-email',
                    'email-verification',
                    'account-registration',
                    'otp-verification',
                    'disposable-email'
                ],
                'body'                => $this->bodyTemporaryEmailForVerificationAndAccountRegistration(),
            ],
        ];
    }
 
private function bodyTemporaryEmailForVerificationAndAccountRegistration(): string
{
    return <<<'HTML'
<p>Email verification has become a standard part of modern online registration workflows. Whether signing up for a productivity platform, software service, educational website, business tool, or online community, users are commonly asked to verify their email address before accessing features.</p>

<p>These verification processes help platforms confirm registrations, activate accounts, and improve account security. However, frequent registrations can also result in large numbers of verification emails, activation messages, newsletters, and promotional communications arriving in a primary inbox.</p>

<p><strong>InboxOro</strong> provides a temporary email service designed to help users receive verification emails while keeping short-term registrations separate from personal and business communications.</p>

<p>This guide explains how temporary email supports verification workflows, account activation processes, OTP reception, and registration management.</p>

<h2>Introduction</h2>

<p>Almost every online platform today requires some form of email confirmation. Before a new account becomes active, users are often asked to click a verification link, enter an OTP code, or confirm ownership of an email address.</p>

<p>Examples include:</p>

<ul>
<li>Software platforms</li>
<li>Business tools</li>
<li>Educational services</li>
<li>Online communities</li>
<li>Cloud applications</li>
<li>Digital marketplaces</li>
<li>Productivity platforms</li>
<li>Mobile applications</li>
</ul>

<p>These registrations frequently generate multiple emails during the onboarding process. Temporary email can help organize these communications more efficiently.</p>

<h2>Why This Matters</h2>

<p>Registration emails often arrive in large volumes, especially for users who regularly evaluate new services, test applications, or create accounts for legitimate business and development purposes.</p>

<p>A single registration may generate:</p>

<ul>
<li>Email verification requests</li>
<li>OTP codes</li>
<li>Account activation links</li>
<li>Welcome messages</li>
<li>Security alerts</li>
<li>Subscription confirmations</li>
<li>Product announcements</li>
</ul>

<p>Using a temporary inbox for short-term registrations can help reduce clutter in a primary inbox while maintaining organized access to verification messages.</p>

<h2>What Is a Temporary Email Service?</h2>

<p>A temporary email service provides a disposable inbox that can receive emails for a limited period.</p>

<p>These inboxes are commonly used for:</p>

<ul>
<li>Email verification</li>
<li>Account activation</li>
<li>OTP reception</li>
<li>Registration workflows</li>
<li>Developer testing</li>
<li>Software evaluations</li>
</ul>

<p>Temporary email is intended to support short-term registration activities rather than long-term account management.</p>

<h2>Key Benefits</h2>

<h3>Receive Verification Emails Quickly</h3>

<p>Many platforms require users to confirm their email address before granting access.</p>

<p>Temporary inboxes help users receive these messages efficiently.</p>

<h3>Reduce Inbox Clutter</h3>

<p>Separating registration emails from daily communications can improve inbox organization.</p>

<h3>Support Privacy-Focused Email Management</h3>

<p>Many users prefer keeping short-term signups separate from important personal or business email accounts.</p>

<h3>Useful for Software Testing</h3>

<p>Developers and QA teams often use temporary email services when testing registration and verification workflows.</p>

<h2>Email Verification Workflows</h2>

<p>Email verification is one of the most common uses of temporary email services.</p>

<p>Platforms typically send:</p>

<ul>
<li>Verification links</li>
<li>Confirmation emails</li>
<li>Activation messages</li>
<li>Security notifications</li>
<li>Registration confirmations</li>
</ul>

<p>Temporary inboxes help users access these communications without mixing them with ongoing personal correspondence.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/free-email-for-verification">Free Email for Verification</a></p>

<h2>Temporary Email for OTP Reception</h2>

<p>Many registration systems use one-time passwords (OTPs) to verify account ownership and improve security.</p>

<p>Temporary inboxes can receive email-based OTP messages used during account activation workflows.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/free-email-for-otp">Free Email for OTP</a></p>

<h2>Temporary Email for Registration Workflows</h2>

<p>Businesses, developers, students, and professionals frequently register for new tools and services.</p>

<p>Temporary inboxes can help organize verification messages generated during these registrations.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temporary-email-for-registration">Temporary Email for Registration</a></p>

<h2>Temporary Email for Account Creation</h2>

<p>Account creation commonly requires email confirmation before access is granted.</p>

<p>Temporary inboxes help users receive activation links and verification messages associated with legitimate registration processes.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temporary-email-for-account-creation">Temporary Email for Account Creation</a></p>

<h2>Temporary Email for Confirmation Emails</h2>

<p>Confirmation emails are often sent after registration to acknowledge successful account setup or service enrollment.</p>

<p>Temporary inboxes can help keep these communications separate from long-term email activity.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temporary-email-for-verification">Temporary Email for Verification</a></p>

<h2>Real-World Use Cases</h2>

<h3>Software Evaluation</h3>

<p>Users often test new productivity tools, SaaS platforms, and online services before deciding whether they meet their needs.</p>

<p>Temporary email can help organize registration-related communications during these evaluations.</p>

<h3>Developer Testing</h3>

<p>Development teams frequently validate registration systems, email verification flows, and onboarding experiences.</p>

<h3>Quality Assurance Workflows</h3>

<p>QA professionals commonly test activation links, confirmation emails, and password recovery processes.</p>

<h3>Educational Platforms</h3>

<p>Students and educators often create accounts on learning platforms that require email verification.</p>

<h3>Business Registrations</h3>

<p>Businesses frequently evaluate software products and online services that require account creation and email confirmation.</p>

<h2>Best Practices</h2>

<h3>Use Temporary Email for Short-Term Registrations</h3>

<p>Temporary inboxes are generally best suited for short-term verification and registration workflows.</p>

<h3>Use Permanent Email for Important Accounts</h3>

<p>Critical accounts and long-term services should typically remain connected to permanent email addresses.</p>

<h3>Verify Important Communications Promptly</h3>

<p>Activation links and verification codes may expire after a limited period.</p>

<h3>Follow Platform Policies</h3>

<p>Users should comply with applicable terms of service and registration requirements.</p>

<h2>Common Mistakes</h2>

<h3>Mixing Temporary Registrations With Business Communications</h3>

<p>Combining all registration emails into a single inbox can create unnecessary clutter.</p>

<h3>Ignoring Verification Deadlines</h3>

<p>Many activation links and OTP codes expire if not used promptly.</p>

<h3>Using Temporary Email for Long-Term Account Recovery</h3>

<p>Temporary inboxes are designed primarily for short-term verification workflows.</p>

<h3>Skipping Registration Testing</h3>

<p>Developers and QA teams should validate email verification systems thoroughly before deployment.</p>

<h2>How InboxOro Supports Verification Workflows</h2>

<p>InboxOro helps users receive:</p>

<ul>
<li>Email verification links</li>
<li>OTP codes</li>
<li>Registration confirmations</li>
<li>Activation emails</li>
<li>Security notifications</li>
<li>Account confirmation messages</li>
</ul>

<p>The platform is designed to support privacy-focused inbox management while helping users keep registration-related communications separate from everyday email activity.</p>

<h2>Frequently Asked Questions</h2>

<h3>Can temporary email receive verification emails?</h3>

<p>Yes. Temporary inboxes are commonly used to receive verification links, activation emails, and confirmation messages.</p>

<h3>Can temporary email receive OTP codes?</h3>

<p>Many email-based OTP systems can deliver one-time passwords to temporary inboxes.</p>

<h3>Is temporary email useful for registration workflows?</h3>

<p>Yes. Temporary inboxes are commonly used for short-term registration and verification activities.</p>

<h3>Can developers use temporary email for testing?</h3>

<p>Developers and QA teams frequently use temporary email services to validate email-related workflows.</p>

<h3>Is InboxOro affiliated with any third-party platform?</h3>

<p>No. All trademarks and brand names belong to their respective owners. InboxOro is not affiliated with, endorsed by, or sponsored by any third-party brand mentioned.</p>

<h2>Conclusion</h2>

<p>Email verification and account activation are important parts of modern online registration systems. From OTP delivery to confirmation emails and verification links, users frequently interact with email-based onboarding workflows.</p>

<p>InboxOro provides a practical temporary email solution for receiving verification messages, organizing registration-related communications, and supporting privacy-focused email management.</p>

<p>Whether you are evaluating software, testing applications, joining online communities, or registering for new services, temporary email can help keep your primary inbox cleaner while managing short-term verification activities more efficiently.</p>
HTML;
}
}