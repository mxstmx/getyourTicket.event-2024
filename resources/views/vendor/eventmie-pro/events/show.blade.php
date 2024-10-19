@extends('eventmie::layouts.app')

@section('title', $event->title)
@section('meta_title', $event->meta_title ? $event->meta_title : $event->title)
@section('meta_keywords', $event->meta_keywords)
@section('meta_description', $event->meta_description ? $event->meta_description : $event->excerpt)
@section('meta_image', url('/storage/' . $event['thumbnail']))
@section('meta_url', url()->current())


@section('content')

    <!--Cover-->
    <section>
        <div class="container mt-lg-12 mt-10">
            <div class="rounded-4 bg-white position-relative p-lg-5 p-3">
                <div class="row">
                    <div class="col-xl-7 col-lg-7 col-md-12 col-12">
                        <img src="{{ '/storage/' . $event['poster'] }}" alt="{{ $event['title'] }}"
                            class="img-fluid rounded-4 w-100 h-auto" />
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-12 col-12">
                        <!-- listing detail head -->
                        <div class="d-flex flex-column h-100 justify-content-center p-lg-0 p-2">
                            <h2 class="mb-2">{{ $event['title'] }}</h2>
                            <p class="mb-2 fs-5">
                                {{ $event['excerpt'] }}
                            </p>

                            {{-- CUSTOM --}}
                            @php $organiser_slug = $extra['organiser']->organisation; @endphp
                            {{-- CUSTOM --}}

                            <!-- listing badges -->
                            <div class="d-flex align-items-center justify-content-start flex-wrap gap-2 text-gray-900 my-3">
                                @if (!empty($event['online_location']))
                                    <span
                                        class="border-1 border border-info bg-info-subtle px-2 py-1 text-center rounded-2"><i
                                            class="fas fa-signal"></i>&nbsp;
                                        @lang('eventmie-pro::em.online_event')</span>
                                @endif

                                @if ($ended)
                                    <span
                                        class="border-1 border border-danger bg-danger-subtle px-2 py-1 text-center rounded-2">@lang('eventmie-pro::em.event_ended')</span>
                                @endif
                                <span
                                    class="border-1 border border-info bg-info-subtle px-2 py-1 text-center rounded-2">{{ $category['name'] }}</span>

                                @if (!empty($free_tickets))
                                    <span
                                        class="border-1 border border-info bg-info-subtle px-2 py-1 text-center rounded-2">@lang('eventmie-pro::em.free_tickets')</span>
                                @endif

                                @if ($event->repetitive)
                                    @if ($event->repetitive_type == 1)
                                        <span
                                            class="border-1 border border-info bg-info-subtle px-2 py-1 text-center rounded-2">@lang('eventmie-pro::em.repetitive_daily_event')</span>
                                    @elseif($event->repetitive_type == 2)
                                        <span
                                            class="border-1 border border-info bg-info-subtle px-2 py-1 text-center rounded-2">@lang('eventmie-pro::em.repetitive_weekly_event')</span>
                                    @elseif($event->repetitive_type == 3)
                                        <span
                                            class="border-1 border border-info bg-info-subtle px-2 py-1 text-center rounded-2">@lang('eventmie-pro::em.repetitive_monthly_event')</span>
                                    @endif
                                @endif

                                @if ($ended)
                                    <span
                                        class="border-1 border border-danger bg-danger-subtle px-2 py-1 text-center rounded-2">@lang('eventmie-pro::em.event_ended')</span>
                                @endif
                            </div>

                            <!-- listing badges -->

                            <div class="d-flex justify-content-center mt-3" id="book">
                                <a class="btn btn-gradient rounded-3 w-100"
                                    href={{ $event->repetitive > 0 ? '#buy-tickets' : 'javascript:void(0)' }}
                                    onclick={{ $event->repetitive > 0 ? 'javascript:void(0)' : 'triggerSignleDay()' }}>
                                    <i class="fas fa-ticket-alt me-1"></i>
                                    @lang('eventmie-pro::em.get_tickets')

                                </a>


                            </div>
                        </div>
                        <!-- listing detail head -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--ABOUT-->
    <section>
        <!-- listing slide -->

        <div class="py-6">
            <div class="container">
                <div class="row gap-lg-0 gap-4">
                    <div class="col-xl-7 col-lg-7 col-md-12 col-12">
                        <!--SCHEDULE START-->
                        <div class="p-3 bg-white rounded-4 text-gray-700 mb-3" id="buy-tickets">
                            <div class="mb-2 overflow-hidden">
                                @if ($event->merge_schedule)
                                    <h2 class="lh-1 my-3">
                                        @lang('eventmie-pro::em.get_tickets') &nbsp;
                                        <div class="badge bg-primary position-relative">
                                            @lang('eventmie-pro::em.seasonal_tickets')
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                                <i class="fas fa-medal"></i>
                                                <span class="visually-hidden">&nbsp;</span>
                                            </span>
                                        </div>
                                    </h2>
                                    <p class="text-primary"> @lang('eventmie-pro::em.seasonal_tickets_ie')</p>
                                @else
                                    <h2 class="mb-0 fw-bold h2">@lang('eventmie-pro::em.get_tickets')</h2>
                                @endif
                                <p class="mb-0">
                                    <i class="fa fa-info-circle me-1"></i> @lang('eventmie-pro::em.buy_ticket_info')
                                </p>
                            </div>


                            {{-- <div class="p-lg-2 p-1 chart-color1 rounded-4"> --}}

                            <select-dates :event="{{ json_encode($event, JSON_HEX_APOS) }}"
                                :max_ticket_qty="{{ json_encode($max_ticket_qty, JSON_HEX_APOS) }}"
                                :login_user_id="{{ json_encode(Auth::check() ? Auth::id() : null, JSON_HEX_APOS) }}"
                                :is_customer="{{ Auth::check() ? (Auth::user()->hasRole('customer') ? 1 : 0) : 1 }}"
                                :is_organiser="{{ Auth::check() ? (Auth::user()->hasRole('organiser') || Auth::user()->hasRole('pos') ? 1 : 0) : 0 }}"
                                :is_pos="{{ Auth::check() ? (Auth::user()->hasRole('pos') ? 1 : 0) : 0 }}"
                                :is_admin="{{ Auth::check() ? (Auth::user()->hasRole('admin') ? 1 : 0) : 0 }}"
                                :is_paypal="{{ $is_paypal }}"
                                :is_offline_payment_organizer="{{ setting('booking.offline_payment_organizer') ? 1 : 0 }}"
                                :is_offline_payment_customer="{{ setting('booking.offline_payment_customer') ? 1 : 0 }}"
                                :tickets="{{ json_encode($tickets, JSON_HEX_APOS) }}"
                                :booked_tickets="{{ json_encode($booked_tickets, JSON_HEX_APOS) }}"
                                :currency="{{ json_encode($currency, JSON_HEX_APOS) }}"
                                :total_capacity="{{ $total_capacity }}"
                                :date_format="{{ json_encode(
                                    [
                                        'vue_date_format' => format_js_date(),
                                        'vue_time_format' => format_js_time(),
                                    ],
                                    JSON_HEX_APOS,
                                ) }}">
                            </select-dates>
                            {{-- </div> --}}

                        </div>

                        <!--SCHEDULE END-->

                        <!-- Seating Chart Image -->
                        @if ($event->seatingchart_image)
                            <div class="card-base mb-4 d-flex flex-column gap-2">
                                <h4 class="mb-3">@lang('eventmie-pro::em.seating_chart')</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <img src="/storage/{{ $event->seatingchart_image }}" alt="{{ $event->title }}"
                                            class="rounded mx-auto d-block img-fluid" />
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- Seating Chart END -->

                        <!-- post single -->
                        <div class="card-base mb-4 d-flex flex-column gap-2">
                            <h4 class="m-0">
                                <i class="fa fa-calendar me-1"></i>@lang('eventmie-pro::em.overview')
                            </h4>
                            <p class="m-0 p-0 text-gray-700">
                                {!! $event['description'] !!}
                            </p>
                        </div>
                        <!-- post single -->

                        <!--Event FAQ-->
                        @if ($event['faq'])
                            <div class="card-base mb-4 d-flex flex-column gap-2">
                                <h4 class="m-0">
                                    <i class="fa fa-calendar me-1"></i>
                                    @lang('eventmie-pro::em.event_info')
                                </h4>
                                <p class="m-0 p-0 text-gray-700">
                                    {!! $event['faq'] !!}
                                </p>
                            </div>
                        @endif
                        <!--Event FAQ END-->

                        <!--PHOTO GALLERY-->
                        @if (!empty($event->images))
                            <div class="card-base mb-4 d-flex flex-column gap-2" id="gallery">
                                <h4 class="m-0">
                                    <i class="fa fa-images me-1"></i>
                                    @lang('eventmie-pro::em.event_gallery')
                                </h4>
                                <div class="zoom-gallery">
                                    <gallery-images :gimages="{{ $event->images }}" :style=''>
                                    </gallery-images>
                                </div>
                            </div>
                        @endif
                        <!--PHOTO GALLERY END-->

                        <!--Event Video-->
                        @if (!empty($event->video_link))
                            <div class="card-base mb-4 d-flex flex-column gap-2">
                                <h4 class="m-0">
                                    <i class="fa fa-play me-1"></i> @lang('eventmie-pro::em.watch_trailer')
                                </h4>
                                <div class="row">
                                    <div class="col-12">
                                        {{-- CUSTOM --}}
                                        @foreach (json_decode($event->video_link) as $item)
                                            @if (count(json_decode($event->video_link)) == 1)
                                                <div class="ratio ratio-16x9">
                                                    <iframe src="https://www.youtube.com/embed/{{ $item }}"
                                                        allowfullscreen class="w-100 rounded-3"></iframe>
                                                </div>
                                            @else
                                                <div class="ratio ratio-16x9">
                                                    <iframe src="https://www.youtube.com/embed/{{ $item }}"
                                                        allowfullscreen class="w-100 rounded-3"></iframe>
                                                </div>
                                            @endif
                                        @endforeach
                                        {{-- CUSTOM --}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!--Event Video END-->


                        <!--GOOGLE MAP-->
                        @if ($event->latitude && $event->longitude)
                            <div class="card-base mb-4 d-flex flex-column gap-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="m-0">
                                        <i class="fa fa-location-dot me-1"></i>
                                        @lang('eventmie-pro::em.location')
                                    </h4>

                                    <a href="{{ 'https://www.google.com/maps/search/' . $event->address . '/' . $event->latitude . ',' . $event->longitude }}"
                                        class="btn py-0 px-2 btn-primary rounded-2 float-end" id="get_directions">
                                        <i class="fas fa-location-arrow"></i> @lang('eventmie-pro::em.get_directions')
                                    </a>

                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="lgxmapcanvas map-canvas-default">
                                            <g-component :lat="{{ json_encode($event->latitude, JSON_HEX_APOS) }}"
                                                :lng="{{ json_encode($event->longitude, JSON_HEX_APOS) }}">
                                            </g-component>
                                            {{--  CUSTOM --}}
                                            <div id="warnings-panel"></div>
                                            <div id="map" style="height: 100%"></div>
                                            {{--  CUSTOM --}}

                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                        <!--GOOGLE MAP END-->

                    </div>



                    {{-- Event Start Date Start --}}

                    <div class="col-xl-5 col-lg-5 col-md-12 col-12">

                        <!-- event location -->
                        <div>
                            <div class="card-base mb-4 d-flex flex-column gap-2">
                                <h4 class="m-0">
                                    <i class="fa fa-location-dot me-1"></i>
                                    @if (!empty($event['online_location']))
                                        <strong>@lang('eventmie-pro::em.online_event')</strong>,
                                    @endif

                                    @if ($event->venues->isNotEmpty())
                                        <a class="col-white text-dark"
                                            href="{{ route('eventmie.venues.show', [$event->venues[0]->slug]) }}"><strong>{{ $event->venue }}
                                                <i class="fas fa-external-link-alt"></i></strong> </a>
                                    @else
                                        <strong>{{ $event->venue }}</strong>
                                    @endif
                                </h4>
                                <p class="m-0 p-0">
                                    @if ($event->address)
                                        {{ $event->address }} {{ $event->zipcode }} <br>
                                    @endif

                                    @if ($event->city)
                                        {{ $event->city }},
                                    @endif

                                    @if ($event->state)
                                        {{ $event->state }},
                                    @endif

                                    @if ($country)
                                        {{ $country->get('country_name') }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- event date -->
                        <div class="card-base mb-4 d-flex flex-column gap-2">
                            <h4 class="m-0">
                                <i class="fa fa-calendar me-1"></i>
                                @if (!$event->repetitive)
                                    {{ userTimezone($event->start_date . ' ' . $event->start_time, 'Y-m-d H:i:s', format_carbon_date(false)) }}

                                    {{ showTimezone() }}

                                    -

                                    {{ userTimezone($event->end_date . ' ' . $event->end_time, 'Y-m-d H:i:s', format_carbon_date(false)) }}

                                    {{ showTimezone() }}
                                @else
                                    {{ userTimezone($event->start_date . ' ' . $event->start_time, 'Y-m-d H:i:s', format_carbon_date(true)) }}

                                    -

                                    {{ userTimezone($event->start_date . ' ' . $event->start_time, 'Y-m-d H:i:s', 'Y-m-d') <= userTimezone($event->end_date . ' ' . $event->end_time, 'Y-m-d H:i:s', 'Y-m-d') ? userTimezone($event->end_date . ' ' . $event->end_time, 'Y-m-d H:i:s', format_carbon_date(true)) : userTimezone($event->start_date . ' ' . $event->start_time, 'Y-m-d H:i:s', format_carbon_date(true)) }}
                                @endif
                            </h4>
                        </div>

                        <div class="card-base mb-4 d-flex flex-column gap-2">
                            <h4 class="m-0">
                                <i class="fa fa-share me-1"></i>@lang('eventmie-pro::em.share_event')
                            </h4>
                            <div class="d-flex gap-2">
                                <a class="icon-shape icon-md bg-info rounded-2 text-dark pointer" target="_blank"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}">
                                    <i class="fa-brands fa-facebook fs-4"></i>
                                </a>
                                <a class="icon-shape icon-md bg-info rounded-2 text-dark pointer" target="_blank"
                                    href="https://twitter.com/intent/tweet?text={{ urlencode($event->title) }}&url={{ url()->current() }}">

                                    <i class="fa-brands fa-twitter fs-4"></i>
                                </a>
                                <a class="icon-shape icon-md bg-info rounded-2 text-dark pointer" target="_blank"
                                    href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ urlencode($event->title) }}">
                                    <i class="fa-brands fa-linkedin fs-4"></i>
                                </a>
                                <a class="icon-shape icon-md bg-info rounded-2 text-dark pointer" target="_blank"
                                    href="https://wa.me/?text={{ url()->current() }}">
                                    <i class="fa-brands fa-whatsapp fs-4"></i>
                                </a>
                                <a class="icon-shape icon-md bg-info rounded-2 text-dark pointer" target="_blank"
                                    href="https://www.reddit.com/submit?title={{ urlencode($event->title) }}&url={{ url()->current() }}">
                                    <i class="fa-brands fa-reddit fs-4"></i>
                                </a>

                                <a class="icon-shape icon-md bg-info rounded-2 text-dark pointer"
                                    href="javascript:void(0)" onclick="copyToClipboard()"><i
                                        class="fas fa-link fs-4"></i></a>

                            </div>

                        </div>

                        <div class="card-base mb-4 d-flex flex-column align-items-center justify-content-center gap-2">
                            <h4 class="m-0">
                                <i class="fa fa-user me-1"></i>
                                @lang('eventmie-pro::em.organiser')&nbsp;<i class="fa-solid fa-medal text-primary text-sm"></i>
                            </h4>

                            <div class="icon-shape icon-xxxl rounded-4 overflow-hidden border-light-md">

                                @if (!empty($organiser_slug))
                                    <a class="text-dark text-sm"
                                        href="{{ route('organiser_show', [$event->slug, $organiser_slug]) }}">
                                        @if ($extra['organiser']->avatar)
                                            <img src="/storage/{{ $extra['organiser']->avatar }}"
                                                alt="{{ $organiser_slug }}" class="img-fluid" />
                                        @else
                                            <img src="{{ asset('ep_img/512x512.webp') }}" alt="{{ $organiser_slug }}"
                                                class="img-fluid" />
                                        @endif
                                    </a>
                                @endif
                            </div>
                            <h4 class="m-0">
                                @if (!empty($organiser_slug))
                                    <a class="text-dark"
                                        href="{{ route('organiser_show', [$event->slug, $organiser_slug]) }}">
                                        {{ $extra['organiser']->organisation }}
                                    </a>
                                @endif
                            </h4>

                            @if (!empty($organiser_slug))
                                <a class="btn btn-primary"
                                    href="{{ route('organiser_show', [$event->slug, $organiser_slug]) }}">
                                    @lang('eventmie-pro::em.view_profile')
                                </a>
                            @endif

                        </div>



                        <!--TAGS-->
                        @php $i = 0; @endphp
                        @foreach ($tag_groups as $key => $group)
                            @php $i++; @endphp
                            <div class="card-base mb-4 p-lg-2 p-1  {{ $i % 2 ? 'bg-white' : '' }}">
                                <!-- section heading  -->
                                <h4 class="mt-1 mb-0 text-center">{{ ucfirst($key) }}</h4>
                                <div class="row p-2">
                                    @foreach ($group as $key1 => $value)
                                        <div class="col-lg-6 col-md-6 col-12 text-center">
                                            <!-- member -->
                                            @if ($value['is_page'] > 0)
                                                <a
                                                    href="{{ route('eventmie.events_tags', [$event->slug, str_replace(' ', '-', $value['title'])]) }}">
                                                @elseif($value['website'])
                                                    <a href="{{ $value['website'] }}" target="_blank">
                                            @endif
                                            <div class="mb-3">
                                                @if ($value['image'])
                                                    <img src="/storage/{{ $value['image'] }}"
                                                        alt="{{ $value['title'] }}" class="rounded-3 w-100 mb-4 " />
                                                @else
                                                    <img src="{{ asset('ep_img/512x512.webp') }}"
                                                        alt="{{ $value['title'] }}" class="rounded-3 w-100 mb-4 " />
                                                @endif
                                                <h5 class="mb-0">
                                                    @if ($value['is_page'] > 0)
                                                        <a
                                                            href="{{ route('eventmie.events_tags', [$event->slug, str_replace(' ', '-', $value['title'])]) }}">{{ $value['title'] }}</a>
                                                    @elseif($value['website'])
                                                        <a href="{{ $value['website'] }}"
                                                            target="_blank">{{ $value['title'] }}</a>
                                                    @else
                                                        {{ $value['title'] }}
                                                    @endif
                                                </h5>
                                                <p class="small font-weight-semibold mb-1">
                                                    @if ($value['sub_title'])
                                                        {{ $value['sub_title'] }}
                                                    @endif
                                                </p>

                                                @if ($value['is_page'] > 0)
                                                    <div class="text-center text-white">
                                                        <a class="me-1 badge text-dark" href="{{ $value['twitter'] }}"
                                                            target="_blank"><i class="fab fa-twitter"></i></a>
                                                        <a class="me-1 badge text-dark" href="{{ $value['facebook'] }}"
                                                            target="_blank"><i class="fab fa-facebook"></i></a>
                                                        <a class="me-1 badge text-dark" href="{{ $value['instagram'] }}"
                                                            target="_blank"><i class="fab fa-instagram"></i></a>
                                                        <a class="me-1 badge text-dark" href="{{ $value['linkedin'] }}"
                                                            target="_blank"><i class="fab fa-linkedin"></i></a>
                                                        <a class="me-1 badge text-dark" href="{{ $value['website'] }}"
                                                            target="_blank"><i class="fas fa-globe"></i></a>
                                                    </div>
                                                @endif

                                            </div>
                                            @if ($value['is_page'] > 0 || $value['website'])
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        <!--Tags END-->

                        <!-- Reviews -->
                        @if ($event->show_reviews)
                            <div class="card-base bg-white p-lg-2 p-1">
                                <h4 class="mt-1 mb-0 text-center">
                                    <i class="fa fa-star me-1"></i>
                                    @lang('eventmie-pro::em.rating_review')
                                </h4>
                                <div class="row p-2">
                                    <div class="col-12">
                                        @include('vendor.eventmie-pro.events.custom.average_rating')
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!--Reviews END-->


                    </div>
                    {{-- Event Start Date End --}}
                </div>
            </div>
        </div>
    </section>
    <!--ABOUT END-->

