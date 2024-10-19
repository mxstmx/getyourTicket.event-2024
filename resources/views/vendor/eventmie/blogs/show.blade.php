@extends('eventmie::layouts.app')

@section('title', $post['title'])
@section('meta_title', $post['seo_title'])
@section('meta_keywords', $post['meta_keywords'])
@section('meta_description', $post['meta_description'])
@section('meta_image', '/storage/' . $post['image'])
@section('meta_url', url()->current())

@section('content')
    <main>

        <!--News-->
        <section>
            <div class="position-relative blog-details mt-lg-12 my-10">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 p-2 mx-auto">
                            <div class="blog-main-img">
                                <img src="/storage/{{ $post['image'] }}" alt="{{ $post['title'] }}"
                                    class="img-fluid rounded-6 blog-detail-img w-100" />
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-12 mx-auto">
                            <div class="d-flex align-items-center justify-content-center mt-lg-4 mt-2">
                                {{ \Carbon\Carbon::parse($post['updated_at'])->translatedFormat(format_carbon_date()) }}
                            </div>
                            <h1 class="text-center p-0 my-2">
                                {{ $post['title'] }}
                            </h1>
                            {{-- <div class="text-center p-0 sub-text">
                                Elsie discovers a hidden garden in the middle of the city and
                                uncovers a magical world of talking animals and enchanted plants
                            </div> --}}

                        </div>
                        <div class="col-lg-12 col-md-12 col-12 blog-img mt-5">
                            {!! $post['body'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--News END-->

    </main>

@endsection
