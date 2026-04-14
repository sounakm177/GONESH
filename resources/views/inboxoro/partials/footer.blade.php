<footer>
  <div class="nav-logo">
    <img src="{{asset('/images/logo.svg')}}" alt="Inboxoro Logo" class="logo-img">
  </div>
  <div class="foot-links">
    <!-- <a href="#">Domains</a> -->
    <!-- <a href="#">API</a>
    <a href="#">Status</a> -->
    <a href="{{url('/')}}">Home</a>
    <a href="{{url('privacy-policy')}}">Privacy Policy</a>
    <a href="{{url('terms')}}">Terms</a>
    <a href="mailto:support@inboxoro.com">Contact</a>
  </div>
  <div class="foot-st">
    © {{ date('Y') }} Inboxoro. All rights reserved.
  </div>
</footer>
