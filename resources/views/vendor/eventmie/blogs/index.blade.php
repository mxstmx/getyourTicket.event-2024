@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie-pro::em.blogs')
@endsection

@section('content')
    <main>

        <!--Blogs-->
        <section>
            <!-- section blog -->
            <div class="blog pb-5 px-2">
                <div class="container">
                    <div class="row gap-lg-0 gap-3">
                        @if (!empty($posts))
                            @foreach ($posts as $item)
                                <div class="col-xl-4 col-lg-6 col-md-12">
                                    <div class="blog-card">
                                        <div class="position-relative">
                                            <a href="{{ route('eventmie.post_view', $item['slug']) }}">
                                                <div class="back-image rounded"
                                                    style="background-image:url('/storage/{{ $item['image'] }}')"></div>
                                            </a>
                                        </div>

                                        <div class="blog-date mt-2">
                                            {{ \Carbon\Carbon::parse($item['updated_at'])->translatedFormat(format_carbon_date()) }}
                                        </div>
                                        <div class="blog-title mt-2 lh-sm">
                                            <a href="{{ route('eventmie.post_view', $item['slug']) }}" class="text-inherit">
                                                {{ $item['title'] }}
                                            </a>
                                        </div>
                                        <div class="blog-des mt-2">
                                            <p>{{ $item['excerpt'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12 col-12">
                                <h4 class="text-center">@lang('eventmie-pro::em.nothing')</h4>
                            </div>
                        @endif
                    </div>
                    <!-- .row end -->
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>





        </section>
        <!--Blogs END-->

    </main>
@endsection
