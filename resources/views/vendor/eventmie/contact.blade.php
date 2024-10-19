@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie-pro::em.contact')
@endsection
@section('meta_title') @lang('eventmie-pro::em.contact') @endsection
@section('meta_description', setting('site.site_name') ? setting('site.site_name') : config('app.name'))
@section('meta_url', url()->current())

@section('content')

    <main>
        <!--News-->
        <section>
            <!-- section contact info -->
            <div class="pb-lg-6 pb-6">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <!-- card -->
                            <div class="card-base mb-4">
                                <div class="card-body p-4">
                                    <h4 class="mb-3">@lang('eventmie-pro::em.address')</h4>
                                    <p class="mb-3 pe-4">{{ setting('contact.address') }}</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <!-- card -->
                            <div class="card-base mb-4">
                                <div class="card-body p-4">
                                    <h4 class="mb-3">@lang('eventmie-pro::em.phone')</h4>
                                    <p class="mb-3 pe-4">{{ setting('contact.phone') }}</p>
                                    <a href="#" class="btn-link">{{ setting('contact.email') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-8">
                        <div class="section">
                            <div class="container">
                                <h1 class="text-center p-0 mb-4">✺ Get in Touch With Us</h1>
                                <div class="py-lg-4 px-lg-5 p-3 custom-form bg-white">
                                    <div>
                                        @if (\Session::has('msg'))
                                            <div class="alert alert-success">
                                                {{ \Session::get('msg') }}
                                            </div>
                                        @endif
                                        <!-- form -->
                                        <form class="row needs-validation" novalidate="" method="POST"
                                            action="{{ route('eventmie.store_contact') }}">
                                            @csrf
                                            @honeypot
                                            <!-- first name -->
                                            <div class="mb-3 col-md-6">
                                                <label for="fname" class="form-label">@lang('eventmie-pro::em.name') <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="@lang('eventmie-pro::em.name')" required="">
                                                <div class="invalid-feedback">
                                                    @if ($errors->has('name'))
                                                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- email -->
                                            <div class="mb-3 col-md-6">
                                                <label for="lname" class="form-label">@lang('eventmie-pro::em.email') <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control" id="lname"
                                                    placeholder="@lang('eventmie-pro::em.email')" required="">
                                                <div class="invalid-feedback">
                                                    @if ($errors->has('email'))
                                                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- title -->
                                            <div class="mb-3 col-md-12">
                                                <label for="title" class="form-label">@lang('eventmie-pro::em.title') <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="title" class="form-control"
                                                    placeholder="@lang('eventmie-pro::em.title')" required="">
                                                <div class="invalid-feedback">
                                                    @if ($errors->has('title'))
                                                        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- message -->
                                            <div class="mb-3 col-md-12">
                                                <label for="message" class="form-label">Message</label>
                                                <textarea class="form-control " rows="3" name="message" placeholder="@lang('eventmie-pro::em.message')" id="message"
                                                    required=""></textarea>
                                                @if ($errors->has('message'))
                                                    <div class="alert alert-danger mt-1">{{ $errors->first('message') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <!-- button -->
                                            <div class="col-md-12">
                                                <button class="btn btn-primary" type="submit" value="contact-form">
                                                    <span><i class="fas fa-paper-plane"></i></span>
                                                    @lang('eventmie-pro::em.send_message')</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="innerpage-section g-map-wrapper">
                    <div class="lgxmapcanvas map-canvas-default">
                        <div id="contact_map" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
        </section>

    </main>



@endsection

@section('javascript')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ setting('apps.google_map_key') }}&callback=initMap&v=weekly"
        defer></script>
    <script>
        function initMap() {
            const myLatLng = {
                lat: {{ setting('contact.google_map_lat') }},
                lng: {{ setting('contact.google_map_long') }}
            };
            const map = new google.maps.Map(document.getElementById("contact_map"), {
                zoom: 15,
                center: myLatLng,
            });

            new google.maps.Marker({
                position: myLatLng,
                map,
                title: {!! setting('site.site_name') ? json_encode(setting('site.site_name')) : json_encode(config('app.name')) !!},
            });
        }
        window.initMap = initMap;
    </script>
@stop
