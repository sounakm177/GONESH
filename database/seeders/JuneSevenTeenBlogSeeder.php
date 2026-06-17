<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JuneSevenTeenBlogSeeder extends Seeder
{
    
    // php artisan db:seed --class=JuneSevenTeenBlogSeeder    
    
    public function run(): void
    {
        $service = app(BlogService::class);

        // ── Fetch category ids ────────────────────────────────────

        // BlogCategory::create([
        //     'name'       => 'Productivity',
        //     'slug'       => 'productivity',
        //     'color'      => '#33b208',
        //     'sort_order' => 13,
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
            'blog_category_id'    => $cats['marketing'],
            'title'               => 'Temporary Email for Marketing Campaign Testing',
            'slug'                => 'temporary-email-for-marketing-campaign-testing',
            'excerpt'             => 'Learn how temporary email supports marketing campaign testing, lead capture validation, newsletter signup testing, and email workflow verification.',
            'featured_image'      => 'temporary-email-for-marketing-campaign-testing.png',
            'featured_image_alt'  => 'Marketing campaign testing and email verification workflow',
            'author_name'         => 'InboxOro Team',
            'meta_title'          => 'Temporary Email for Marketing Campaign Testing',
            'meta_description'    => 'Discover how temporary email helps test marketing campaigns, newsletter signups, lead capture forms, and email workflows.',
            'status'              => 'published',
            'is_featured'         => true,
            'published_at'        => Carbon::now(),
            'view_count'          => 0,
            'tag_slugs'           => [
                'temporary-email',
                'marketing-testing',
                'newsletter-signups',
                'lead-generation',
                'campaign-testing'
            ],
            'body'                => $this->bodyTemporaryEmailForMarketingCampaignTesting(),
        ],
        ];
    }
 
    
