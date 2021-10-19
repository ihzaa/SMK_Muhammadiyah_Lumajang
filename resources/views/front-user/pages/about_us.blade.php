@extends('front-user.layouts.master')

@section('meta_title', 'Tentang SMK Muhammadiyah Lumajang')

@section('meta_description', strlen(strip_tags($aboutUs->body)) > 550 ? substr(strip_tags($aboutUs->body), 0, 550) :
    strip_tags($aboutUs->body))

    @push('styles')
        <link rel="stylesheet" href="{{ asset('front-user') }}/css/owl-carousel.css">
        <link rel="stylesheet" href="{{ asset('front-user') }}/css/animate.min.css">
        <link rel="stylesheet" href="{{ asset('front-user') }}/css/imagehover.css" />
        <link rel="stylesheet" href="{{ asset('front-user') }}/css/font-awesome.css" />
    @endpush

@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center">
                <img src="{{ asset($aboutUs->img_path) }}" alt="">
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-12">
                <?php
                echo $aboutUs->body;
                ?>
            </div>
        </div>
    </div>
@endsection
