{{--
  Inlines only the non-sensitive metadata the frontend JS needs.
  Frozen with Object.freeze() so it cannot be mutated at runtime.
--}}
<script>
const INBOX_ORO = Object.freeze({
  mailboxId : @json($mailbox->id),
  email     : @json($mailbox->email),
  expiresAt : @json(optional($mailbox->expires_at)->toISOString()),
  expiresIn : @json($mailbox->secondsRemaining()),
  csrfToken : @json(csrf_token()),

  routes: Object.freeze({
    generate    : @json(route('mailbox.generate')),
    inbox       : @json(route('mailbox.inbox')),
    emailBase   : @json(url('/mailbox/email')),
    markAllRead : @json(route('mailbox.markAllRead')),
    destroyAll  : @json(route('mailbox.destroyAll')),
  }),

  reverb: Object.freeze({
    key     : @json(config('reverb.apps.0.key')),
    host    : @json(config('reverb.servers.reverb.host', '127.0.0.1')),
    port    : @json((int) config('reverb.servers.reverb.port', 8081)),
    scheme  : @json(config('reverb.servers.reverb.scheme', 'http')),
    channel : @json("mailbox.{$mailbox->id}"),
  }),
});
</script>