<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JuneTwentSixBlogSeeder extends Seeder
{
    

    // php artisan db:seed --class=JuneTwentSixBlogSeeder    
    
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
                'blog_category_id'    => $cats['privacy'],
                'title'               => 'How Temporary Email Helps Protect Privacy Online',
                'slug'                => 'how-temporary-email-helps-protect-privacy-online',
                'excerpt'             => 'Learn how temporary email helps reduce spam, organize registrations, and protect your primary inbox during online signups.',
                'featured_image'      => 'how-temporary-email-helps-protect-privacy-online.png',
                'featured_image_alt'  => 'Privacy-focused temporary email protecting inbox from spam',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'How Temporary Email Helps Protect Privacy Online',
                'meta_description'    => 'Discover how temporary email helps reduce spam, organize registrations, and protect your primary inbox online.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => [
                    'temporary-email',
                    'email-privacy',
                    'spam-protection',
                    'disposable-email',
                    'online-registration'
                ],
                'body'                => $this->bodyHowTemporaryEmailHelpsProtectPrivacyOnline(),
            ],
        ];
    }
 
private function bodyHowTemporaryEmailHelpsProtectPrivacyOnline(): string
{
    return <<<'HTML'
<p>Protecting your primary inbox has become increasingly important as more online services require email verification for registration, subscriptions, downloads, newsletters, and account creation. While these services provide convenience, they can also result in a growing number of promotional emails, product announcements, marketing campaigns, and automated notifications that make important messages harder to find.</p>

<p><strong>InboxOro</strong> provides a privacy-focused temporary email service that helps users receive verification emails without using their primary email address for every short-term registration. Instead of mixing temporary signups with personal or business communications, users can keep their main inbox organized while completing common online registration workflows.</p>

<p>This guide explains how temporary email supports better inbox management, reduces unwanted email exposure, and helps users organize short-term registrations in a practical and responsible way.</p>

<h2>Introduction</h2>

<p>Email has become the foundation of nearly every online service. Whether signing up for a productivity platform, downloading a free resource, registering for an event, accessing an online tool, or subscribing to a newsletter, an email address is usually required.</p>

<p>Although many registrations are legitimate, using the same permanent email address everywhere can gradually increase inbox clutter.</p>

<p>Users commonly receive:</p>

<ul>
<li>Verification emails</li>
<li>Welcome messages</li>
<li>Marketing campaigns</li>
<li>Weekly newsletters</li>
<li>Product announcements</li>
<li>Special offers</li>
<li>Feature updates</li>
<li>Subscription reminders</li>
<li>Promotional notifications</li>
</ul>

<p>Over time these messages can make it more difficult to locate important emails from banks, employers, clients, schools, healthcare providers, and family members.</p>

<p>A temporary inbox offers a practical way to separate short-term registrations from long-term communications.</p>

<h2>Why Protecting Your Primary Inbox Matters</h2>

<p>Your primary email account is often connected to important parts of your digital life, including financial services, work accounts, cloud storage, educational platforms, online shopping, and personal communications.</p>

<p>Keeping that inbox organized helps you:</p>

<ul>
<li>Locate important emails more quickly.</li>
<li>Reduce unnecessary inbox clutter.</li>
<li>Separate temporary registrations from everyday communication.</li>
<li>Manage newsletters more effectively.</li>
<li>Improve overall email organization.</li>
</ul>

<p>Instead of providing the same permanent address for every online registration, many users prefer using a temporary inbox when the signup is intended for short-term access or evaluation.</p>

<h2>What Is a Temporary Email?</h2>

<p>A temporary email is a disposable inbox that can receive emails for a limited period of time. It is commonly used for registrations that do not require long-term email communication.</p>

<p>Temporary email services are often used for:</p>

<ul>
<li>Website registrations</li>
<li>Product evaluations</li>
<li>Software testing</li>
<li>Newsletter subscriptions</li>
<li>Online forms</li>
<li>Email verification</li>
<li>Educational resources</li>
<li>Developer testing</li>
</ul>

<p>Rather than replacing your primary email account, a temporary inbox complements it by helping manage registrations that may only be needed briefly.</p>

<h2>How InboxOro Helps Protect Your Primary Inbox</h2>

<p>InboxOro is designed to provide a simple and efficient temporary email experience for users who want to separate temporary registrations from their everyday communications.</p>

<p>Instead of filling a personal inbox with short-term verification emails and promotional messages, users can receive those communications in a dedicated temporary inbox.</p>

<p>This approach supports better email organization while reducing unnecessary inbox clutter.</p>

<h2>Key Benefits</h2>

<h3>1. Reduce Unwanted Email</h3>

<p>Many online services continue sending newsletters, promotional campaigns, and product announcements after registration.</p>

<p>Using a temporary email for short-term signups can help keep these communications separate from your primary inbox.</p>

<p>For users specifically looking to reduce promotional email exposure, see our guide on <a href="https://inboxoro.com/temporary-email-for-spam-control">Temporary Email for Spam Control</a>.</p>

<h3>2. Keep Personal and Temporary Registrations Separate</h3>

<p>A dedicated temporary inbox allows users to organize registration emails independently from everyday conversations.</p>

<p>This makes it easier to manage:</p>

<ul>
<li>Business emails</li>
<li>Family communications</li>
<li>Client messages</li>
<li>School notifications</li>
<li>Financial correspondence</li>
</ul>

<p>while keeping short-term registration emails in a separate location.</p>

<h3>3. Simplify Website Registrations</h3>

<p>Many websites require email verification before allowing access to their services.</p>

<p>A temporary inbox can receive verification emails needed to complete these registrations while keeping your primary inbox cleaner.</p>

<p>Learn more in our guide about <a href="https://inboxoro.com/temp-mail-for-website-registration">Temporary Email for Website Registration</a>.</p>

<h3>4. Organize Newsletter Signups</h3>

<p>Newsletters can provide valuable information, but subscribing to many publications may significantly increase inbox volume over time.</p>

<p>Users who subscribe to industry updates, educational resources, or promotional newsletters often prefer managing those subscriptions separately.</p>

<p>Related guide:</p>

<p><a href="https://inboxoro.com/temporary-email-for-newsletter-signups">Temporary Email for Newsletter Signups</a></p>

<h3>5. Better Email Organization</h3>

<p>One of the biggest advantages of using temporary email is improved inbox organization.</p>

<p>Instead of searching through hundreds of registration emails, promotional messages, and verification notices, users can keep their permanent inbox focused on communications that matter most.</p>

<h3>6. Helpful During Product Evaluations</h3>

<p>Many users evaluate software, SaaS platforms, educational tools, and online services before deciding whether to continue using them.</p>

<p>Temporary email helps organize verification emails associated with these evaluations without mixing them into everyday communications.</p>

<p>For product access workflows, see <a href="https://inboxoro.com/temporary-email-for-product-access">Temporary Email for Product Access</a>.</p>

<h3>7. Convenient for Online Forms</h3>

<p>Many downloadable resources, webinars, research reports, and informational websites request an email address before providing access.</p>

<p>When the interaction is expected to be short-term, users may prefer using a temporary inbox.</p>

<p>Read more in our guide to <a href="https://inboxoro.com/temp-mail-for-online-forms">Temporary Email for Online Forms</a>.</p>
HTML;
}


}