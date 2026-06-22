<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JuneTwentyTwoBlogSeeder extends Seeder
{
    

    // php artisan db:seed --class=JuneTwentyTwoBlogSeeder    
    
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
                'title'               => 'Temporary Inbox for Verification Emails and OTP Codes',
                'slug'                => 'temporary-inbox-for-verification-emails-and-otp-codes',
                'excerpt'             => 'Learn how temporary inboxes help receive verification emails, OTP codes, activation links, and signup confirmations while keeping your primary inbox organized.',
                'featured_image'      => 'temporary-inbox-for-verification-emails-and-otp-codes.png',
                'featured_image_alt'  => 'Receiving verification emails and OTP codes using a temporary inbox',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Temporary Inbox for Verification Emails and OTP Codes',
                'meta_description'    => 'Discover how temporary inboxes help receive verification emails, activation links, OTP codes, and registration confirmations.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => [
                    'temporary-inbox',
                    'verification-email',
                    'otp-codes',
                    'email-verification',
                    'disposable-email'
                ],
                'body'                => $this->bodyTemporaryInboxForVerificationEmailsAndOtpCodes(),
            ],
        ];
    }
 
private function bodyTemporaryInboxForVerificationEmailsAndOtpCodes(): string
{
    return <<<'HTML'
<p>Email verification has become a standard part of online registration processes. Whether signing up for a new service, accessing a trial platform, joining a community, or testing an application, users are often required to verify their email address before gaining access.</p>

<p>These verification workflows typically involve activation links, confirmation messages, registration emails, and one-time passcodes (OTPs). As users interact with multiple platforms, verification-related emails can quickly accumulate in their primary inbox.</p>

<p><strong>InboxOro</strong> provides a temporary inbox designed to receive verification emails, OTP codes, activation messages, and registration confirmations while helping users keep short-term signups separate from important personal or business communications.</p>

<p>This guide explains how temporary inboxes work, their benefits, common use cases, and how they support modern verification workflows.</p>

<h2>Introduction</h2>

<p>Most websites, applications, and online services use email verification to confirm that a registration request comes from a valid email address. This process helps improve account security, reduce registration errors, and ensure users can receive important notifications.</p>

<p>Verification workflows commonly involve:</p>

<ul>
<li>Email verification links</li>
<li>One-time passwords (OTP)</li>
<li>Registration confirmations</li>
<li>Account activation emails</li>
<li>Security notifications</li>
<li>Login verification messages</li>
</ul>

<p>A temporary inbox provides a convenient way to receive these messages during short-term registration and testing activities.</p>

<h2>Why This Matters</h2>

<p>Many users register for online services every week. These registrations often trigger multiple emails, including welcome messages, onboarding guides, marketing campaigns, and security notifications.</p>

<p>Over time, inbox clutter can make it difficult to locate important personal and professional communications.</p>

<p>Using a temporary inbox for short-term registrations can help:</p>

<ul>
<li>Reduce inbox clutter</li>
<li>Organize verification emails</li>
<li>Separate temporary signups from long-term accounts</li>
<li>Manage registration-related communications</li>
<li>Support privacy-focused email management</li>
</ul>

<h2>What Is a Temporary Inbox?</h2>

<p>A temporary inbox is a disposable email inbox designed to receive emails for a limited period.</p>

<p>These inboxes are commonly used for:</p>

<ul>
<li>Email verification</li>
<li>OTP reception</li>
<li>Account activation</li>
<li>Software testing</li>
<li>Product evaluations</li>
<li>Short-term registrations</li>
</ul>

<p>Rather than replacing a permanent email account, temporary inboxes are generally used alongside existing email services for specific workflows.</p>

<h2>Key Benefits of Using a Temporary Inbox</h2>

<h3>Receive Verification Emails Quickly</h3>

<p>Most registrations require users to verify their email before accessing platform features. Temporary inboxes help receive these verification messages efficiently.</p>

<h3>Manage OTP Codes</h3>

<p>Many services use one-time passcodes as an additional verification step during registration or authentication processes.</p>

<h3>Reduce Inbox Clutter</h3>

<p>Temporary inboxes help separate short-term registrations from ongoing communications.</p>

<h3>Support Testing Environments</h3>

<p>Developers and QA teams often use temporary inboxes to validate email delivery systems and registration workflows.</p>

<h3>Organize Signup Activities</h3>

<p>Users evaluating multiple platforms can keep registration-related emails separate from everyday communications.</p>

<h2>Temporary Inbox for Verification Emails</h2>

<p>Email verification remains one of the most common account activation methods used by websites and applications.</p>

<p>Verification emails typically contain:</p>

<ul>
<li>Activation links</li>
<li>Confirmation buttons</li>
<li>Security notices</li>
<li>Registration confirmations</li>
</ul>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-inbox-for-verification">Temporary Inbox for Verification</a></p>

<h2>Temporary Inbox for OTP Codes</h2>

<p>Many platforms send OTP codes through email as part of account verification workflows.</p>

<p>These codes help confirm that users have access to the email address used during registration.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-inbox-for-otp">Temporary Inbox for OTP</a></p>

<h2>Temporary Inbox for Confirmation Emails</h2>

<p>Confirmation emails are frequently used to finalize registrations, subscriptions, and account setup processes.</p>

<p>Temporary inboxes help users receive these messages without adding additional clutter to their primary inbox.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-inbox-for-confirmation">Temporary Inbox for Confirmation</a></p>

<h2>Receive Verification Email Online</h2>

<p>Many users need a quick and convenient method for receiving email verification links when testing applications or registering for services.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/receive-verification-email-online">Receive Verification Email Online</a></p>

<h2>Receive Activation Emails</h2>

<p>Activation emails allow users to complete registration processes and access platform features.</p>

<p>Temporary inboxes are commonly used to receive these activation messages.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/receive-activation-email">Receive Activation Email</a></p>

<h2>Real-World Use Cases</h2>

<h3>Software Evaluations</h3>

<p>Users often test software platforms before making purchasing decisions. Temporary inboxes help manage the verification emails associated with these evaluations.</p>

<h3>Developer Testing</h3>

<p>Developers frequently test registration systems, password reset functionality, and email verification workflows.</p>

<h3>Quality Assurance</h3>

<p>QA engineers use temporary inboxes to validate email delivery, account activation, and onboarding processes.</p>

<h3>Online Learning Platforms</h3>

<p>Educational services often require account verification before users can access courses and resources.</p>

<h3>Business Tools</h3>

<p>Organizations evaluating business software may use temporary inboxes to organize trial registrations and verification emails.</p>

<h2>Best Practices</h2>

<h3>Use Temporary Inboxes for Short-Term Registrations</h3>

<p>Temporary inboxes are most useful for registrations, testing, evaluations, and trial signups.</p>

<h3>Maintain Permanent Email for Long-Term Services</h3>

<p>Important accounts should typically remain connected to permanent email addresses.</p>

<h3>Review Platform Requirements</h3>

<p>Users should follow applicable terms of service and registration requirements.</p>

<h3>Keep Verification Activities Organized</h3>

<p>Separating registration-related communications from primary inboxes can improve email management.</p>

<h2>Common Mistakes</h2>

<h3>Using a Primary Inbox for Every Registration</h3>

<p>Frequent registrations can generate large numbers of verification and promotional emails.</p>

<h3>Ignoring Verification Messages</h3>

<p>Many services require activation before account access is granted.</p>

<h3>Overlooking Security Notifications</h3>

<p>Users should review important verification-related emails during registration processes.</p>

<h3>Using Temporary Email for Long-Term Account Recovery</h3>

<p>Permanent email accounts are generally more suitable for long-term account management.</p>

<h2>How InboxOro Helps</h2>

<p>InboxOro provides temporary inboxes designed to receive:</p>

<ul>
<li>Verification emails</li>
<li>OTP codes</li>
<li>Registration confirmations</li>
<li>Activation emails</li>
<li>Login verification messages</li>
<li>Account-related notifications</li>
</ul>

<p>The service helps users organize temporary registrations while supporting privacy-focused email management and reducing unwanted inbox clutter.</p>

<h2>Frequently Asked Questions</h2>

<h3>Can a temporary inbox receive verification emails?</h3>

<p>Yes. Temporary inboxes are commonly used to receive verification links and account activation messages.</p>

<h3>Can I receive OTP codes in a temporary inbox?</h3>

<p>Many email-based OTP messages can be delivered to temporary inboxes depending on the sending platform.</p>

<h3>Are temporary inboxes useful for software testing?</h3>

<p>Yes. Developers and QA teams often use temporary inboxes to validate registration and verification workflows.</p>

<h3>Can temporary inboxes help reduce spam exposure?</h3>

<p>Using temporary inboxes for short-term registrations may help reduce unwanted emails reaching your primary inbox.</p>

<h3>Is InboxOro affiliated with any website or platform?</h3>

<p>No. All trademarks and brand names belong to their respective owners. InboxOro is not affiliated with, endorsed by, or sponsored by any third-party brand mentioned.</p>

<h2>Conclusion</h2>

<p>Email verification and OTP workflows have become an important part of modern online registration systems. Managing these communications efficiently can improve inbox organization and simplify short-term signup activities.</p>

<p>InboxOro provides a practical temporary inbox solution for receiving verification emails, activation links, registration confirmations, and OTP codes while helping users maintain a cleaner primary inbox.</p>

<p>Whether you are testing software, evaluating services, registering for online platforms, or validating email workflows, a temporary inbox can be a useful tool for managing verification-related communications.</p>
HTML;
}
}