@endsection

@section('javascript')
    <script type="text/javascript">
        var google_map_key = {!! json_encode($google_map_key) !!};

        var stripe_publishable_key = {!! json_encode(setting('apps.stripe_public_key')) !!};

        var stripe_secret_key = {!! json_encode($extra['stripe_secret_key']) !!};

        var is_stripe = {!! json_encode($extra['is_stripe']) !!};

        var is_authorize_net = {!! json_encode($extra['is_authorize_net']) !!};

        var is_bitpay = {!! json_encode($extra['is_bitpay']) !!};

        var is_stripe_direct = {!! json_encode($extra['is_stripe_direct']) !!};

        var is_twilio = {!! json_encode($extra['is_twilio']) !!};

        var default_payment_method = {!! json_encode($extra['default_payment_method']) !!};

        var sale_tickets = {!! json_encode($extra['sale_tickets']) !!};

        var is_pay_stack = {!! json_encode($extra['is_pay_stack']) !!};

        var is_razorpay = {!! json_encode($extra['is_razorpay']) !!};

        var is_paytm = {!! json_encode($extra['is_paytm']) !!};

        var is_usaepay = {!! json_encode($is_usaepay) !!};

        var login_user_id = {!! json_encode(Auth::check() ? Auth::id() : 0, JSON_HEX_APOS) !!};
    </script>



    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.jsdelivr.net/npm/v-mask/dist/v-mask.min.js"></script>
    <script type="text/javascript" src="{{ mix('js/events_show.js') }}"></script>

    <script type="text/javascript">
        var latitude = {!! json_encode($event->latitude) !!};
        var longitude = {!! json_encode($event->longitude) !!};
        var venue = {!! json_encode($event->venue) !!};


        function initMap() {

            var markerArray = [];

            // Instantiate a directions service.
            var directionsService = new google.maps.DirectionsService;

            // Create a map and center it on Manhattan.
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: {
                    lat: parseFloat(latitude),
                    lng: parseFloat(longitude)
                }
            });

            var marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(latitude),
                    lng: parseFloat(longitude)
                },
                title: venue,
            });

            // To add the marker to the map, call setMap();
            marker.setMap(map);

            // Create a renderer for directions and bind it to the map.
            var directionsDisplay = new google.maps.DirectionsRenderer({
                map: map
            });

            // Instantiate an info window to hold step text.
            var stepDisplay = new google.maps.InfoWindow;

            // Listen to change events from the start and end lists.
            var onChangeHandler = function() {
                // get current location latlngs
                getUserLocationLatLong(directionsDisplay, directionsService, markerArray, stepDisplay, map);
            };
            document.getElementById('get_directions').addEventListener('click', onChangeHandler);

        }

        let infoWindow;

        function getUserLocationLatLong(directionsDisplay, directionsService, markerArray, stepDisplay, map) {

            console.log('heyy');
            // map = new google.maps.Map(document.getElementById("map"), {
            //     zoom: 13,
            //     center: {lat:  parseFloat(latitude), lng:  parseFloat(longitude)}
            // });
            infoWindow = new google.maps.InfoWindow();

            infoWindow = new google.maps.InfoWindow();

            infoWindow = new google.maps.InfoWindow();

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    position => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        calculateAndDisplayRoute(directionsDisplay, directionsService, markerArray, stepDisplay, map,
                            position.coords.latitude, position.coords.longitude);
                    },
                    () => {
                        alert('Error-1');
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                alert('Browser doesnt support Geolocation');
            }

            console.log('heyy');
            console.log('heyy');
        }



        function calculateAndDisplayRoute(directionsDisplay, directionsService, markerArray, stepDisplay, map, cur_lat,
            cur_lng) {
            // First, remove any existing markers from the map.
            for (var i = 0; i < markerArray.length; i++) {
                markerArray[i].setMap(null);
            }

            directionsService.route({
                origin: new google.maps.LatLng(parseFloat(cur_lat), parseFloat(cur_lng)),
                destination: new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude)),
                travelMode: 'DRIVING',
                drivingOptions: {
                    departureTime: new Date( /* now, or future date */ ),
                    trafficModel: google.maps.TrafficModel.BEST_GUESS
                },
            }, function(response, status) {
                console.log(response);
                if (status === 'OK') {
                    document.getElementById('warnings-panel').innerHTML =
                        '<b>' + response.routes[0].warnings + '</b>';
                    directionsDisplay.setDirections(response);
                    showSteps(response, markerArray, stepDisplay, map);
                } else {
                    window.alert(trans('em.fail_directions'));
                }
            });
        }

        function showSteps(directionResult, markerArray, stepDisplay, map) {
            var myRoute = directionResult.routes[0].legs[0];
            for (var i = 0; i < myRoute.steps.length; i++) {
                var marker = markerArray[i] = markerArray[i] || new google.maps.Marker;
                marker.setMap(map);
                marker.setPosition(myRoute.steps[i].start_location);
                attachInstructionText(
                    stepDisplay, marker, myRoute.steps[i].instructions, map);
            }
        }

        function attachInstructionText(stepDisplay, marker, text, map) {
            google.maps.event.addListener(marker, 'click', function() {
                stepDisplay.setContent(text);
                stepDisplay.open(map, marker);
            });
        }



        function open() {
            document.getElementById("review_modal").style.display = "block";
        }

        //  Single day non-repetitive event
        function triggerSignleDay() {
            const hash = location.hash;
            if (hash != '#/checkout') {
                parent.location.hash = "/checkout";
            }
            document.getElementById('buy_ticket_btn').click();
        }
    </script>
@stop
