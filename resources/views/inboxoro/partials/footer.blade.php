<footer>
  <div class="nav-logo">
    <a href="/temporary-email">
      <img src="{{asset('/images/logo.svg')}}" alt="Inboxoro Temporary Email Service" class="logo-img">
    </a>
  </div>

  <div class="foot-links">
    <a href="{{url('/')}}">Home</a>
    <!-- <a href="/temporary-email">Temp Mail</a> -->
    <a href="/blog">Blog</a>

    <a href="{{url('about')}}">About</a>
    <a href="{{url('contact')}}">Contact</a>

    <a href="{{url('privacy-policy')}}">Privacy Policy</a>
    <a href="{{url('terms')}}">Terms</a>
  </div>

  <div class="foot-st">
    <p>
      © {{ date('Y') }} InboxOro. All rights reserved.
    </p>
  </div>
</footer>