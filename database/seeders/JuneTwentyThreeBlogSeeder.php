<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JuneTwentyThreeBlogSeeder extends Seeder
{
    

    // php artisan db:seed --class=JuneTwentyThreeBlogSeeder    
    
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
                'blog_category_id'    => $cats['security'],
                'title'               => 'Temporary Email for Verification and Account Confirmation',
                'slug'                => 'temporary-email-for-verification-and-account-confirmation',
                'excerpt'             => 'Learn how temporary email helps manage verification emails, account confirmations, OTP messages, activation emails, and registration workflows.',
                'featured_image'      => 'temporary-email-for-verification-and-account-confirmation.png',
                'featured_image_alt'  => 'Email verification and account confirmation workflow',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Temporary Email for Verification and Account Confirmation',
                'meta_description'    => 'Discover how temporary email supports verification emails, OTP reception, account activation, and registration confirmation workflows.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => [
                    'temporary-email',
                    'verification-email',
                    'account-confirmation',
                    'otp-verification',
                    'disposable-inbox'
                ],
                'body'                => $this->bodyTemporaryEmailForVerificationAndAccountConfirmation(),
            ],
        ];
    }
 
private function bodyTemporaryEmailForVerificationAndAccountConfirmation(): string
{
    return <<<'HTML'
<p>Email verification has become a standard part of online account registration. Whether signing up for a business platform, productivity tool, educational service, mobile application, or online community, users are commonly asked to verify their email address before gaining access to platform features.</p>

<p>These verification workflows help platforms confirm account ownership, improve communication reliability, and support account security. However, frequent registrations can also lead to inbox clutter, promotional emails, and subscription notifications accumulating in a primary email account.</p>

<p><strong>InboxOro</strong> provides a temporary email service designed to help users receive verification emails, account confirmation messages, activation links, and registration notifications while keeping temporary registrations separate from important personal or business communications.</p>

<p>This guide explains how temporary email supports account verification workflows, confirmation emails, activation processes, and privacy-focused inbox management.</p>

<h2>Introduction</h2>

<p>Nearly every modern online service uses email verification as part of the registration process. Before users can access platform features, they may need to confirm ownership of an email address by clicking a verification link or entering a verification code.</p>

<p>Common examples include:</p>

<ul>
<li>Business platforms</li>
<li>Productivity software</li>
<li>Educational services</li>
<li>Developer tools</li>
<li>Online communities</li>
<li>Mobile applications</li>
<li>Cloud-based services</li>
<li>Subscription platforms</li>
</ul>

<p>As users evaluate multiple services, managing verification emails efficiently becomes increasingly important.</p>

<h2>Why This Matters</h2>

<p>Verification and confirmation emails serve an important role in modern digital systems.</p>

<p>They are commonly used for:</p>

<ul>
<li>Account activation</li>
<li>Email validation</li>
<li>Password recovery</li>
<li>Security notifications</li>
<li>Login verification</li>
<li>Registration confirmation</li>
<li>Subscription activation</li>
</ul>

<p>However, signing up for multiple services can create a large volume of incoming emails that may overwhelm a primary inbox.</p>

<p>Temporary inboxes help organize these communications and separate short-term registrations from everyday email usage.</p>

<h2>What Is a Temporary Email Service?</h2>

<p>A temporary email service provides a disposable inbox capable of receiving emails for a limited period.</p>

<p>Temporary inboxes are commonly used for:</p>

<ul>
<li>Email verification</li>
<li>Account activation</li>
<li>Registration testing</li>
<li>Developer workflows</li>
<li>Product evaluations</li>
<li>Temporary signups</li>
</ul>

<p>Rather than replacing a permanent email account, temporary email is intended to help organize short-term email communications.</p>

<h2>Key Benefits</h2>

<h3>Receive Verification Emails Quickly</h3>

<p>Most registration systems require users to verify their email address before activating an account.</p>

<p>Temporary inboxes can receive:</p>

<ul>
<li>Verification links</li>
<li>Activation emails</li>
<li>Registration confirmations</li>
<li>Security notifications</li>
<li>Email validation messages</li>
</ul>

<h3>Reduce Inbox Clutter</h3>

<p>Temporary registrations often generate onboarding campaigns, newsletters, promotions, and feature announcements.</p>

<p>Using a temporary inbox can help keep these communications separate from important emails.</p>

<h3>Support Privacy-Focused Email Management</h3>

<p>Many users prefer limiting the use of their primary email address when testing services or evaluating new platforms.</p>

<h3>Useful for Developer and QA Testing</h3>

<p>Developers and QA teams frequently validate email verification workflows during application testing.</p>

<h2>Temporary Email for Short-Term Verification</h2>

<p>Many registrations only require access to a verification email during the initial signup process.</p>

<p>Temporary inboxes are commonly used for these short-term verification workflows.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/email-for-short-term-verification">Email for Short-Term Verification</a></p>

<h2>Temporary Email for Account Confirmation</h2>

<p>Account confirmation emails help platforms validate registrations and activate user accounts.</p>

<p>Temporary inboxes provide a convenient way to receive these messages during temporary signups and product evaluations.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/email-for-account-confirmation">Email for Account Confirmation</a></p>

<h2>Disposable Inbox for OTP Verification</h2>

<p>Some services use OTP codes or one-time verification codes as part of registration and security workflows.</p>

<p>Temporary inboxes can receive email-based OTP messages when supported by the sending platform.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/disposable-inbox-for-otp">Disposable Inbox for OTP</a></p>

<h2>Disposable Inbox for Verification Emails</h2>

<p>Verification emails are among the most common email types generated during account creation.</p>

<p>Temporary inboxes help organize these messages efficiently.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/disposable-inbox-for-verification">Disposable Inbox for Verification</a></p>

<h2>Disposable Inbox for Account Activation</h2>

<p>Many online services require users to activate accounts through confirmation links sent by email.</p>

<p>Temporary inboxes provide access to these activation messages without affecting primary inbox organization.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/disposable-inbox-for-activation">Disposable Inbox for Activation</a></p>

<h2>Real-World Use Cases</h2>

<h3>Product Evaluations</h3>

<p>Users often test multiple platforms before selecting a solution that meets their requirements.</p>

<p>Temporary inboxes help manage registration-related emails during these evaluations.</p>

<h3>Developer Testing</h3>

<p>Software developers frequently validate email verification systems during application development.</p>

<h3>Quality Assurance Workflows</h3>

<p>QA teams commonly test activation emails, registration workflows, and account confirmation systems.</p>

<h3>Educational Platform Registrations</h3>

<p>Students and educators often explore online learning tools that require email verification.</p>

<h3>Business Tool Research</h3>

<p>Organizations frequently compare software solutions and receive multiple registration confirmations during evaluation processes.</p>

<h2>Email Verification Workflow Example</h2>

<table>
<thead>
<tr>
<th>Step</th>
<th>Purpose</th>
</tr>
</thead>
<tbody>
<tr>
<td>Create Account</td>
<td>Begin registration process</td>
</tr>
<tr>
<td>Receive Verification Email</td>
<td>Confirm email delivery</td>
</tr>
<tr>
<td>Open Verification Message</td>
<td>Access activation information</td>
</tr>
<tr>
<td>Complete Verification</td>
<td>Validate account ownership</td>
</tr>
<tr>
<td>Access Platform</td>
<td>Use platform features</td>
</tr>
</tbody>
</table>

<h2>Best Practices</h2>

<h3>Use Temporary Email for Short-Term Registrations</h3>

<p>Temporary inboxes are generally most useful for evaluation, testing, and temporary signup workflows.</p>

<h3>Maintain Permanent Emails for Important Accounts</h3>

<p>Business-critical services and long-term accounts should typically remain associated with permanent email addresses.</p>

<h3>Review Platform Requirements</h3>

<p>Users should comply with applicable platform policies and service requirements.</p>

<h3>Keep Verification Activities Organized</h3>

<p>Separating temporary registrations from everyday communications can improve inbox management.</p>

<h2>Common Mistakes</h2>

<h3>Using One Inbox for Every Registration</h3>

<p>Large numbers of registrations can generate significant email volume.</p>

<h3>Ignoring Verification Emails</h3>

<p>Many services require email confirmation before account access is granted.</p>

<h3>Mixing Evaluation Activities with Business Communications</h3>

<p>Keeping these activities separate often improves organization and efficiency.</p>

<h3>Using Temporary Email for Long-Term Account Recovery</h3>

<p>Temporary inboxes are generally intended for short-term verification and registration workflows.</p>

<h2>How InboxOro Supports Verification Workflows</h2>

<p>InboxOro helps users receive verification emails, activation messages, account confirmations, and registration notifications while maintaining a cleaner primary inbox.</p>

<p>Common use cases include:</p>

<ul>
<li>Email verification</li>
<li>Account activation</li>
<li>Registration confirmation</li>
<li>Developer testing</li>
<li>QA validation</li>
<li>Temporary signups</li>
</ul>

<p>The platform is designed to support privacy-focused email management and efficient inbox organization.</p>

<h2>Frequently Asked Questions</h2>

<h3>Can temporary email receive verification emails?</h3>

<p>Yes. Temporary inboxes are commonly used to receive account verification and activation emails.</p>

<h3>Can temporary email receive OTP codes?</h3>

<p>Many platforms send OTP codes through email. Temporary inboxes may receive these messages when supported by the sending service.</p>

<h3>Is temporary email useful for developer testing?</h3>

<p>Yes. Developers and QA teams commonly use temporary inboxes when validating email workflows.</p>

<h3>Can temporary email help reduce inbox clutter?</h3>

<p>Temporary inboxes can help separate short-term registration emails from ongoing personal and business communications.</p>

<h3>Is InboxOro affiliated with any third-party platform?</h3>

<p>No. All trademarks and brand names belong to their respective owners. InboxOro is not affiliated with, endorsed by, or sponsored by any third-party brand mentioned.</p>

<h2>Conclusion</h2>

<p>Email verification and account confirmation have become standard parts of online registration workflows. As users explore new platforms and services, verification emails, activation links, and registration confirmations can quickly accumulate.</p>

<p>InboxOro provides a practical temporary email solution for receiving verification messages, supporting registration workflows, and improving inbox organization.</p>

<p>Whether you are testing a new service, evaluating software, validating email workflows, or managing temporary registrations, temporary email can help streamline the verification process while keeping your primary inbox organized.</p>
HTML;
}
}