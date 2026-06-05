<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Services\BlogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JuneFive126Blog extends Seeder
{
    
    // php artisan db:seed --class=JuneFive126Blog    
    
    public function run(): void
    {
        $service = app(BlogService::class);

        // ── Fetch category ids ────────────────────────────────────

        // BlogCategory::create([
        //     'name'       => 'Technology',
        //     'slug'       => 'technology',
        //     'color'      => '#33b208',
        //     'sort_order' => 10,
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
                'blog_category_id'    => $cats['entertainment'],
                'title'               => 'Temporary Email for Content Creators and Media Platforms',
                'slug'                => 'temporary-email-for-content-creators-and-media-platforms',
                'excerpt'             => 'Learn how temporary email helps content creators manage media platform registrations, creator tools, and verification emails efficiently.',
                'featured_image'      => 'temporary-email-for-content-creators-and-media-platforms.png',
                'featured_image_alt'  => 'Content creator managing media platforms and creator tools',
                'author_name'         => 'InboxOro Team',
                'meta_title'          => 'Temporary Email for Content Creators and Media Platforms',
                'meta_description'    => 'Discover how temporary email helps organize creator tool registrations, media platform signups, and verification emails.',
                'status'              => 'published',
                'is_featured'         => true,
                'published_at'        => Carbon::now(),
                'view_count'          => 0,
                'tag_slugs'           => [
                    'temporary-email',
                    'content-creators',
                    'media-platforms',
                    'creator-tools',
                    'disposable-email'
                ],
                'body'                => $this->bodyTemporaryEmailForContentCreatorsAndMediaPlatforms(),
            ],
        ];
    }
 
    
private function bodyTemporaryEmailForContentCreatorsAndMediaPlatforms(): string
{
    return <<<'HTML'
<p>Content creators use a growing number of online platforms to publish videos, share podcasts, manage digital media, edit content, and collaborate with audiences. From video hosting services to audio production tools, modern creators often maintain accounts across multiple platforms.</p>

<p>Most content platforms require email verification before users can access publishing features, creator dashboards, analytics tools, or account settings. Over time, these registrations can generate a large volume of notifications, newsletters, promotional emails, and account alerts.</p>

<p>A temporary email service such as <strong>InboxOro</strong> can help creators manage short-term registrations while keeping temporary signups separate from important personal and business communications.</p>

<h2>Introduction</h2>

<p>Digital content creation continues to expand across video, audio, streaming, podcasting, and media publishing platforms. Creators frequently test new services, compare features, and evaluate tools before committing to long-term workflows.</p>

<p>Temporary email services can simplify these evaluations by providing a dedicated inbox for registration and verification emails.</p>

<h2>Why This Matters</h2>

<p>Creator platforms commonly send:</p>

<ul>
<li>Email verification links</li>
<li>Account activation messages</li>
<li>Publishing notifications</li>
<li>Platform updates</li>
<li>Creator newsletters</li>
<li>Security alerts</li>
<li>Feature announcements</li>
</ul>

<p>Managing these communications separately can improve inbox organization and reduce clutter.</p>

<h2>Key Benefits</h2>

<h3>Receive Verification Emails Quickly</h3>

<p>Many media platforms require email verification before creators can access publishing features or account dashboards.</p>

<h3>Keep Registrations Organized</h3>

<p>Creators often experiment with multiple services. Temporary inboxes help separate short-term registrations from primary communications.</p>

<h3>Support Privacy-Focused Email Management</h3>

<p>Temporary inboxes can help reduce exposure of a primary email address while evaluating new platforms and tools.</p>

<h3>Useful for Testing New Services</h3>

<p>Content creators frequently explore emerging platforms before adopting them permanently.</p>

<h2>Temporary Email for Video Platforms</h2>

<p>Video creators often register on multiple publishing platforms while exploring distribution opportunities.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-mail-for-video-platforms">Temporary Email for Video Platforms</a></p>

<h2>Temporary Email for Music Platforms</h2>

<p>Musicians and audio creators frequently evaluate different music services and publishing platforms.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-mail-for-music-platforms">Temporary Email for Music Platforms</a></p>

<h2>Temporary Email for Podcast Platforms</h2>

<p>Podcast creators commonly use multiple hosting and distribution platforms before selecting long-term solutions.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-mail-for-podcast-platforms">Temporary Email for Podcast Platforms</a></p>

<h2>Temporary Email for Streaming Platforms</h2>

<p>Streaming services often require account verification and onboarding before creators can access available features.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-mail-for-streaming-platforms">Temporary Email for Streaming Platforms</a></p>

<h2>Temporary Email for Creator Tools</h2>

<p>Content creators rely on editing, publishing, analytics, and workflow management tools. Temporary inboxes can support account registration and evaluation workflows.</p>

<p>Related resource:</p>

<p><a href="https://inboxoro.com/temp-mail-for-creator-tools">Temporary Email for Creator Tools</a></p>

<h2>Real-World Use Cases</h2>

<ul>
<li>Evaluating video publishing services</li>
<li>Testing podcast hosting platforms</li>
<li>Exploring music distribution tools</li>
<li>Registering for media production software</li>
<li>Comparing streaming platforms</li>
<li>Testing creator-focused SaaS tools</li>
</ul>

<h2>Best Practices</h2>

<ul>
<li>Use temporary email for short-term evaluations</li>
<li>Keep long-term creator accounts on permanent email addresses</li>
<li>Follow platform registration requirements</li>
<li>Organize temporary signups separately</li>
</ul>

<h2>Common Mistakes</h2>

<ul>
<li>Using one inbox for every creator platform</li>
<li>Ignoring verification emails</li>
<li>Mixing temporary registrations with business communications</li>
<li>Using temporary inboxes for critical long-term creator accounts</li>
</ul>

<h2>Frequently Asked Questions</h2>

<h3>Can temporary email receive creator platform verification emails?</h3>

<p>Yes. Temporary inboxes are commonly used to receive activation emails, registration confirmations, and verification links.</p>

<h3>Can content creators use temporary email for testing platforms?</h3>

<p>Yes. Many creators evaluate platforms before selecting long-term solutions.</p>

<h3>Can temporary email help organize creator tool registrations?</h3>

<p>Yes. Temporary inboxes help separate temporary signups from primary communications.</p>

<h3>Is InboxOro affiliated with any media platform?</h3>

<p>No. All trademarks and brand names belong to their respective owners. InboxOro is not affiliated with, endorsed by, or sponsored by any third-party brand mentioned.</p>

<h2>Conclusion</h2>

<p>Content creators often work across numerous media platforms, creator tools, and publishing services. Temporary email services such as <strong>InboxOro</strong> can help organize registrations, receive verification emails, and support efficient inbox management while evaluating new opportunities.</p>
HTML;
}
}