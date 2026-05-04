<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeoPage;

class SeoPageSeederBatchD2 extends Seeder
{
    // php artisan db:seed --class=SeoPageSeederBatchD2
    // Covers: temp-email-for-ecommerce, temp-email-for-freelancers,
    //         temp-email-for-online-business, temp-email-for-digital-marketing,
    //         temp-email-for-saas-users

    public function run(): void
    {
        $slugs = [
            'temp-email-for-ecommerce',
            'temp-email-for-freelancers',
            'temp-email-for-online-business',
            'temp-email-for-digital-marketing',
            'temp-email-for-saas-users',
        ];

        SeoPage::whereIn('slug', $slugs)->delete();
        $this->command->info('🗑️  Deleted existing records for Batch D2 slugs.');

        $pages = [

            [
                'slug'             => 'temp-email-for-ecommerce',
                'title'            => 'Temp Email for Ecommerce – Free Disposable Inbox | InboxOro',
                'meta_description' => 'Ecommerce professionals: use InboxOro free temp email for store research, supplier signups & testing. Instant inbox, no registration. Auto-deletes in 10 min.',
                'h1'               => 'Temp Email for Ecommerce — Research Suppliers, Test Stores, Protect Your Inbox',
                'intro_text'       => '
<p>Running an ecommerce business means constantly evaluating new suppliers, platforms, tools, and competitors. Every supplier portal you register with, every competing store you create a test account on, every SaaS tool you trial during the evaluation phase — each one asks for your email and adds it to a database that will market to you indefinitely. <strong>InboxOro</strong> gives ecommerce operators a free disposable email for every evaluation signup, keeping the operational inbox — the one handling customer orders, supplier communications, and logistics — clean and focused on the business that actually matters.</p>

<p>For dropshippers, private label sellers, wholesale buyers, and digital product creators alike, InboxOro'."'".'s 10-minute auto-deleting inbox handles the email verification step at every stage of business research and tool evaluation. No registration on InboxOro'."'".'s side. No cost. No inbox pollution from the dozens of platforms that get evaluated but not adopted.</p>

<h2>Ecommerce Use Cases for Temp Email</h2>

<p><strong>Supplier and wholesale platform registration:</strong> Many supplier directories, wholesale portals, and B2B sourcing platforms require email registration for access. Using InboxOro for these registrations during the evaluation phase — before confirming that a supplier relationship is worth pursuing — keeps the sourcing research separate from the main business inbox.</p>

<p><strong>Competitor store research:</strong> Creating customer accounts on competitor stores to understand their user experience, pricing communication, and post-purchase email flows is standard ecommerce competitive research. InboxOro handles the registration email without your real address entering the competitor'."'".'s customer database.</p>

<p><strong>Platform and tool evaluation:</strong> Ecommerce platforms, inventory management systems, fulfillment tools, customer support systems, and analytics platforms all require signup before they show the product. InboxOro for evaluation signups prevents the assessment phase from creating permanent marketing relationships with tools that may not make the final stack.</p>

<p><strong>Post-purchase email flow testing:</strong> Testing your own store'."'".'s automated email sequences — order confirmations, shipping notifications, review requests — requires going through the purchase flow with a test email address. InboxOro provides that address without cluttering any permanent inbox.</p>

<ul>
  <li><strong>Supplier research signups</strong> — keep sourcing research separate from operational email</li>
  <li><strong>Competitor store accounts</strong> — study UX and email flows anonymously</li>
  <li><strong>Tool evaluation</strong> — assess platforms without permanent marketing relationships</li>
  <li><strong>Store email testing</strong> — validate automated sequences end-to-end</li>
  <li><strong>Free and unlimited</strong> — no cost for unlimited evaluation signups</li>
  <li><strong>Auto-cleanup</strong> — 10-minute deletion; no ongoing management</li>
</ul>

<h2>Protecting Ecommerce Operations With Temp Email</h2>

<p>An ecommerce operator'."'".'s real email addresses handle critical business communications: supplier invoices, logistics updates, customer service escalations, payment notifications, and platform alerts. When these inboxes fill with marketing noise from dozens of evaluated-but-not-adopted tools, the operational risk is real — important communications get buried, response times slow, and the business suffers.</p>

<p>InboxOro'."'".'s role in ecommerce operations is simple: keep the evaluation and research phase email traffic completely separate from the operational email traffic. Every tool evaluation signup through InboxOro is one fewer marketing pipeline reaching the email addresses that run the business. That separation is worth maintaining — and InboxOro makes it effortless and free.</p>',
                'faq' => json_encode([
                    ['question' => 'How do ecommerce operators use InboxOro temp email?', 'answer' => 'For supplier research registrations, competitor store accounts, tool evaluation signups, and own-store email flow testing — keeping all of this research-phase email separate from operational business inboxes.'],
                    ['question' => 'Can InboxOro be used to test ecommerce automated email sequences?', 'answer' => 'Yes. Use an InboxOro address to go through your store\'s purchase flow and confirm that order confirmations, shipping notifications, and review requests arrive correctly and render as intended.'],
                    ['question' => 'Is InboxOro free for ecommerce professionals?', 'answer' => 'Yes. No subscription, no registration, no cost. Unlimited evaluation signups for ecommerce research using InboxOro at zero cost.'],
                    ['question' => 'Can ecommerce operators study competitor email flows using InboxOro?', 'answer' => 'Yes. Creating competitor customer accounts using InboxOro addresses allows analysis of competitor post-purchase email sequences without real email entering competitor databases.'],
                    ['question' => 'Does InboxOro render ecommerce HTML emails correctly for testing?', 'answer' => 'Yes. InboxOro renders full HTML email content including product images, promotional layouts, and clickable buttons — accurate representation of how emails appear to real customers.'],
                    ['question' => 'How quickly do ecommerce test emails arrive in InboxOro?', 'answer' => 'Within 5 to 15 seconds in most cases. Real-time delivery makes InboxOro useful for testing time-sensitive ecommerce communications like order confirmations.'],
                ]),
                'is_active' => true,
            ],

            [
                'slug'             => 'temp-email-for-freelancers',
                'title'            => 'Temp Email for Freelancers – Free Disposable Inbox | InboxOro',
                'meta_description' => 'Freelancers: use InboxOro free temp email to evaluate platforms, research clients & protect your professional inbox. Instant, no signup. Auto-deletes in 10 min.',
                'h1'               => 'Temp Email for Freelancers — Evaluate Platforms, Research Clients, Stay Professional',
                'intro_text'       => '
<p>Freelancers navigate a landscape of platforms, tools, and client relationships that creates a persistent email management challenge. Freelance marketplaces need evaluation before commitment. Client-side tools and platforms need assessment before integration. New project management and invoicing tools need testing before adoption. And throughout all of this evaluation activity, the professional inbox — the one where client communications, project updates, and payment notifications live — must remain clean and reliable. <strong>InboxOro</strong> is the free disposable email tool that handles the evaluation phase for freelancers, protecting the professional inbox from the noise of the exploration process.</p>

<p>For writers, designers, developers, consultants, and any other independent professionals whose business runs through their email, inbox quality is directly connected to professional performance. An inbox that contains hundreds of marketing emails from evaluated-but-discarded platforms alongside real client communications is harder to manage, slower to respond to, and more likely to result in missed opportunities. InboxOro prevents this by taking evaluation-phase email completely out of the professional inbox.</p>

<h2>Freelancer Use Cases for Temp Email</h2>

<p><strong>Freelance platform evaluation:</strong> Platforms commonly used by freelancers for finding work — including marketplaces, job boards, and professional networks — require email registration to access their full feature sets. Using InboxOro for evaluation signups allows freelancers to assess platforms before deciding which ones deserve their real professional email.</p>

<p><strong>Tool and software evaluation:</strong> Project management tools, time tracking applications, invoicing software, contract management platforms, and portfolio hosting services all require signup. InboxOro handles evaluation signups for each category, allowing genuine assessment without inbox commitment.</p>

<p><strong>Client research:</strong> Before engaging with a potential client, freelancers often research their digital presence — including the products and services they offer. When this research involves signup to understand a client'."'".'s platform or service, InboxOro provides the email for that research without exposing the freelancer'."'".'s professional email to the client'."'".'s marketing system before any professional relationship exists.</p>

<p><strong>Skills development platform research:</strong> Online learning platforms, certification programmes, and professional development resources require email signup. InboxOro handles the initial evaluation signup, with the option to update to a real email if the resource proves genuinely valuable.</p>

<ul>
  <li><strong>Platform evaluation</strong> — assess freelance marketplaces before committing real email</li>
  <li><strong>Tool assessment</strong> — test professional tools during evaluation without inbox commitment</li>
  <li><strong>Client research</strong> — understand client platforms privately</li>
  <li><strong>Skills platform research</strong> — evaluate courses and certifications without permanent subscription</li>
  <li><strong>Professional inbox protection</strong> — keep client communications uncluttered</li>
  <li><strong>Free, instant</strong> — no cost or registration overhead for evaluation signups</li>
</ul>

<p>The freelancer'."'".'s professional inbox is a business asset. Every marketing email from a discarded tool evaluation is noise that reduces the usefulness of that asset. InboxOro'."'".'s role in the freelancer workflow is protecting that asset during the inevitable and necessary process of platform and tool exploration — keeping the professional inbox clean enough to run a professional business through.</p>',
                'faq' => json_encode([
                    ['question' => 'How do freelancers use InboxOro in their professional workflow?', 'answer' => 'Freelancers use InboxOro for platform evaluation signups, tool assessments, and client research — keeping exploration-phase email separate from the professional inbox used for client communications and project management.'],
                    ['question' => 'Can freelancers use InboxOro to evaluate freelance marketplace platforms?', 'answer' => 'Yes. Sign up for any freelance marketplace using an InboxOro address during the evaluation phase. If the platform proves valuable, update the account to your real professional email before committing.'],
                    ['question' => 'Is InboxOro free for freelancers?', 'answer' => 'Yes, completely free. No registration, no subscription required. Freelancers can use InboxOro for any evaluation or research signup at zero cost.'],
                    ['question' => 'How does InboxOro protect a freelancer\'s professional reputation?', 'answer' => 'By keeping the professional inbox clean and responsive. When client communications are not buried under evaluation-phase marketing noise, response times improve and professional relationships are managed more effectively.'],
                    ['question' => 'Can freelancers use InboxOro for client platform research?', 'answer' => 'Yes. Understanding a potential client\'s platform or product by signing up during pre-engagement research can be done with an InboxOro address — keeping the research separate from any professional relationship.'],
                    ['question' => 'Does InboxOro work on mobile for freelancers working remotely?', 'answer' => 'Yes. InboxOro is fully mobile-responsive and works in any mobile browser — ideal for freelancers who evaluate tools and platforms while working from anywhere.'],
                ]),
                'is_active' => true,
            ],

            [
                'slug'             => 'temp-email-for-online-business',
                'title'            => 'Temp Email for Online Business – Free Disposable Inbox | InboxOro',
                'meta_description' => 'Online business owners: use InboxOro free temp email to research tools, test systems & protect operational inboxes. Instant, no signup. Auto-deletes in 10 min.',
                'h1'               => 'Temp Email for Online Business — Keep Your Operations Running Clean',
                'intro_text'       => '
<p>Running an online business creates a constant flow of tool evaluations, platform signups, supplier registrations, and competitive research activities — all of which require email addresses and all of which generate ongoing email communications from the platforms they involve. For online business owners who depend on their email for customer communications, operational alerts, and financial notifications, the inbox noise generated by business research is not just annoying — it is an operational liability. <strong>InboxOro</strong> solves this by providing a free, instant disposable email for every research and evaluation signup, keeping the noise completely separate from the communications that run the business.</p>

<p>Online businesses — whether content businesses, service businesses, SaaS products, or physical product sellers operating online — share the common characteristic that email is foundational infrastructure. The business depends on reliable email for customer support, payment notifications, platform alerts, and team communication. Protecting that infrastructure from the inevitable noise of online business research is a genuine operational priority, and InboxOro provides the tool to do it at zero cost.</p>

<h2>Online Business Use Cases for Temp Email</h2>

<p><strong>Business tool and platform evaluation:</strong> Online businesses evaluate an enormous range of tools — payment processors, customer support platforms, analytics services, hosting providers, CDN services, email marketing tools, and more. Each evaluation starts with signup. InboxOro handles the signup step without committing the business email to each platform'."'".'s marketing database during the assessment phase.</p>

<p><strong>Supplier and partner research:</strong> Evaluating potential suppliers, partners, or service providers often requires creating an account to access their pricing or product information. InboxOro provides the email for this research phase without creating a permanent data relationship with each supplier evaluated.</p>

<p><strong>Market and competitor research:</strong> Understanding the competitive landscape requires first-hand experience of competitor products and services. InboxOro handles the signup step for competitor research accounts without the business'."'".'s real email entering competitor databases.</p>

<p><strong>Testing business email systems:</strong> Confirming that the business'."'".'s own email automation — order confirmations, support ticket responses, payment receipts — works correctly requires test email addresses. InboxOro provides clean, isolated test inboxes for each test scenario.</p>

<ul>
  <li><strong>Tool evaluation</strong> — assess business software without permanent marketing relationships</li>
  <li><strong>Supplier research</strong> — explore supplier options without real email commitment</li>
  <li><strong>Competitor research</strong> — study competitor products anonymously</li>
  <li><strong>System testing</strong> — test business email automation with clean inboxes</li>
  <li><strong>Operational inbox protection</strong> — keep business-critical email uncluttered</li>
  <li><strong>Free, unlimited</strong> — no budget required for research email addresses</li>
</ul>

<p>For online business owners who understand that their email infrastructure is foundational to their operations, InboxOro is the straightforward tool for keeping that infrastructure clean during the inevitable and necessary process of running and growing a business online. It costs nothing. It requires nothing. It protects everything that matters about the operational inbox.</p>',
                'faq' => json_encode([
                    ['question' => 'How do online business owners use InboxOro temp email?', 'answer' => 'For tool evaluations, supplier research, competitor analysis, and testing their own email systems — keeping all exploration-phase email separate from the operational inboxes that run the business.'],
                    ['question' => 'Is InboxOro suitable for testing business email automation?', 'answer' => 'Yes. InboxOro provides clean, isolated test inboxes for validating that business email automation — order confirmations, support responses, payment receipts — works correctly before it reaches real customers.'],
                    ['question' => 'Is InboxOro free for online businesses?', 'answer' => 'Yes. No subscription, no registration, no cost. Online businesses can use InboxOro for unlimited research and testing signups at zero cost.'],
                    ['question' => 'Can InboxOro protect a business\'s operational email from research noise?', 'answer' => 'Yes. By using InboxOro for all non-essential signups, online businesses keep their operational inboxes — the ones handling customer and supplier communications — free from marketing noise generated by tool and platform evaluation activity.'],
                    ['question' => 'How does InboxOro help with supplier and partner research?', 'answer' => 'InboxOro provides the email address for supplier platform registrations during the evaluation phase, preventing the business\'s real email from entering supplier marketing databases before a real business relationship is established.'],
                    ['question' => 'Can multiple team members in an online business use InboxOro?', 'answer' => 'Yes. Each team member uses InboxOro independently in their own browser. For shared account signups, copy the same address and complete the verification within the 10-minute window across team devices.'],
                ]),
                'is_active' => true,
            ],

            [
                'slug'             => 'temp-email-for-digital-marketing',
                'title'            => 'Temp Email for Digital Marketing – Free | InboxOro',
                'meta_description' => 'Digital marketers: use InboxOro free temp email for ad research, funnel testing & competitor analysis. Instant inbox, no registration. Auto-deletes in 10 min.',
                'h1'               => 'Temp Email for Digital Marketing — Research Deeper Without Polluting Your Inbox',
                'intro_text'       => '
<p>Digital marketing is a research-intensive discipline. Understanding what competitors are running, how funnels convert, what ad copy performs, and how landing pages are structured requires hands-on experience — creating accounts, going through flows, and observing the complete user journey from first contact to converted customer. Every step of this research involves email, and every email involved creates a data relationship that generates ongoing communications from the platforms and products being studied. <strong>InboxOro</strong> handles the email step of digital marketing research cleanly and privately — providing a free, instant disposable inbox for every signup in the research workflow without any of the long-term inbox consequences.</p>

<p>Digital marketers who use their real email for competitive research end up with inboxes overwhelmed by marketing from products they analysed once and will never promote. Digital marketers who use InboxOro keep the research phase completely separate — getting the hands-on experience they need for quality analysis without the lasting email relationships that come with using a real address.</p>

<h2>Digital Marketing Research Use Cases for Temp Email</h2>

<p><strong>Competitor ad and funnel research:</strong> Studying competitor funnels requires going through them — clicking ads, visiting landing pages, opting in, and experiencing the follow-up email sequence. InboxOro provides the email for the opt-in step, allowing full funnel observation without the marketer'."'".'s real email entering the competitor'."'".'s marketing database.</p>

<p><strong>Ad network and traffic source evaluation:</strong> Evaluating new ad networks, traffic sources, and media buying platforms requires creating accounts to access their dashboards and pricing. InboxOro handles the signup step during evaluation without committing real email to platforms that may not make the final media plan.</p>

<p><strong>Landing page and opt-in form testing:</strong> Before launching a campaign, digital marketers test their own landing pages and opt-in forms by going through the user flow with a test email. InboxOro provides that test email — confirming that the opt-in triggers the correct autoresponder, that the email arrives promptly, and that the content renders correctly.</p>

<p><strong>Marketing tool and platform evaluation:</strong> Analytics platforms, split testing tools, heatmap services, conversion optimisation tools, and CRO platforms all require signup. InboxOro for these evaluation signups prevents the assessment phase from permanently adding the marketer to dozens of platform marketing databases.</p>

<ul>
  <li><strong>Competitor funnel research</strong> — experience full funnels anonymously</li>
  <li><strong>Ad network evaluation</strong> — access platform dashboards during assessment</li>
  <li><strong>Landing page opt-in testing</strong> — validate autoresponder delivery end-to-end</li>
  <li><strong>Marketing tool evaluation</strong> — assess platforms without permanent email commitment</li>
  <li><strong>Free, instant</strong> — no cost or overhead for research email addresses</li>
  <li><strong>Real-time inbox</strong> — research emails arrive within seconds</li>
</ul>

<p>Digital marketing research requires depth. That depth requires hands-on access. That access requires email. InboxOro provides the email for every research touchpoint — free, instant, and auto-deleting — so that the research can be as deep and hands-on as the analysis requires without the professional inbox paying the price for it.</p>',
                'faq' => json_encode([
                    ['question' => 'How do digital marketers use InboxOro for research?', 'answer' => 'For competitor funnel research, ad network evaluations, landing page testing, and marketing tool assessments — getting hands-on research access without real email entering every platform researched.'],
                    ['question' => 'Can InboxOro be used to test opt-in forms and autoresponder delivery?', 'answer' => 'Yes. Use an InboxOro address to opt in through your own form and confirm that the autoresponder triggers, arrives promptly, and renders correctly — complete opt-in flow validation in one step.'],
                    ['question' => 'Is InboxOro free for digital marketing professionals?', 'answer' => 'Yes, completely free. No registration, no subscription, no cost. Unlimited research and testing signups for digital marketers at zero cost.'],
                    ['question' => 'Can digital marketers experience full competitor funnels using InboxOro?', 'answer' => 'Yes. Use an InboxOro address for competitor opt-in steps to experience the complete follow-up email sequence during the 10-minute window and beyond — the account remains active even after the temp address expires.'],
                    ['question' => 'How quickly do marketing test emails arrive in InboxOro?', 'answer' => 'Typically within 5 to 15 seconds. Real-time delivery makes InboxOro ideal for confirming autoresponder timing and delivery speed during campaign testing.'],
                    ['question' => 'Does InboxOro render marketing email HTML accurately for testing?', 'answer' => 'Yes. InboxOro renders full HTML marketing emails including images, promotional layouts, and clickable elements — giving an accurate view of how campaigns appear to real subscribers.'],
                ]),
                'is_active' => true,
            ],

            [
                'slug'             => 'temp-email-for-saas-users',
                'title'            => 'Temp Email for SaaS Users – Free Disposable Inbox | InboxOro',
                'meta_description' => 'SaaS users: use InboxOro free temp email to trial tools, compare platforms & avoid signup spam. Instant inbox, no registration. Auto-deletes in 10 minutes.',
                'h1'               => 'Temp Email for SaaS Users — Trial Everything, Commit Only When It Earns It',
                'intro_text'       => '
<p>The modern professional uses an average of a dozen or more SaaS tools for their work — and evaluates considerably more before settling on the stack they actually keep. Each evaluation starts the same way: visit the website, click "Start Free Trial" or "Sign Up Free," provide an email address, and receive a verification or welcome email. For professionals who evaluate SaaS tools regularly — and that includes virtually every knowledge worker — this pattern creates a relentless accumulation of marketing emails from tools evaluated and discarded over weeks and months of exploration. <strong>InboxOro</strong> breaks this pattern: a free, instant disposable email for every trial signup that protects the real inbox from the marketing consequences of active software evaluation.</p>

<p>Using InboxOro for SaaS trial signups does not mean evaluating with less information — it means evaluating without the long-term inbox obligation. The trial account works identically with an InboxOro address as with a real one. The product is accessible. The features are explorable. The decision can be made with full information. The only difference is that if the decision is "not this one," the platform has no ongoing path to your inbox. And if the decision is "yes, this one," update the account email to your real address before InboxOro'."'".'s window closes — and transition to a fully committed account with permanent email access.</p>

<h2>SaaS Evaluation Workflow With InboxOro</h2>

<p><strong>Discovery phase:</strong> When researching SaaS options for a specific need — project management, CRM, analytics, customer support, design, development — the initial research phase often involves browsing multiple product websites. Some of these websites gate their pricing or feature information behind email registration. InboxOro handles this early-stage access without committing to a marketing relationship with products that may not make the shortlist.</p>

<p><strong>Trial phase:</strong> When starting a free trial on a shortlisted product, InboxOro provides the email for the trial signup. The trial runs normally. Features are evaluated. A decision is formed. If the product does not make the cut, the InboxOro address has already expired — no ongoing marketing. If it does, the email is updated to a real address in account settings.</p>

<p><strong>Comparison phase:</strong> Running trials of competing products simultaneously is a common SaaS evaluation strategy. InboxOro'."'".'s unlimited multiple-inbox capability — one per browser tab — means each competing product gets its own disposable address, keeping the comparison trials completely separate.</p>

<ul>
  <li><strong>Discovery signups</strong> — access gated pricing and features without early commitment</li>
  <li><strong>Trial signups</strong> — evaluate fully without permanent marketing relationships</li>
  <li><strong>Parallel trials</strong> — multiple simultaneous inboxes for competing product comparison</li>
  <li><strong>Clean transition</strong> — update to real email for products that earn commitment</li>
  <li><strong>Inbox protection</strong> — only committed tools reach the real inbox</li>
  <li><strong>Free, instant</strong> — no overhead cost for any trial signup</li>
</ul>

<p>The principle underlying InboxOro'."'".'s value for SaaS users is simple: the real email address should go to the products that earn it. The trial period is precisely the time to evaluate whether a product has earned it — and InboxOro provides the email address for that period, expiring cleanly when the evaluation is complete, leaving the decision entirely in the user'."'".'s hands rather than the platform'."'".'s marketing automation.</p>',
                'faq' => json_encode([
                    ['question' => 'How does InboxOro help SaaS users evaluate tools without inbox clutter?', 'answer' => 'By providing a disposable email for trial signups. SaaS tools that do not make the final stack never get a permanent email channel — the InboxOro address expires, and the inbox stays clear for the tools that were actually chosen.'],
                    ['question' => 'Can SaaS users run parallel trials using InboxOro?', 'answer' => 'Yes. Open multiple InboxOro tabs — each generates a unique isolated inbox for a different SaaS trial. Compare competing products simultaneously with clean, separate email addresses for each.'],
                    ['question' => 'How do I transition from an InboxOro address to my real email when I decide to keep a SaaS tool?', 'answer' => 'Update your email in the SaaS platform\'s account settings before the InboxOro window closes. Most platforms support email updates — verify the new address and transition to full committed account status.'],
                    ['question' => 'Is InboxOro free for SaaS trial signups?', 'answer' => 'Yes, completely free. No subscription, no registration required. Unlimited SaaS trial signups using InboxOro at zero cost.'],
                    ['question' => 'Do SaaS platforms accept InboxOro email addresses for trial signups?', 'answer' => 'The vast majority do. InboxOro rotates domains to maintain high acceptance. A small number of platforms may block known disposable domains — generating a new address often resolves this.'],
                    ['question' => 'Can InboxOro be used to access gated SaaS pricing and feature information?', 'answer' => 'Yes. Many SaaS platforms gate pricing or feature details behind email registration. InboxOro handles this early-stage access without creating a permanent marketing relationship with products still in the research phase.'],
                ]),
                'is_active' => true,
            ],

        ];

        foreach ($pages as $page) {
            SeoPage::create($page);
        }

        $this->command->info('✅ Batch D2: 5 SEO Pages created successfully!');
    }
}