private function bodyTemporaryEmailForMarketingCampaignTesting(): string
{
    return <<<'HTML'
<p>Marketing teams depend heavily on email-driven workflows to acquire leads, nurture prospects, engage subscribers, and measure campaign performance. Before launching a campaign to real users, marketers, developers, and QA teams often need to test signup forms, subscription workflows, verification emails, welcome sequences, and lead capture systems.</p>

<p>Without proper testing, issues such as broken confirmation emails, failed form submissions, missing verification links, or incorrect email content can negatively impact campaign results and user experience.</p>

<p><strong>InboxOro</strong> provides a temporary email service that helps marketing professionals, developers, and testing teams validate email-based workflows while keeping testing activities separate from primary inboxes.</p>

<p>This guide explores how temporary email supports marketing campaign testing, lead generation workflows, newsletter registrations, email verification systems, and subscription form validation.</p>

<h2>Introduction</h2>

<p>Email remains one of the most effective digital marketing channels. Businesses use email campaigns to communicate with customers, deliver updates, announce products, distribute educational content, and maintain long-term engagement.</p>

<p>Before campaigns go live, teams typically test:</p>

<ul>
<li>Newsletter signup forms</li>
<li>Lead capture workflows</li>
<li>Email verification systems</li>
<li>Subscription confirmations</li>
<li>Welcome email sequences</li>
<li>Marketing automation workflows</li>
<li>Landing page registrations</li>
<li>Campaign tracking processes</li>
</ul>

<p>Temporary inboxes can help support these testing activities efficiently.</p>

<h2>Why This Matters</h2>

<p>A small issue in a registration or subscription workflow can impact marketing performance.</p>

<p>Examples include:</p>

<ul>
<li>Missing verification emails</li>
<li>Broken confirmation links</li>
<li>Incorrect subscriber onboarding</li>
<li>Email delivery failures</li>
<li>Form submission problems</li>
<li>Incomplete lead capture processes</li>
</ul>

<p>Testing these workflows before launch can help improve reliability and user experience.</p>

<h2>What Is a Temporary Email Service?</h2>

<p>A temporary email service provides a disposable inbox that can receive emails for a limited period.</p>

<p>Temporary inboxes are commonly used for:</p>

<ul>
<li>Email verification testing</li>
<li>Marketing workflow validation</li>
<li>Newsletter signup testing</li>
<li>Lead capture testing</li>
<li>Software quality assurance</li>
<li>Campaign testing activities</li>
</ul>

<p>Rather than using personal inboxes for testing, teams can use temporary inboxes to organize campaign-related validation processes.</p>

<h2>Key Benefits</h2>

<h3>Validate Newsletter Signup Flows</h3>

<p>Newsletter registration forms are often one of the first touchpoints between a business and potential subscribers.</p>

<p>Temporary inboxes can help teams verify:</p>

<ul>
<li>Signup success messages</li>
<li>Verification emails</li>
<li>Welcome sequences</li>
<li>Confirmation links</li>
</ul>

<h3>Improve Campaign Quality Assurance</h3>

<p>Marketing campaigns frequently involve multiple systems working together.</p>

<p>Testing helps identify issues before users encounter them.</p>

<h3>Reduce Inbox Clutter</h3>

<p>Campaign testing can generate large volumes of emails.</p>

<p>Temporary inboxes help keep testing activities separate from everyday communications.</p>

<h3>Support Team Collaboration</h3>

<p>Marketers, developers, QA specialists, and product teams often work together when validating email workflows.</p>

<p>Temporary email can simplify testing across departments.</p>

<h2>Temporary Email for Lead Capture Testing</h2>

<p>Lead capture forms play an important role in customer acquisition strategies.</p>

<p>Businesses commonly use these forms to collect subscriber information, distribute resources, and connect with potential customers.</p>

<p>Testing helps ensure forms work correctly and confirmation emails are delivered as expected.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-mail-for-lead-capture">Temporary Email for Lead Capture</a></p>

<h2>Temporary Email for Newsletter Signups</h2>

<p>Newsletter workflows often include verification emails, welcome messages, and subscription confirmations.</p>

<p>Temporary inboxes can help teams validate these user journeys before launching campaigns.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-mail-for-newsletter-signups">Temporary Email for Newsletter Signups</a></p>

<h2>Temporary Email for Campaign Testing</h2>

<p>Marketing teams frequently test campaign workflows before sending communications to subscribers.</p>

<p>Temporary inboxes provide a practical environment for verifying campaign functionality.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-mail-for-campaign-testing">Temporary Email for Campaign Testing</a></p>

<h2>Temporary Email for Marketing Tools</h2>

<p>Modern marketing operations often involve CRM systems, automation platforms, analytics solutions, and customer engagement tools.</p>

<p>Temporary email can help support registration and verification testing associated with these platforms.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-mail-for-marketing-tools">Temporary Email for Marketing Tools</a></p>

<h2>Temporary Email for Lead Generation Tools</h2>

<p>Lead generation platforms commonly require email verification during setup and testing.</p>

<p>Temporary inboxes can help teams validate these onboarding workflows.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-mail-for-lead-generation-tools">Temporary Email for Lead Generation Tools</a></p>

<h2>Real-World Use Cases</h2>

<h3>Newsletter Platform Testing</h3>

<p>Businesses frequently validate subscriber registration workflows before launching email campaigns.</p>

<h3>Landing Page Optimization</h3>

<p>Marketing teams test forms, confirmation emails, and subscriber journeys to improve conversion performance.</p>

<h3>Lead Generation Validation</h3>

<p>Organizations often verify that lead capture systems properly process submissions and trigger follow-up emails.</p>

<h3>Marketing Automation Workflows</h3>

<p>Automated campaigns typically include multiple email touchpoints that require testing.</p>

<h3>Product Launch Campaigns</h3>

<p>Teams often verify email workflows before launching major marketing initiatives.</p>

<h2>Best Practices</h2>

<h3>Test Complete User Journeys</h3>

<p>Validate every step from form submission through confirmation emails and onboarding sequences.</p>

<h3>Review Email Content Carefully</h3>

<p>Check formatting, links, personalization fields, and messaging before launching campaigns.</p>

<h3>Validate Verification Emails</h3>

<p>Ensure subscribers receive confirmation messages and activation links correctly.</p>

<h3>Use Dedicated Testing Processes</h3>

<p>Keeping campaign testing separate from production communications can improve organization and efficiency.</p>

<h2>Common Mistakes</h2>

<h3>Skipping Pre-Launch Testing</h3>

<p>Even minor workflow issues can affect subscriber acquisition and engagement.</p>

<h3>Testing Only Forms</h3>

<p>Entire email workflows should be validated, not just the signup process.</p>

<h3>Ignoring Mobile Experiences</h3>

<p>Many users subscribe through mobile devices, making mobile testing important.</p>

<h3>Mixing Testing Emails with Business Communications</h3>

<p>Temporary inboxes can help keep testing activities organized.</p>

<h2>How InboxOro Supports Marketing Teams</h2>

<p>InboxOro helps marketers, developers, QA engineers, and business teams receive verification emails, registration confirmations, subscription notifications, and campaign-related messages.</p>

<p>Common use cases include:</p>

<ul>
<li>Newsletter testing</li>
<li>Lead capture validation</li>
<li>Campaign workflow testing</li>
<li>Email verification testing</li>
<li>Marketing automation validation</li>
<li>Subscription form testing</li>
</ul>

<p>The platform is designed to support privacy-focused email management while helping teams organize marketing-related testing activities.</p>

<h2>Frequently Asked Questions</h2>

<h3>Can temporary email be used for marketing campaign testing?</h3>

<p>Yes. Temporary inboxes are commonly used to validate registration forms, verification emails, and campaign workflows.</p>

<h3>Can marketers test newsletter signups using temporary email?</h3>

<p>Temporary inboxes can help verify subscription confirmations, welcome emails, and registration processes.</p>

<h3>Is temporary email useful for lead capture testing?</h3>

<p>Many teams use temporary inboxes to validate lead generation workflows and email delivery systems.</p>

<h3>Can temporary email help reduce inbox clutter during testing?</h3>

<p>Yes. Temporary inboxes can separate testing communications from regular business emails.</p>

<h3>Is InboxOro affiliated with any marketing platform?</h3>

<p>No. All trademarks and brand names belong to their respective owners. InboxOro is not affiliated with, endorsed by, or sponsored by any third-party brand mentioned.</p>

<h2>Conclusion</h2>

<p>Successful marketing campaigns depend on reliable registration forms, email verification systems, subscription workflows, and onboarding experiences. Thorough testing helps ensure these processes function correctly before reaching real users.</p>

<p>InboxOro provides a practical temporary email solution for receiving verification emails, validating marketing workflows, testing newsletter registrations, and supporting campaign quality assurance.</p>

<p>Whether you are managing lead generation systems, newsletter platforms, automation workflows, or campaign testing activities, temporary email can help streamline validation processes while supporting efficient inbox management.</p>
HTML;
}
}