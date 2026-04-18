<div class="share-bar rv">
  <span>Share:</span>

  <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}">
    Twitter
  </a>

  <a href="https://www.linkedin.com/shareArticle?url={{ urlencode(url()->current()) }}">
    LinkedIn
  </a>

  <button onclick="copyPostLink()">Copy Link</button>
</div>