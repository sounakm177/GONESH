<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeoPage;

class SeoPageSeederFeatures1 extends Seeder
{
    // php artisan db:seed --class=SeoPageSeederFeatures1
    // Pages: free-temp-mail-no-login, free-temp-mail-no-signup,
    //        temp-mail-with-inbox-access, temp-mail-with-attachment-support,
    //        temp-mail-with-custom-domain

    public function run(): void
    {
        $slugs = [
            'free-temp-mail-no-login',
            'free-temp-mail-no-signup',
            'temp-mail-with-inbox-access',
            'temp-mail-with-attachment-support',
            'temp-mail-with-custom-domain',
        ];

        SeoPage::whereIn('slug', $slugs)->delete();
        $this->command->info('🗑️  Deleted existing records for Features Batch 1 slugs.');

        $pages = [

            // ─────────────────────────────────────────────────────────────
            // 1. free-temp-mail-no-login
            // ─────────────────────────────────────────────────────────────
            [
                'slug'             => 'free-temp-mail-no-login',
                'title'            => 'Free Temp Mail No Login – Instant Inbox | InboxOro',
                'meta_description' => 'Get free temp mail with no login required. InboxOro generates your disposable inbox instantly — just open and use. Auto-deletes in 10 minutes.',
                'h1'               => 'Free Temp Mail With No Login — Your Inbox Is Ready Before You Even Ask',
                'intro_text'       => '
<p>The requirement to log in before you can do anything is one of the most pervasive friction points on the modern internet. Even services that exist specifically to reduce friction for their users often require a login step that introduces the very overhead they claim to eliminate. Temp mail services that ask you to log in before generating a disposable inbox are missing the point almost entirely. <strong>InboxOro</strong> is built around the opposite principle: you should have a working temp mail inbox before you need to do anything — no login, no account, no barrier of any kind between you and a functional anonymous email address.</p>

<p>When you visit InboxOro, the page loads and your temp mail address is already there. Generated automatically, displayed prominently, ready to copy. The inbox is live. Emails sent to that address will appear in real time. There is no login button to click, no username to enter, no password to type or remember, and no "forgot password" flow that would require yet another email address. The service simply begins the moment you arrive.</p>

<h2>Why No-Login Temp Mail Is the Correct Design</h2>

<p>Login requirements exist for one reason: to link a session to a persistent identity. A platform needs to know who you are when you return to it, so that it can show you your data, maintain your preferences, and provide continuity across sessions. This makes perfect sense for a bank, an email client, a social platform, or a professional tool you use every day.</p>

<p>It makes no sense whatsoever for a temp mail service. A temp mail inbox is designed to not persist. It should not exist after 10 minutes. There is no "returning" to it. There is no data to maintain across sessions. There is no continuity to provide. The entire value proposition of temp mail is its disposability — and a login requirement is the opposite of disposable. Login is commitment; temp mail is impermanence. They are philosophically incompatible.</p>

<p>InboxOro honours this philosophical alignment in its design. Because there is nothing to persist, there is nothing to log in to. Because there is nothing to log in to, there is no login step. And because there is no login step, getting a temp mail address is as fast and frictionless as it should be.</p>

<ul>
  <li><strong>Zero login friction</strong> — the inbox exists before you interact with the page</li>
  <li><strong>No password to create or remember</strong> — there is no account that needs a password</li>
  <li><strong>No session management</strong> — each browser tab is its own independent temp mail session</li>
  <li><strong>No "forgot password" flow</strong> — impossible to forget something that does not exist</li>
  <li><strong>Works on any device without credentials</strong> — open InboxOro anywhere and it just works</li>
  <li><strong>Completely free</strong> — no-login temp mail at zero cost, permanently</li>
</ul>

<h2>Practical Advantages of No-Login Temp Mail for Different Users</h2>

<p><strong>For everyday privacy users:</strong> The convenience of no-login temp mail means using InboxOro is faster than typing your real email address into a signup form. When the privacy-protecting option is also the fastest option, the right habit forms naturally without requiring discipline or deliberate effort.</p>

<p><strong>For users on shared or public devices:</strong> No login means no credentials stored on the device, no session to log out of, and no personal data left behind when you close the tab. InboxOro on a public computer is completely clean — the temp mail session leaves no trace.</p>

<p><strong>For developers and QA engineers:</strong> No-login temp mail integrates naturally into testing workflows because there is no authentication step to account for. Open InboxOro, copy the address, use it in the test, verify the email arrived, and close the tab. No account management. No login overhead between test runs.</p>

<p><strong>For users with privacy concerns about login:</strong> Creating an account on a temp mail service — even a privacy-focused one — creates a record linking your identity to your usage. No-login temp mail eliminates this record entirely. InboxOro knows nothing about who generated the inbox it just created.</p>

<p>Free temp mail with no login is not a feature — it is the correct way to build a temp mail service. Any additional barrier between a user and a working disposable inbox is a compromise of the core value proposition. InboxOro starts from the right place and stays there: inbox ready, login never required, everything deleted automatically in 10 minutes.</p>',
                'faq'              => json_encode([
                    ['question' => 'Do I really need no login to get a temp mail on InboxOro?', 'answer' => 'Correct. InboxOro requires zero login, zero registration, and zero personal information. Your temp mail inbox is generated automatically the moment the page loads — before you take any action.'],
                    ['question' => 'How does InboxOro work without a login system?', 'answer' => 'Because temp mail inboxes are disposable and non-persistent, there is nothing to log in to. InboxOro generates a unique inbox per browser session, delivers emails in real time, and deletes everything after 10 minutes — no identity or session tracking needed.'],
                    ['question' => 'Is no-login temp mail from InboxOro truly free?', 'answer' => 'Yes. No-login temp mail on InboxOro is completely free — no subscription, no premium tier, no payment of any kind. All features are available to every visitor at zero cost.'],
                    ['question' => 'Can I access the same no-login temp mail inbox from a different device?', 'answer' => 'Yes, by sharing the email address. Navigate to InboxOro on another device, then type or paste the exact email address — the inbox is accessible from any browser during the 10-minute window without any login required.'],
                    ['question' => 'Does using no-login temp mail leave any data on my device?', 'answer' => 'No. InboxOro stores no cookies, no credentials, and no session data beyond the active browser tab. When you close the tab, nothing related to your temp mail session remains on the device.'],
                    ['question' => 'How is no-login temp mail different from creating a throwaway Gmail account?', 'answer' => 'A throwaway Gmail still requires Google account registration — a name, phone number, and agreement to terms. InboxOro requires literally nothing. The inbox is ready before you interact with the page, with no identity data created anywhere.'],
                ]),
                'is_active' => true,
            ],

            // ─────────────────────────────────────────────────────────────
            // 2. free-temp-mail-no-signup
            // ─────────────────────────────────────────────────────────────
            [
                'slug'             => 'free-temp-mail-no-signup',
                'title'            => 'Free Temp Mail No Signup – Works Instantly | InboxOro',
                'meta_description' => 'Free temp mail with no signup on InboxOro. Get a disposable email instantly — no forms, no registration, no personal info. Auto-deletes in 10 minutes.',
                'h1'               => 'Free Temp Mail With No Signup — Zero Forms, Zero Friction, Instant Inbox',
                'intro_text'       => '
<p>Signing up to avoid signing up is the paradox that breaks many disposable email services before they can deliver their core value. You need a temp mail address because a website requires email for signup — and the temp mail service itself requires signup before it will give you the address. The result is more signup, not less. <strong>InboxOro</strong> resolves this paradox completely: free temp mail with no signup, no forms, no personal information, and no account creation of any kind. The inbox exists the moment you visit the site. Nothing before that is required.</p>

<p>The "no signup" principle at InboxOro is not just a feature — it is the entire operating philosophy of the service made concrete. Temp mail addresses are temporary. Temporary things do not need accounts. Accounts imply persistence, identity, and ongoing commitment — the exact opposite of what a disposable inbox represents. By building InboxOro without any signup mechanism, the service delivers on the promise of disposable email at the deepest architectural level: there is no user to sign up because there are no users. There are only sessions, each generating a unique inbox, each lasting 10 minutes, each disappearing completely when done.</p>

<h2>What No-Signup Temp Mail Looks Like in Practice</h2>

<p>The practical experience is disarmingly simple. You type InboxOro'."'".'s URL into your browser. The page loads. Your email address is there — not "will be generated after you complete the form," not "available after email verification," not "accessible once you choose a username and password." Just: there. Displayed, ready to copy, with a live inbox already accepting incoming messages.</p>

<p>The entire process from deciding you need a temp mail address to having one working takes under five seconds. The entire process from having the temp mail address to completing a signup on another website takes under two minutes. And the entire process of cleaning up after you are done takes zero seconds, because InboxOro does it automatically after 10 minutes.</p>

<p>This is what "no signup" actually means at InboxOro — not just the absence of a form on the site, but the complete absence of any overhead between you and a working disposable email inbox.</p>

<ul>
  <li><strong>No registration form</strong> — there is nothing to fill out, not even a single field</li>
  <li><strong>No username selection</strong> — the address is generated automatically; customise it if you want, but it is not required</li>
  <li><strong>No email verification</strong> — you do not need an existing email to get a temp email</li>
  <li><strong>No terms acceptance</strong> — no lengthy policy agreement standing between you and the inbox</li>
  <li><strong>No phone number</strong> — not asked for, not collected, not needed</li>
  <li><strong>No payment</strong> — free temp mail with no signup costs nothing at InboxOro</li>
</ul>

<h2>Who Benefits Most from No-Signup Temp Mail</h2>

<p><strong>First-time internet users:</strong> New internet users may find email signup processes confusing and intimidating. No-signup temp mail eliminates every step that requires digital literacy to navigate — there is nothing to understand except "copy this address and paste it where they ask for email."</p>

<p><strong>Users on borrowed or temporary devices:</strong> Someone using a friend'."'".'s phone, a hotel computer, or a library terminal needs a temp mail address without leaving any account footprint on a device they do not own. No-signup temp mail is ideal — no credentials entered, no account accessed, nothing to log out of.</p>

<p><strong>Privacy advocates:</strong> Every signup is a data point — even signups for privacy tools. No-signup temp mail from InboxOro creates no data point. The session generates the inbox and then InboxOro forgets it existed.</p>

<p><strong>Developers testing email systems:</strong> Test workflows that involve email delivery need working inboxes that can be created instantly without friction. No-signup temp mail integrates seamlessly into testing workflows because there is no account management between test cases — just open InboxOro, copy the address, run the test.</p>

<p>Free temp mail with no signup is the purest expression of what disposable email should be: immediate, anonymous, effortless, and impermanent. InboxOro delivers this experience to every visitor, on every device, at every moment — permanently free, permanently zero-signup, permanently ready.</p>',
                'faq'              => json_encode([
                    ['question' => 'Is InboxOro\'s temp mail really free with no signup at all?', 'answer' => 'Yes. InboxOro requires zero signup, zero registration, and zero personal information. The temp mail inbox is generated automatically the moment you visit the site — no forms, no steps, nothing required.'],
                    ['question' => 'Why does InboxOro not require signup when other services do?', 'answer' => 'Because temp mail inboxes are temporary and non-persistent — there is nothing to sign up for. Signup implies an ongoing account; InboxOro creates inboxes that exist for 10 minutes and then self-delete. No account is needed for that.'],
                    ['question' => 'Can I use InboxOro no-signup temp mail on a device I don\'t own?', 'answer' => 'Yes, and it is ideal for this. No signup means no credentials entered on the device, no account to log out of, and nothing left behind when you close the tab — perfect for borrowed or public devices.'],
                    ['question' => 'Does no-signup temp mail from InboxOro receive emails as reliably as services requiring signup?', 'answer' => 'Yes. Signup requirements do not affect email delivery reliability. InboxOro receives emails in real time within seconds — the same performance as any service, without the signup overhead.'],
                    ['question' => 'What is the difference between free temp mail with no signup and a regular free email service?', 'answer' => 'Free email services (Gmail, Outlook, ProtonMail) require signup and create permanent accounts. InboxOro requires nothing and creates a 10-minute inbox that permanently self-deletes. They serve completely different purposes.'],
                    ['question' => 'Is no-signup temp mail from InboxOro available on mobile devices?', 'answer' => 'Yes. InboxOro is fully mobile-responsive and works in any mobile browser without any app download or signup. Open the site, copy the address, use it — same experience on mobile as on desktop.'],
                ]),
                'is_active' => true,
            ],

            // ─────────────────────────────────────────────────────────────
            // 3. temp-mail-with-inbox-access
            // ─────────────────────────────────────────────────────────────
            [
                'slug'             => 'temp-mail-with-inbox-access',
                'title'            => 'Temp Mail With Inbox Access – Real-Time View | InboxOro',
                'meta_description' => 'Get temp mail with full inbox access on InboxOro. See emails in real time as they arrive — no refresh needed. Free, no signup. Auto-deletes in 10 minutes.',
                'h1'               => 'Temp Mail With Inbox Access — See Every Email the Moment It Arrives',
                'intro_text'       => '
<p>Not all temp mail services are equal when it comes to inbox access. Some generate an address but provide no real-time inbox view — you have to wait, guess, or keep refreshing to see if your email arrived. Others provide a basic inbox but display emails after significant delay, or require manual refresh every few seconds to check for new messages. <strong>InboxOro</strong> provides temp mail with full, real-time inbox access: emails appear automatically the moment they arrive on the server, without any action required from you, in a complete inbox view that renders HTML content and makes all links and buttons functional.</p>

<p>Real inbox access is not a luxury feature for temp mail — it is a requirement for the primary use case. When you are waiting for a verification code or a confirmation link before your account creation will complete, every second matters. A temp mail service that delays delivery or requires manual refresh introduces friction into a process that should be seamless. InboxOro'."'".'s real-time inbox access is designed to make the verification flow feel as natural as checking a real email client — but without any of the setup, history, or ongoing commitment that a real email client involves.</p>

<h2>What Real-Time Inbox Access Means in Practice</h2>

<p>Real-time inbox access means InboxOro'."'".'s interface is actively polling for new messages on your behalf, continuously checking whether any email has arrived for your temporary address, and updating the inbox display the moment a message is received. You do not need to press a refresh button. You do not need to reload the page. You do not need to watch a counter or a spinner. You simply watch the inbox — and when the email arrives, it appears.</p>

<p>In standard conditions, emails from major platforms and services arrive in your InboxOro inbox within 5 to 15 seconds of being dispatched from the sending server. This is fast enough that OTP codes — which often have validity windows of 5 to 10 minutes — arrive with plenty of time remaining. It is fast enough that multi-step verification flows, where one email leads to another form that triggers a second email, can complete entirely within InboxOro'."'".'s 10-minute window.</p>

<ul>
  <li><strong>Automatic real-time updates</strong> — inbox refreshes itself continuously; no manual action needed</li>
  <li><strong>Full HTML rendering</strong> — emails display with correct formatting, images, and clickable elements</li>
  <li><strong>Clickable links and buttons</strong> — verification links work directly from within the InboxOro inbox view</li>
  <li><strong>Multiple emails in one session</strong> — all emails that arrive during the 10-minute window are visible</li>
  <li><strong>Attachment visibility</strong> — emails with attachments display and allow interaction during the active window</li>
  <li><strong>No manual refresh needed</strong> — the inbox actively monitors for new messages on your behalf</li>
</ul>

<h2>Why Full Inbox Access Matters for Verification Flows</h2>

<p>The most common verification flow involves receiving an email and taking an action based on its contents — either clicking a link or copying a code. Both of these actions require not just that the email arrived, but that you can see its contents clearly and interact with them directly.</p>

<p>A temp mail service that only shows subject lines, or that shows plain text without rendering HTML, or that makes you click through to a separate view to see the email body, adds unnecessary steps to a process that should be instantaneous. InboxOro'."'".'s inbox access is designed to eliminate these extra steps: the email arrives, you see it, you interact with it — all in the same view, without navigation.</p>

<p>For verification links specifically, InboxOro'."'".'s full HTML rendering is critical. A verification link that appears as raw HTML code rather than a clickable button is unusable without copy-pasting the URL manually. InboxOro renders the button correctly, making the verification link as easy to click as it would be in any real email client — which means the verification flow completes without friction from the temp mail tool itself.</p>

<p>Temp mail with full inbox access is InboxOro'."'".'s commitment to making the complete verification experience — not just address generation — as smooth and fast as possible. Because an address that receives emails you cannot easily act on is only half the solution.</p>',
                'faq'              => json_encode([
                    ['question' => 'Do I need to manually refresh InboxOro to see incoming emails?', 'answer' => 'No. InboxOro\'s inbox updates in real time — emails appear automatically the moment they arrive on the server. There is no need to press refresh or reload the page.'],
                    ['question' => 'How quickly do emails appear in InboxOro\'s inbox after being sent?', 'answer' => 'Typically within 5 to 15 seconds of being dispatched by the sending server. InboxOro continuously monitors for new messages and displays them the instant they arrive.'],
                    ['question' => 'Can I click verification links directly from InboxOro\'s inbox?', 'answer' => 'Yes. InboxOro renders full HTML emails, so verification links and buttons are fully functional and clickable directly within the inbox view — no copy-pasting required.'],
                    ['question' => 'Does InboxOro\'s inbox show all emails that arrive during the 10-minute window?', 'answer' => 'Yes. All emails that arrive during the active 10-minute window are displayed in the inbox in order of arrival. You can view and interact with each one within the session.'],
                    ['question' => 'Can I access the InboxOro inbox from multiple browser tabs simultaneously?', 'answer' => 'Yes. If you open InboxOro in multiple tabs with the same email address, each tab will display incoming emails in real time. The inbox content is the same across all tabs accessing the same address.'],
                    ['question' => 'Is full inbox access on InboxOro free?', 'answer' => 'Yes. InboxOro\'s complete inbox access — real-time updates, HTML rendering, clickable links — is free for every user. No subscription or registration is required to access any feature.'],
                ]),
                'is_active' => true,
            ],

            // ─────────────────────────────────────────────────────────────
            // 4. temp-mail-with-attachment-support
            // ─────────────────────────────────────────────────────────────
            [
                'slug'             => 'temp-mail-with-attachment-support',
                'title'            => 'Temp Mail With Attachment Support – Receive Files | InboxOro',
                'meta_description' => 'Need temp mail that receives attachments? InboxOro supports incoming file attachments — free, no signup, real-time inbox. Auto-deletes everything in 10 minutes.',
                'h1'               => 'Temp Mail With Attachment Support — Receive Files Without Commitment',
                'intro_text'       => '
<p>Most temp mail services handle plain text and basic HTML emails reliably. Attachment support is less universally available — some services strip attachments before displaying emails, others cannot parse multi-part MIME messages that include file attachments, and others display attachment metadata without providing access to the actual file. <strong>InboxOro</strong> supports incoming email attachments during the active 10-minute window, allowing users to access documents, PDFs, images, and other file types sent to their temporary address without the need for a permanent email account.</p>

<p>The ability to receive attachments through a temp mail address has practical value in a specific set of scenarios — particularly when a service sends a document or file as part of its onboarding or verification process, or when a developer is testing an application that sends emails with attached files. Understanding when this capability is useful, how it works in InboxOro'."'".'s 10-minute window, and what its natural limitations are helps users and developers apply it effectively.</p>

<h2>Common Scenarios Where Temp Mail With Attachment Support Matters</h2>

<p><strong>Registration documents:</strong> Some services send documents — terms of service, account agreements, or information PDFs — as attachments during the account creation process. Receiving these through a temp mail address means the document can be accessed and saved during the 10-minute window without providing a permanent email address.</p>

<p><strong>Developer testing:</strong> Applications that send emails with attached reports, invoices, generated PDFs, or data files need these attachments tested as part of the email delivery verification process. InboxOro allows developers to confirm that attachments are correctly included in outgoing emails by checking that they arrive and are accessible in the temp inbox.</p>

<p><strong>One-time file delivery:</strong> If a service sends a file — a voucher, a ticket, a code — as an email attachment after registration or verification, accessing it through InboxOro keeps the service'."'".'s contact information out of your real inbox while still giving you the file.</p>

<p><strong>Template testing with attachments:</strong> Email templates that include attachments as part of their design can be tested by sending to an InboxOro address and verifying that the attachment appears correctly formatted and accessible.</p>

<ul>
  <li><strong>Attachment types supported:</strong> PDFs, images, documents, and standard file attachments in email-safe formats</li>
  <li><strong>Access window:</strong> Attachments are accessible during the active 10-minute session window</li>
  <li><strong>Download during session:</strong> Save important attachments before the 10-minute window closes</li>
  <li><strong>Testing use:</strong> Confirm attachment inclusion in application emails without real accounts</li>
  <li><strong>Automatic cleanup:</strong> All attachments deleted along with the inbox after 10 minutes</li>
  <li><strong>No registration required:</strong> Attachment support available at zero cost with no signup</li>
</ul>

<h2>Important Considerations for Temp Mail With Attachments</h2>

<p>The critical thing to understand about receiving attachments through temp mail is the time constraint. If a service sends you a document or file as an email attachment, you have 10 minutes from the moment you generated your InboxOro address to access and save that file. After the window closes, both the email and the attachment are permanently deleted. There is no recovery option.</p>

<p>For one-time document access where the window is sufficient — a PDF sent during account verification, a ticket for an event, a generated report from a one-time tool — this is entirely workable. For documents you expect to need ongoing access to — insurance policies, legal agreements, long-term subscription confirmations — a permanent email address is more appropriate so the documents remain accessible.</p>

<p>Developers testing attachment delivery should factor the 10-minute window into their testing workflow. Run the attachment delivery test, check InboxOro to confirm the attachment arrived, download or note the attachment details, and let InboxOro handle the cleanup automatically. The fresh inbox for each test run ensures that attachment tests are not contaminated by previous test attachments.</p>

<p>InboxOro'."'".'s attachment support extends the temp mail use case beyond plain verification into scenarios where the email carries actual file content that needs to be accessed — while maintaining the same zero-signup, auto-deleting privacy model that makes temp mail valuable in the first place.</p>',
                'faq'              => json_encode([
                    ['question' => 'Does InboxOro really support email attachments in temporary inboxes?', 'answer' => 'Yes. InboxOro receives and displays emails with standard file attachments during the active 10-minute window. Attachments can be accessed and downloaded within that session.'],
                    ['question' => 'What types of attachments can InboxOro receive?', 'answer' => 'InboxOro supports standard email attachment types including PDFs, images, Word documents, spreadsheets, and other files commonly sent as email attachments within standard MIME email formats.'],
                    ['question' => 'How long do I have to access an attachment received in InboxOro?', 'answer' => 'During the active 10-minute window from address generation. After the window closes, all emails and attachments are permanently deleted with no recovery option. Download important files before the timer expires.'],
                    ['question' => 'Can developers use InboxOro to test email attachment delivery?', 'answer' => 'Yes. Developers use InboxOro to verify that applications correctly attach files to outgoing emails — the attachment is accessible in the temp inbox during the session, confirming successful delivery and attachment inclusion.'],
                    ['question' => 'Should I use temp mail with attachment support for important long-term documents?', 'answer' => 'No. For documents you need ongoing access to — contracts, legal agreements, policy documents — use a permanent email. InboxOro\'s 10-minute deletion is permanent; important documents must be saved before the window closes.'],
                    ['question' => 'Is attachment support on InboxOro free?', 'answer' => 'Yes. InboxOro\'s attachment support is available to all users at zero cost — no registration, no subscription, no payment required to receive emails with file attachments in your temporary inbox.'],
                ]),
                'is_active' => true,
            ],

            // ─────────────────────────────────────────────────────────────
            // 5. temp-mail-with-custom-domain
            // ─────────────────────────────────────────────────────────────
            [
                'slug'             => 'temp-mail-with-custom-domain',
                'title'            => 'Temp Mail With Custom Domain – Choose Your Address | InboxOro',
                'meta_description' => 'Want temp mail with a custom domain or username? InboxOro lets you set your own email address — free, no signup, real-time inbox. Auto-deletes in 10 min.',
                'h1'               => 'Temp Mail With Custom Domain — Set Your Username, Keep Your Privacy',
                'intro_text'       => '
<p>Most temp mail services generate addresses with random usernames — a string of letters and numbers that is unique and functional but entirely unmemorable. For most everyday use cases, this is perfectly fine. But for developers who want recognisable addresses in application logs, for users who prefer a consistent format across a session, or for anyone who simply wants more control over the address they are handing to a website, the ability to set a custom username is a meaningful quality-of-life improvement. <strong>InboxOro</strong> provides this capability: temp mail with a customisable username portion of the address, while maintaining the same privacy, anonymity, and automatic deletion that defines the service.</p>

<p>It is important to understand what "custom domain" and "custom username" mean in the context of temp mail, because they are sometimes used interchangeably but refer to different things. At InboxOro, the customisation available is the <em>username</em> — the part of the email address before the @ symbol. The domain — the part after the @ — is managed by InboxOro and rotated across its active domain pool. This distinction matters: a custom username means your address looks like <em>yourname@inboxoro-domain.com</em> rather than <em>random123@inboxoro-domain.com</em>. The domain is still InboxOro'."'".'s, but the username is yours to set.</p>

<h2>How to Set a Custom Username on InboxOro</h2>

<p>When you open InboxOro, your address is automatically generated with a random username. If you want to customise it, InboxOro provides an option to change the username portion before the address activates. Type your preferred username into the field, and InboxOro will generate the address with that username on one of its active domains. The inbox is then live and ready to receive emails at your custom address.</p>

<p>The custom username must be unique for the duration it is active — InboxOro prevents two simultaneous users from holding the same address. The address still expires after 10 minutes and everything inside is permanently deleted. The custom username provides personalisation during the session, not permanence beyond it.</p>

<ul>
  <li><strong>Set a recognisable username</strong> — for developer logs, test plans, or personal preference</li>
  <li><strong>Consistent address across a session</strong> — if you need to re-enter the address, your custom name is easier to remember</li>
  <li><strong>Developer-friendly naming</strong> — use descriptive names like <em>test-registration</em> or <em>otp-verify-test</em></li>
  <li><strong>Same privacy guarantee</strong> — custom username does not reduce anonymity; InboxOro still collects no personal information</li>
  <li><strong>Same 10-minute deletion</strong> — custom address still self-deletes after 10 minutes</li>
  <li><strong>Free to use</strong> — custom username is available at zero cost with no signup</li>
</ul>

<h2>When Custom Username Temp Mail Is Most Valuable</h2>

<p><strong>Developer and QA testing:</strong> When running email delivery tests, a custom username makes the test address immediately recognisable in application logs. An address like <em>test-welcome-email-flow@inboxoro.com</em> is far more useful in a log file than <em>x7k9q2p@inboxoro.com</em>. The custom username makes debugging faster and test plans easier to document.</p>

<p><strong>Multi-step or multi-platform signups:</strong> If you are signing up for several related services in a single session and want each address to reflect its purpose — <em>platform-a-signup</em>, <em>platform-b-otp</em> — custom usernames make the InboxOro tab easier to identify at a glance.</p>

<p><strong>Team or shared testing contexts:</strong> When multiple team members are testing the same email flow and need to reference a specific test address, a custom username ensures everyone is using the same, clearly named address rather than different randomly generated ones.</p>

<p><strong>Personal preference:</strong> Some users simply prefer an address that looks less random. A custom username provides that without requiring any compromise on privacy, anonymity, or the automatic deletion that makes temp mail valuable.</p>

<p>InboxOro'."'".'s custom username feature is an extension of the service'."'".'s core commitment: maximum utility, minimum overhead, zero compromise on privacy. Whether you use the automatically generated address or set your own, the fundamental temp mail experience — free, instant, anonymous, auto-deleting — remains exactly the same.</p>',
                'faq'              => json_encode([
                    ['question' => 'Can I set a custom email username on InboxOro?', 'answer' => 'Yes. InboxOro allows you to customise the username portion — the part before the @ symbol — of your temporary email address. The domain is managed by InboxOro; the username can be set to whatever you prefer.'],
                    ['question' => 'Does using a custom username on InboxOro reduce my privacy?', 'answer' => 'No. The privacy guarantee is identical regardless of whether you use an auto-generated or custom username. InboxOro still collects no personal information, and the inbox self-deletes after 10 minutes either way.'],
                    ['question' => 'Can I use InboxOro with my own custom domain for temp mail?', 'answer' => 'InboxOro allows custom usernames (before the @). The domain portion (after the @) is managed by InboxOro\'s active domain pool. For a completely custom domain, a self-hosted or enterprise email solution would be needed.'],
                    ['question' => 'Why would a developer want a custom username on a temp mail address?', 'answer' => 'Custom usernames make test addresses recognisable in application logs, error reports, and test plans. A descriptive address like "test-otp-flow" is far more useful in debugging than a random string.'],
                    ['question' => 'Does the custom username persist across multiple InboxOro sessions?', 'answer' => 'No. Custom usernames are specific to the current session and expire along with the inbox after 10 minutes. There is no account to store preferences across sessions.'],
                    ['question' => 'Is custom username temp mail on InboxOro free?', 'answer' => 'Yes. Setting a custom username is available at zero cost — no subscription, no premium tier, no registration required. All InboxOro features are free for every user.'],
                ]),
                'is_active' => true,
            ],

        ];

        foreach ($pages as $page) {
            SeoPage::create($page);
        }

        $this->command->info('✅ Features Batch 1: 5 SEO Pages created successfully!');
    }
}