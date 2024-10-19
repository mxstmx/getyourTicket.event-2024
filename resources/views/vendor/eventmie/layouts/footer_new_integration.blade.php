

<!-- Footer -->
<footer class="position-relative py-10 py-lg-12 bg-dark text-gray-500">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-12 col-xxl-10 mx-auto text-center">
        <ul class="list-inline mb-5">
          <li class="list-inline-item mx-0"> <a class="btn btn-icon btn-text-secondary text-gray-400" href="{{ setting('social.facebook') }}" tabindex="0"> <i class="fab fa-facebook-f btn-icon-inner"></i> </a> </li>
          <li class="list-inline-item mx-0"> <a class="btn btn-icon btn-text-secondary text-gray-400" href="{{ setting('social.instagram') }}" tabindex="0"> <i class="fab fa-instagram btn-icon-inner"></i> </a> </li>
        </ul>
	  
		    <p class="mb-0">
		<a href="{{ eventmie_url() }}">{{ setting('site.site_name') ? setting('site.site_name') : config('app.name') }}</a>
		<span>©</span> {{ date('Y') }}- All Rights Reserved - <a href="{{ route('eventmie.page', ['page' => 'impressum']) }}">Impressum</a>
	</p>
      </div>
    </div>
  </div>
</footer>
<!-- footer end --> 


<!-- Fullpage - Social icons -->
<nav class="ln-social-icons">
  <ul class="mx-auto">
    <li><a href="{{ setting('social.facebook') }}"><i class="fab fa-facebook-f"></i></a></li>
    <li><a href="{{ setting('social.instagram') }}"><i class="fab fa-instagram"></i></a></li>
  </ul>
</nav>

<!-- Fullpage - Copyright -->
<div class="ln-copyright text-right">
  <p>
		<a href="{{ eventmie_url() }}">{{ setting('site.site_name') ? setting('site.site_name') : config('app.name') }}</a>
		<span>©</span> {{ date('Y') }}- All Rights Reserved - <a href="{{ route('eventmie.page', ['page' => 'impressum']) }}">Impressum</a>
	</p>
</div>
