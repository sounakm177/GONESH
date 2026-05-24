<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeoPage;

class SeoPageSeederBatchMKT1 extends Seeder
{
    // php artisan db:seed --class=SeoPageSeederBatchMKT1
    // Covers: temp-mail-for-ads-signup, temp-mail-for-facebook-ads,
    //         temp-mail-for-google-ads, temp-mail-for-instagram-ads,
    //         temp-mail-for-ad-testing
    // is_brand = true | category = 'use-case'

    public function run(): void
    {
        $slugs = [
            'temp-mail-for-ads-signup',
            'temp-mail-for-facebook-ads',
            'temp-mail-for-google-ads',
            'temp-mail-for-instagram-ads',
            'temp-mail-for-ad-testing',
        ];

        SeoPage::whereIn('slug', $slugs)->delete();
        $this->command->info('🗑️  Deleted existing records for Batch MKT1 slugs.');

        $pages = [

            // ─────────────────────────────────────────────────────────────
            // 1. temp-mail-for-ads-signup
            // ─────────────────────────────────────────────────────────────
            [
                'slug'             => 'temp-mail-for-ads-signup',
                'title'            => 'Temp Mail for Ads Platform Signup – Free | InboxOro',
                'meta_description' => 'Use InboxOro free temp mail for advertising platform signups. Create test ad accounts privately. Instant inbox, no registration. Auto-deletes in 10 minutes.',
                'h1'               => 'Temp Mail for Ads Platform Signup — Create Advertising Accounts Without Real Email Commitment',
                'category'         => 'use-case',
                'is_brand'         => false,
                'template'         => 'default',
                'intro_text'       => '
<p>Digital advertising platforms are among the most data-hungry systems on the internet. When a user creates an account on any advertising platform — whether to run campaigns, explore the platform\'s ad creation tools, study its audience targeting capabilities, or test ad creative and copy — the registered email becomes the anchor for a comprehensive data relationship. Advertising platforms send registered users communications covering billing alerts, campaign performance notifications, platform policy updates, promotional credits, new feature announcements, and ongoing marketing for the platform\'s advertising products. For marketers, researchers, developers, and advertising professionals who need to create accounts on advertising platforms for testing, research, or competitive analysis — without their professional email being enrolled in every platform\'s marketing system from the moment of first access — <strong>InboxOro</strong> provides a free temporary email for ads platform signups.</p>

<p>InboxOro is a completely independent disposable email service with no affiliation to any advertising platform. It generates a temporary inbox automatically when you open the site — no registration, no personal data. The generated address satisfies the advertising platform\'s email verification requirement during account creation. The account verification email arrives in InboxOro\'s real-time inbox within seconds, the account is activated, and InboxOro auto-deletes after 10 minutes.</p>

<h2>Advertising Platform Signup Scenarios Where InboxOro Applies</h2>

<p><strong>Exploring ad platform interfaces and tools before active campaigns:</strong> Marketers who are evaluating advertising platforms — understanding the campaign creation workflow, studying available targeting options, reviewing ad format specifications, and assessing the reporting and analytics capabilities — before committing to running live campaigns use InboxOro for the account creation that enables this interface exploration. The evaluation is genuine professional research; the platform registration email consequence is not relevant to the research purpose.</p>

<p><strong>Testing ad platform accounts for development and QA:</strong> Developers and QA engineers who build integrations with advertising platform APIs — creating ad management tools, campaign automation systems, or marketing dashboard applications — need test advertising accounts to develop and validate their integrations against. InboxOro provides the email for these test account registrations, keeping professional and personal email addresses out of test account databases on advertising platforms.</p>

<p><strong>Competitive landscape and platform capability research:</strong> Marketing strategists, media planners, and competitive analysts who research the capabilities of different advertising platforms — comparing targeting granularity, ad format options, minimum budget requirements, and audience reach — create research accounts on platforms they are evaluating for potential campaign deployment. InboxOro handles these research account registrations without professional marketing email being enrolled in every evaluated platform\'s marketing system.</p>

<p><strong>Agency evaluation of new advertising channels for clients:</strong> Digital marketing agencies that evaluate new advertising channels and platforms on behalf of clients — assessing platform suitability before recommending them for client campaign budgets — create evaluation accounts during the assessment process. InboxOro handles these evaluation account registrations, keeping agency professional email out of advertising platforms being evaluated for potential but not yet committed client campaigns.</p>

<p><strong>Training and certification account creation:</strong> Marketing professionals who study advertising platforms for professional certification — accessing educational content, practice environments, and certification exam preparation within the platform — use InboxOro for the practice or study account creation that is distinct from their active professional campaign management accounts.</p>

<ul>
  <li><strong>Interface and tool exploration</strong> — access platform ad creation tools without marketing enrollment</li>
  <li><strong>API development and QA testing</strong> — test ad platform integrations without real email in test databases</li>
  <li><strong>Competitive platform research</strong> — assess capabilities across platforms without promotional enrollment</li>
  <li><strong>Agency channel evaluation</strong> — evaluate platforms for clients without premature commitment</li>
  <li><strong>Training and study accounts</strong> — separate educational access from active professional accounts</li>
  <li><strong>Real-time verification delivery</strong> — platform account activation arrives within seconds</li>
  <li><strong>Auto-deletes after 10 minutes</strong> — no persistent inbox for platform marketing</li>
  <li><strong>Completely free</strong> — advertising platform research at zero cost</li>
</ul>

<h2>Active Campaign Management and Real Email</h2>

<p>For advertising accounts that are actively used for real campaign management — running paid campaigns with real budgets, tracking real performance metrics, and managing billing relationships — a permanent real email address is essential. Billing notifications, payment failure alerts, campaign suspension notices, and account policy communications all require a reliable permanent inbox. InboxOro is for the research, testing, and evaluation phase; real email is for committed campaign management accounts where the business relationship with the platform requires reliable communication.</p>

<p><em>InboxOro is not affiliated with any advertising platform, ad network, or digital marketing service. This page describes InboxOro\'s general use as a temporary email for advertising platform account creation during research, testing, and evaluation activities.</em></p>',
                'faq' => json_encode([
                    ['question' => 'Can I use InboxOro to create advertising platform accounts for research purposes?', 'answer' => 'Yes. InboxOro is a free temporary email service commonly used for signing up on advertising platforms for research, interface exploration, and competitive analysis. InboxOro is not affiliated with any advertising platform.'],
                    ['question' => 'Can developers use InboxOro for ad platform API integration testing?', 'answer' => 'Yes. Developers building integrations with advertising platform APIs use InboxOro for test account registrations — keeping professional email out of test account databases on advertising platforms during development and QA.'],
                    ['question' => 'Should I use real email for active advertising campaign accounts?', 'answer' => 'Yes. For accounts running live campaigns with real budgets, use permanent real email. Billing alerts, payment notifications, and campaign status communications require a reliable permanent inbox.'],
                    ['question' => 'How quickly does the advertising platform account verification arrive in InboxOro?', 'answer' => 'Typically within 5 to 15 seconds. InboxOro\'s real-time inbox displays the verification email automatically without manual refresh.'],
                    ['question' => 'Is InboxOro free for advertising platform signups?', 'answer' => 'Yes. InboxOro is completely free — no subscription, no InboxOro account, no cost of any kind.'],
                    ['question' => 'Is InboxOro affiliated with any advertising platform or ad network?', 'answer' => 'No. InboxOro is a fully independent disposable email service with no affiliation or connection to any advertising platform or digital marketing service.'],
                ]),
                'is_active' => true,
            ],

            // ─────────────────────────────────────────────────────────────
            // 2. temp-mail-for-facebook-ads
            // ─────────────────────────────────────────────────────────────
            [
                'slug'             => 'temp-mail-for-facebook-ads',
                'title'            => 'Temp Mail for Facebook Ads Account – Free | InboxOro',
                'meta_description' => 'Use InboxOro free temp mail for Facebook Ads account research. Explore ad tools privately. Instant inbox, no registration required. Auto-deletes in 10 minutes.',
                'h1'               => 'Temp Mail for Facebook Ads — Explore the Ad Platform Without Permanent Email Commitment',
                'category'         => 'use-case',
                'is_brand'         => true,
                'template'         => 'default',
                'intro_text'       => '
<p>Facebook Ads is one of the world\'s most widely used paid advertising platforms, offering advertisers access to detailed audience targeting across demographics, interests, behaviours, and custom audiences. The platform\'s ad creation tools, audience insight capabilities, and campaign management interface are studied by marketers, researchers, and developers worldwide. Account creation on platforms associated with Facebook Ads — including Meta\'s Business Suite — uses email for registration and verification. Users who want to explore the platform\'s ad creation capabilities, study its targeting options, or access it for research and competitive analysis use <strong>InboxOro</strong>, a free temporary email service commonly used for signing up on advertising management platforms. InboxOro is not affiliated with Facebook, Meta, or any related service — it is an independent disposable email tool.</p>

<p>For users who want to use a temporary email for Facebook Ads platform exploration, InboxOro provides the verification email in real time and auto-deletes after 10 minutes. Note that Meta\'s advertising platforms have deep integration with Facebook accounts and identity systems — the applicable scenarios for InboxOro are email-based registration paths rather than Facebook account-authenticated sign-in flows.</p>

<h2>Facebook Ads Research and Evaluation Use Cases</h2>

<p><strong>Studying ad format and creative specifications:</strong> Creative directors, designers, and marketing teams who study Facebook\'s ad format specifications — image dimensions, video length requirements, text ratio guidelines, interactive ad formats, and placement-specific requirements — access the platform\'s ad creation documentation and tools through registered accounts. InboxOro handles the registration email for this specification research without committing professional email to Meta\'s marketing communications system.</p>

<p><strong>Audience insights and targeting research:</strong> Media strategists and audience researchers who study the audience targeting capabilities available within Facebook\'s advertising ecosystem — understanding the granularity of interest targeting, the depth of behavioural targeting options, and the structure of custom audience creation — use InboxOro for research account access during this capability assessment phase.</p>

<p><strong>Competitive ad creative and library research:</strong> Facebook\'s Ad Library provides public access to active ads across its platforms. Researchers and competitive analysts who access Ad Library content as part of competitive intelligence gathering may use InboxOro for any account registration that enables enhanced access to these public research tools.</p>

<p><strong>Developer API and SDK integration testing:</strong> Developers building integrations with the Marketing API — creating tools that programmatically manage Facebook ad campaigns, pull performance data, or automate creative production — use test advertising accounts for development and QA. InboxOro provides the email for test account creation during the development phase.</p>

<p><strong>Agency new platform evaluation for client consideration:</strong> Digital marketing agencies that evaluate Facebook\'s advertising products as potential campaign channels for specific clients — assessing whether the platform\'s audience capabilities match a client\'s target demographic — create evaluation accounts during this assessment. InboxOro handles the evaluation account email without the agency\'s professional email being enrolled in the platform\'s marketing system before a client campaign commitment is made.</p>

<ul>
  <li><strong>Ad format and creative specification research</strong> — access tools for format research without marketing enrollment</li>
  <li><strong>Audience targeting capability assessment</strong> — study targeting options before campaign commitment</li>
  <li><strong>Ad Library competitive research</strong> — access public creative intelligence tools</li>
  <li><strong>API developer testing</strong> — test marketing API integrations without real email in test databases</li>
  <li><strong>Agency channel evaluation</strong> — assess platform for clients without premature commitment</li>
  <li><strong>Real-time verification delivery</strong> — account activation arrives within seconds</li>
  <li><strong>Auto-deletes after 10 minutes</strong> — no persistent inbox for platform marketing</li>
  <li><strong>Completely free</strong> — platform research at zero cost</li>
</ul>

<p><em>InboxOro is not affiliated with, endorsed by, or officially connected to Facebook, Meta Platforms, Inc., or any related service. Facebook and Facebook Ads are trademarks of Meta Platforms, Inc. InboxOro is an independent disposable email service used by individuals for private platform research.</em></p>',
                'faq' => json_encode([
                    ['question' => 'Can I use InboxOro for Facebook Ads platform research without my real email?', 'answer' => 'InboxOro is a free temporary email service commonly used for signing up on advertising platforms for research and evaluation. Note that Facebook Ads is deeply integrated with Facebook accounts — InboxOro applies to email-based registration paths. InboxOro is not affiliated with Facebook or Meta.'],
                    ['question' => 'Will Facebook marketing and promotional emails reach my real inbox if I use InboxOro?', 'answer' => 'No. Platform marketing emails are sent to the InboxOro address, which auto-deletes after 10 minutes — not to the real inbox.'],
                    ['question' => 'Should I use real email for active Facebook Ads campaigns?', 'answer' => 'Yes. For accounts running live campaigns with real budgets and billing, permanent real email is required for payment notifications, billing alerts, and policy communications.'],
                    ['question' => 'Is InboxOro free for Facebook Ads platform research?', 'answer' => 'Yes. InboxOro is completely free — no subscription, no account, no cost.'],
                    ['question' => 'How quickly does the account verification email arrive in InboxOro?', 'answer' => 'Typically within 5 to 15 seconds. InboxOro\'s real-time inbox displays verification emails automatically without manual refresh.'],
                    ['question' => 'Is InboxOro affiliated with Facebook or Meta?', 'answer' => 'No. InboxOro is a fully independent disposable email service with no affiliation, partnership, or official connection to Facebook, Meta Platforms, Inc., or any related service.'],
                ]),
                'is_active' => true,
            ],

            // ─────────────────────────────────────────────────────────────
            // 3. temp-mail-for-google-ads
            // ─────────────────────────────────────────────────────────────
            [
                'slug'             => 'temp-mail-for-google-ads',
                'title'            => 'Temp Mail for Google Ads Account – Free | InboxOro',
                'meta_description' => 'Use InboxOro free temp mail for Google Ads account research. Explore ad tools privately before committing. Instant inbox, no registration. Auto-deletes in 10 minutes.',
                'h1'               => 'Temp Mail for Google Ads — Research the Platform Before Your Real Email Enters the System',
                'category'         => 'use-case',
                'is_brand'         => true,
                'template'         => 'default',
                'intro_text'       => '
<p>Google Ads is the world\'s largest search and display advertising platform, giving advertisers access to audiences across search results, display networks, YouTube, and partner sites. The platform\'s keyword planning tools, auction insight reports, campaign structure options, and performance metrics make it one of the most studied advertising systems in digital marketing. Account creation for Google Ads is typically tied to a Google account — meaning InboxOro applies specifically to email-based registration paths or secondary account creation where a non-Google email is used, rather than to primary Google account sign-in flows. For marketing researchers, developers, and advertising professionals who want to explore Google Ads capabilities, access its planning tools, or create test accounts for integration development, <strong>InboxOro</strong> is a free temporary email service commonly used for advertising platform account creation — independent of Google, with no affiliation to any Google service.</p>

<p>InboxOro is not affiliated with Google, Google Ads, or any Google service. It is an independent disposable email tool. The InboxOro address satisfies email verification requirements where applicable, the activation email arrives in real time, and InboxOro auto-deletes after 10 minutes.</p>

<h2>Google Ads Research and Development Scenarios</h2>

<p><strong>Keyword planning tool research and competitive analysis:</strong> SEO and SEM professionals who use Google\'s keyword planning tools — understanding search volume trends, competitive keyword landscapes, and bid range estimates for specific industries and markets — access these tools through registered advertising accounts. Researchers who want to use these planning capabilities without their professional email being enrolled in Google\'s advertising marketing communications use InboxOro for applicable secondary account creation paths.</p>

<p><strong>Campaign structure and bidding strategy study:</strong> Marketing students, junior SEM specialists, and professionals transitioning into paid search management who want to study Google Ads campaign structure — understanding campaign types, bidding strategies, quality score mechanics, and ad extension options — access the platform\'s documentation and interface through study accounts. InboxOro handles these study account registrations where email-based paths are available.</p>

<p><strong>Google Ads API and Smart Bidding integration testing:</strong> Developers building tools that integrate with the Google Ads API — creating campaign management dashboards, bid automation tools, or performance reporting applications — use test advertising accounts during development. InboxOro provides the email for test account creation where applicable, keeping developer professional email separate from test advertising account databases.</p>

<p><strong>Agency evaluation of Google Ads for new verticals:</strong> Digital marketing agencies that are evaluating Google Ads as an appropriate channel for clients in new verticals — assessing search volume viability, competitive density, and cost per click estimates before recommending a search advertising investment — use research accounts during this assessment phase. InboxOro handles the research account email where applicable to email-based registration paths.</p>

<p><strong>Conversion tracking and analytics integration research:</strong> Marketing technologists who research how Google Ads integrates with analytics and conversion tracking systems — understanding the technical setup of conversion measurement, audience list creation, and cross-platform attribution — access the platform\'s technical documentation and interface through research accounts.</p>

<ul>
  <li><strong>Keyword planning research</strong> — access planning tools without advertising marketing enrollment</li>
  <li><strong>Campaign structure study</strong> — learn platform structure through study accounts</li>
  <li><strong>API integration development</strong> — test integrations without real email in test databases</li>
  <li><strong>Agency channel assessment</strong> — research new verticals before client campaign commitment</li>
  <li><strong>Analytics integration research</strong> — study tracking and attribution capabilities</li>
  <li><strong>Real-time verification delivery</strong> — account activation arrives within seconds where applicable</li>
  <li><strong>Note on Google account integration</strong> — primary Google Ads access uses Google account sign-in; InboxOro applies to email-based paths</li>
  <li><strong>Completely free</strong> — advertising platform research at zero cost</li>
</ul>

<p><em>InboxOro is not affiliated with, endorsed by, or officially connected to Google, Google Ads, or any Google service. Google Ads is a trademark of Google LLC. InboxOro is an independent disposable email service used by individuals for private platform research.</em></p>',
                'faq' => json_encode([
                    ['question' => 'Can I use InboxOro for Google Ads research without my real email?', 'answer' => 'InboxOro applies to email-based registration paths — note that Google Ads is primarily accessed through Google accounts. For any email-based registration paths where InboxOro is applicable, it provides a free temporary email for research and testing. InboxOro is not affiliated with Google or Google Ads.'],
                    ['question' => 'Is InboxOro useful for Google Ads API developers?', 'answer' => 'Yes. Developers building integrations with the Google Ads API use test advertising accounts during development. InboxOro provides the email for test account creation where email-based paths are applicable, keeping professional email separate from test databases.'],
                    ['question' => 'Should I use real email for active Google Ads campaign accounts?', 'answer' => 'Yes. For accounts running live campaigns with real budgets, real email — typically a Google account — is required for billing communications, campaign alerts, and account management.'],
                    ['question' => 'Is InboxOro free for advertising platform research?', 'answer' => 'Yes. InboxOro is completely free — no subscription, no account, no cost of any kind.'],
                    ['question' => 'Is InboxOro affiliated with Google?', 'answer' => 'No. InboxOro is a fully independent disposable email service with no affiliation, partnership, or official connection to Google, Google Ads, or any Google service.'],
                    ['question' => 'How quickly does the verification email arrive in InboxOro?', 'answer' => 'Typically within 5 to 15 seconds. InboxOro\'s real-time inbox displays the verification automatically without manual refresh.'],
                ]),
                'is_active' => true,
            ],

            // ─────────────────────────────────────────────────────────────
            // 4. temp-mail-for-instagram-ads
            // ─────────────────────────────────────────────────────────────
            [
                'slug'             => 'temp-mail-for-instagram-ads',
                'title'            => 'Temp Mail for Instagram Ads Account – Free | InboxOro',
                'meta_description' => 'Use InboxOro free temp mail for Instagram Ads research. Explore ad formats and tools privately. Instant inbox, no registration required. Auto-deletes in 10 minutes.',
                'h1'               => 'Temp Mail for Instagram Ads — Study Visual Ad Formats Without Permanent Email Commitment',
                'category'         => 'use-case',
                'is_brand'         => true,
                'template'         => 'default',
                'intro_text'       => '
<p>Instagram Ads — delivered through Meta\'s advertising infrastructure — offers one of the most visually rich and format-diverse advertising environments in digital marketing, serving ads across Stories, Reels, Feed, Explore, and Shopping surfaces. The platform\'s creative format options, visual content requirements, and audience targeting capabilities make it a primary study subject for creative directors, brand marketers, social media managers, and advertising researchers. Like other Meta advertising products, Instagram\'s ad management is accessed through Meta\'s Business Manager — a system deeply integrated with Facebook and Instagram account identity. For users who want to research Instagram\'s advertising capabilities, study its creative format specifications, or access ad-related tools through email-based registration paths available in the research context, <strong>InboxOro</strong> is a free temporary email service used by advertising professionals for platform research and tool evaluation. InboxOro is not affiliated with Instagram, Meta, or any related advertising service.</p>

<p>InboxOro generates a disposable inbox automatically — no account, no personal data. For email-based registration paths where InboxOro applies, the verification email arrives in real time and InboxOro auto-deletes after 10 minutes.</p>

<h2>Instagram Ads Research Scenarios</h2>

<p><strong>Visual ad format and creative specification study:</strong> Creative professionals who develop advertising content for Instagram study the platform\'s format specifications — aspect ratios for Stories vs. Feed vs. Reels, video length requirements, interactive format options, and carousel structure guidelines. Accessing the platform\'s ad creation documentation and tools for this creative specification research uses InboxOro for any email-based account creation required during the research workflow.</p>

<p><strong>Influencer and branded content advertising research:</strong> Marketing researchers and brand strategists who study how Instagram\'s branded content advertising tools work — including the mechanics of paid partnership content, creator collaboration advertising, and influencer campaign management within the platform\'s ad system — use InboxOro for research account access where email-based paths are applicable.</p>

<p><strong>Shopping and e-commerce ad format evaluation:</strong> E-commerce professionals and digital retail strategists who evaluate Instagram\'s Shopping ad formats — understanding product catalogue integration, shoppable post mechanics, and Instagram Checkout functionality as advertising tools — access the platform\'s shopping advertising documentation through research accounts. InboxOro handles these research registrations where email-based paths are available.</p>

<p><strong>Creative testing and ad performance research:</strong> Marketing analysts who study the relationship between creative format choices and ad performance on Instagram — understanding how Stories ads compare with Feed ads, how Reels ad performance differs by content type — access the platform\'s ad management and analytics tools through research accounts. InboxOro is used for email-based research account creation in this context.</p>

<p><strong>Developer integration and automation research:</strong> Developers building social media management tools, creative production automation, or marketing dashboard integrations that connect with Meta\'s Marketing API for Instagram ad management use test accounts during development. InboxOro provides the email for test account creation where applicable.</p>

<ul>
  <li><strong>Visual format specification research</strong> — access creative tools for format research without marketing enrollment</li>
  <li><strong>Branded content and influencer ad research</strong> — study creator advertising tools and mechanics</li>
  <li><strong>Shopping ad format evaluation</strong> — assess e-commerce advertising capabilities before commitment</li>
  <li><strong>Ad performance and creative testing research</strong> — study format performance relationships</li>
  <li><strong>Developer API integration testing</strong> — develop Meta API integrations with test accounts</li>
  <li><strong>Note on Meta account integration</strong> — Instagram Ads is primarily Meta-account-integrated; InboxOro applies to email-based paths</li>
  <li><strong>Real-time verification delivery</strong> — activation arrives within seconds where applicable</li>
  <li><strong>Completely free</strong> — advertising research at zero cost</li>
</ul>

<p><em>InboxOro is not affiliated with, endorsed by, or officially connected to Instagram, Meta Platforms, Inc., or any related service. Instagram is a trademark of Meta Platforms, Inc. InboxOro is an independent disposable email service used by individuals for private advertising platform research.</em></p>',
                'faq' => json_encode([
                    ['question' => 'Can I use InboxOro for Instagram Ads research without my real email?', 'answer' => 'InboxOro applies to email-based registration paths in advertising platforms. Instagram Ads is managed through Meta\'s Business Manager, which is primarily integrated with Meta account identity. For email-based paths where available, InboxOro provides a free temporary email. InboxOro is not affiliated with Instagram or Meta.'],
                    ['question' => 'Is InboxOro useful for creative professionals researching Instagram ad formats?', 'answer' => 'Yes. Creative professionals studying Instagram\'s ad format specifications and creative requirements use InboxOro for research account creation where email-based registration paths are applicable.'],
                    ['question' => 'Should I use real email for active Instagram Ads campaign management?', 'answer' => 'Yes. Active campaign management accounts with real budgets require permanent email for billing notifications, account alerts, and campaign communications.'],
                    ['question' => 'Is InboxOro free for advertising research?', 'answer' => 'Yes. InboxOro is completely free — no subscription, no InboxOro account, no cost of any kind.'],
                    ['question' => 'Is InboxOro affiliated with Instagram or Meta?', 'answer' => 'No. InboxOro is a fully independent disposable email service with no affiliation, partnership, or official connection to Instagram, Meta Platforms, Inc., or any related service.'],
                    ['question' => 'How quickly does verification arrive in InboxOro?', 'answer' => 'Typically within 5 to 15 seconds. InboxOro\'s real-time inbox displays the verification email automatically without manual refresh.'],
                ]),
                'is_active' => true,
            ],

            // ─────────────────────────────────────────────────────────────
            // 5. temp-mail-for-ad-testing
            // ─────────────────────────────────────────────────────────────
            [
                'slug'             => 'temp-mail-for-ad-testing',
                'title'            => 'Temp Mail for Ad Testing – Free | InboxOro',
                'meta_description' => 'Use InboxOro free temp mail for ad testing workflows. Create test accounts for ad verification. Instant inbox, no registration, real-time delivery. Auto-deletes in 10 min.',
                'h1'               => 'Temp Mail for Ad Testing — Clean Test Inboxes for Every Ad Verification Workflow',
                'category'         => 'use-case',
                'is_brand'         => false,
                'template'         => 'default',
                'intro_text'       => '
<p>Ad testing — the systematic evaluation of advertising creative, copy, targeting, and delivery across digital advertising platforms — is one of the most email-dependent professional workflows in digital marketing. Testing different ad variations requires creating multiple test accounts to serve as the simulated audience perspective. Testing advertising flows that include email-based lead capture requires a real working inbox to receive lead confirmation emails. Testing retargeting and remarketing sequences requires accounts that can be tracked as they move through the advertising funnel. And testing advertising platform integrations in development environments requires test advertising accounts with functional email registration. For performance marketers, advertising developers, QA engineers, and marketing technologists who need clean, disposable test inboxes for any of these ad testing workflows, <strong>InboxOro</strong> provides a free temporary email for ad testing — zero setup, instant generation, and auto-deleting after 10 minutes.</p>

<p>InboxOro generates a fresh disposable inbox in one step — open a browser tab, and a unique temporary email address is ready for any ad testing workflow. Each InboxOro tab is an independent inbox. Multiple tabs support multi-account or multi-variant ad testing scenarios simultaneously. All inboxes auto-delete after the session window closes.</p>

<h2>Ad Testing Workflows Where InboxOro Is Most Useful</h2>

<p><strong>Lead generation ad email capture testing:</strong> Advertising campaigns that use lead generation ad formats — where the ad includes a built-in form that captures the viewer\'s email address — produce confirmation emails and lead data that need to be tested as part of the campaign QA process. InboxOro provides the test email that completes a lead form submission, receives the follow-up confirmation email, and enables the complete lead capture-to-confirmation flow to be verified before the campaign goes live with real audience targeting.</p>

<p><strong>Ad click landing page and email flow testing:</strong> Campaigns where the ad click leads to a landing page with an email capture form — the most common performance marketing funnel structure — require testing of the full ad-to-landing-page-to-email-confirmation flow. InboxOro provides the inbox that receives the landing page form confirmation, enabling the marketer to verify that the confirmation email is dispatched correctly, formatted as designed, and delivered promptly before real campaign traffic is directed to the funnel.</p>

<p><strong>Retargeting pixel and email remarketing testing:</strong> Advertising flows that use email addresses for retargeting — custom audience matching, email-based remarketing lists, and CRM audience uploads — require test email addresses that can be included in test audience lists without polluting real audience data with test contacts. InboxOro provides throwaway email addresses for these test audience entries.</p>

<p><strong>Multi-variant ad account testing:</strong> A/B testing and multivariate ad testing that requires multiple distinct test accounts — each representing a different user type, demographic segment, or testing variant — uses InboxOro\'s tab-per-inbox model to create the required number of distinct test accounts rapidly. Each InboxOro tab provides an independent address and inbox for each test variant account.</p>

<p><strong>Advertising platform integration and webhook testing:</strong> Marketing automation integrations that connect advertising platforms with CRM systems, email marketing tools, and analytics platforms via webhooks and API calls generate email confirmations and data payloads that need to be tested in staging and development environments. InboxOro provides the test email endpoints for these integration test scenarios.</p>

<ul>
  <li><strong>Lead gen ad email capture testing</strong> — test the complete lead capture and confirmation flow</li>
  <li><strong>Ad-to-landing-page email flow testing</strong> — verify full funnel email delivery before live traffic</li>
  <li><strong>Retargeting test audience creation</strong> — disposable emails for test audience lists</li>
  <li><strong>Multi-variant account testing</strong> — independent inbox per test variant with tab-per-inbox model</li>
  <li><strong>Integration and webhook email testing</strong> — test CRM and automation platform email flows</li>
  <li><strong>Real-time confirmation delivery</strong> — test confirmation emails arrive within seconds</li>
  <li><strong>Auto-delete between test runs</strong> — clean inbox state for each new test iteration</li>
  <li><strong>Completely free, unlimited test accounts</strong> — no cost per test inbox created</li>
</ul>

<p><em>InboxOro is not affiliated with any advertising platform, marketing automation tool, or CRM service. This page describes InboxOro\'s use as a temporary email for advertising testing workflows across all ad testing scenarios.</em></p>',
                'faq' => json_encode([
                    ['question' => 'Can performance marketers use InboxOro for lead generation ad testing?', 'answer' => 'Yes. InboxOro provides test email addresses for lead generation ad form submissions — enabling the complete lead capture-to-confirmation email flow to be tested and verified before live campaign deployment.'],
                    ['question' => 'How does InboxOro support multi-variant ad testing?', 'answer' => 'Open one InboxOro browser tab per test variant or test account required — each tab provides an independent address and inbox. Each variant has its own isolated email environment for clean test data.'],
                    ['question' => 'Can InboxOro be used for retargeting test audience creation?', 'answer' => 'Yes. InboxOro email addresses can be included in test audience lists for retargeting and remarketing test scenarios without polluting real audience data with permanent test contacts.'],
                    ['question' => 'Does InboxOro auto-clean between ad test runs?', 'answer' => 'Yes. Each InboxOro tab auto-deletes after 10 minutes, ensuring clean inbox state for each new test iteration without manual cleanup.'],
                    ['question' => 'Is InboxOro free for ad testing?', 'answer' => 'Yes. InboxOro is completely free — no subscription, no registration, no cost per test inbox.'],
                    ['question' => 'Is InboxOro affiliated with any advertising platform?', 'answer' => 'No. InboxOro is a fully independent disposable email service with no affiliation or connection to any advertising platform, marketing automation tool, or CRM service.'],
                ]),
                'is_active' => true,
            ],

        ];

        foreach ($pages as $page) {
            SeoPage::create($page);
        }

        $this->command->info('✅ Batch MKT1: 5 SEO Pages created successfully!');
    }
}