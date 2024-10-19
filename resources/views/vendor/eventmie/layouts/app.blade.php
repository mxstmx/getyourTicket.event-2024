<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @include('eventmie::layouts.meta')

    @include('eventmie::layouts.favicon')

    {{-- @include('eventmie::layouts.include_css') --}}
    @include('eventmie::layouts.include_new_integration_css')


    @yield('stylesheet')
</head>

<body class="layout-boxed">

<!-- Loader -->
<div class="loader bg-dark">
  <div class="spinner-grow text-primary" role="status"> <span class="sr-only">Loading...</span> </div>
</div>
	
<div class="overlay overlay-global">
  <div class="overlay-inner bg-image-holder bg-cover"> <img src="assets/video/etyourticket.events.png" alt="background"> </div>
  <div class="overlay-inner overlay-video">
    <video autoplay muted loop>
      <source src="assets/video/getyourticket.events.webm" type="video/webm">
    </video>
  </div>
  <div class="overlay-inner bg-dark opacity-70"></div>
</div>

	
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
        your browser</a> to improve your experience.</p>
    <![endif]-->

    {{-- Ziggy directive --}}
    @routes



        {{-- @include('eventmie::layouts.header') --}}
        @include('eventmie::layouts.header_new_integration')

	
	    {{-- Main wrapper --}}
    <!-- Fullpage content -->
<div class="ln-fullpage" data-navigation="true"> 
	
        @php
            $no_breadcrumb = [
                'eventmie.welcome',
                'eventmie.events_show',
                'eventmie.login',
                'eventmie.register',
                'eventmie.register_show',
                'eventmie.password.request',
                'eventmie.password.reset',
                'eventmie.o_dashboard',
                'eventmie.myevents_index',
                'eventmie.myevents_index',
                'eventmie.myevents_form',
                'eventmie.obookings_index',
                'eventmie.event_earning_index',
                'eventmie.tags_form',
                'eventmie.myvenues.index',
                'eventmie.venues.show',
                'eventmie.ticket_scan',
                'myglists_index',
                'sub_organizer.index',
                'myglists_index',
                'manage_reviews.index',
                'pos.index',
                'eventmie.ticket_scan',
                'scanner.index',
                'pos.o_dashboard',
                'scanner.o_dashboard',
                'organiser_show',
            ];
        @endphp
        @if (!in_array(Route::currentRouteName(), $no_breadcrumb))
            @include('eventmie::layouts.breadcrumb')
        @endif

        <section class="db-wrapper">

            {{-- page content --}}
            @yield('content')

            {{-- set progress bar --}}
            <vue-progress-bar></vue-progress-bar>
        </section>
    </div>
        {{-- @include('eventmie::layouts.footer') --}}
        @include('eventmie::layouts.footer_new_integration')


    <!--Main wrapper end-->

    @include('eventmie::layouts.include_js')

    {{-- Page specific javascript --}}
    @yield('javascript')

</body>

</html>
