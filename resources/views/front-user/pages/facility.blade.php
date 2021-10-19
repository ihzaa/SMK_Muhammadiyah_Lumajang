@extends('front-user.layouts.master')

@section('meta_title', $data['facility']->title)

@section('meta_description', strlen(strip_tags($data['facility']->body)) > 550 ?
    substr(strip_tags($data['facility']->body), 0, 550) : strip_tags($data['facility']->body))

    @push('styles')
        <link rel="stylesheet" href="{{ asset('front-user') }}/css/owl-carousel.css">
        <link rel="stylesheet" href="{{ asset('front-user') }}/css/animate.min.css">
        <link rel="stylesheet" href="{{ asset('front-user') }}/css/imagehover.css" />
    @endpush

@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center">
                <img src="{{ asset($data['facility']->img_path) }}" alt="">
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-12 pt-4">
                <h2>{{ $data['facility']->title }}</h2>

                <?php
                echo $data['facility']->body;
                ?>
            </div>
            <div class="col-md-12 mt-4 mb-5" id="berita">
                <div class="berita-inner area-padding">
                    <div class="berita-overly"></div>
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration=".3"
                                data-wow-delay=".2">
                                <div class="section-headline text-center">
                                    <h2><span>Fasilitas Lain</span></h2>
                                </div>
                            </div>
                        </div>

                        <div class="row berita owl-carousel owl-theme wow fadeInUp" data-wow-duration=".3"
                            data-wow-delay=".3">

                            @foreach ($data['otherFacility'] as $otherFacility)
                                <div class="single-berita">
                                    <div class="single-berita-img">
                                        <a
                                            href="{{ $otherFacility->generateURL('front-user.facility.show', ['title' => 'title', 'id' => 'id']) }}">
                                            <img src="{{ $otherFacility->thumbnail() }}" alt="">
                                        </a>
                                    </div>
                                    <div class="berita-text">
                                        <h4>
                                            <a
                                                href="{{ $otherFacility->generateURL('front-user.facility.show', ['title' => 'title', 'id' => 'id']) }}">{{ $otherFacility->title }}</a>
                                        </h4>
                                        <p>
                                            @php
                                                echo strlen(strip_tags($otherFacility->body)) > 150 ? substr(strip_tags($otherFacility->body), 0, 150) . '...' : strip_tags($otherFacility->body);
                                            @endphp
                                        </p>
                                    </div>
                                    <span>
                                        <a href="{{ $otherFacility->generateURL('front-user.facility.show', ['title' => 'title', 'id' => 'id']) }}"
                                            class="ready-btn">Baca Selengkapnya</a>
                                    </span>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script src="{{ asset('front-user') }}/js/wow.min.js"></script>
    <script src="{{ asset('front-user') }}/js/owl-carousel.js"></script>
    <script src="{{ asset('front-user') }}/js/jquery.easing.1.3.js"></script>


    <!-- Plugins -->
    {{-- <script src="{{ asset('front-user') }}/js/jquery.animatecss.min.js"></script> --}}


    <!-- Global Init -->
    <script>
        new WOW().init();
    </script>
    <script src="{{ asset('front-user') }}/js/custom.js"></script>

@endpush
