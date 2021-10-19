@extends('front-user.layouts.master')

@section('meta_title', 'Landing Page')
@section('meta_description', 'Halaman Utama ' . env('APP_NAME'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('front-user') }}/css/owl-carousel.css">
    <link rel="stylesheet" href="{{ asset('front-user') }}/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('front-user') }}/css/imagehover.css" />
@endpush

@section('content')

    <div class="container-fluid">
        <div id="home">
            <div id="carousel" class="carousel slide hero-slides" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($data['sliders'] as $slider)
                        @if ($loop->first)
                            <li class="active" data-target="#carousel" data-slide-to="0"></li>
                        @else
                            <li data-target="#carousel" data-slide-to="{{ $loop->iteration }}"></li>
                        @endif
                    @endforeach
                </ol>
                <div class="carousel-inner" role="listbox">
                    @foreach ($data['sliders'] as $slider)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}"
                            style="background-image: url({{ asset($slider->img_path) }})">
                            <div class="container h-100 d-md-block">
                                <div class="row align-items-center h-100">
                                    @if ($slider->name != null)
                                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                                            <div class="caption animated fadeIn">
                                                <h2 class="animated fadeInUp">{{ $slider->name }}</h2>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    {{-- <div id="informasi">
        <div class="container content-lg">
            <div class="row">
                <div class="col-md-12 title">
                    <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".2s">
                        <h3></h3> <span>INFORMASI</span></h2>
                    </div>
                </div>
            </div>
            <div class="row row-space-1 margin-b-2">
                <div class="col-sm-12 sm-margin-b-2 col-md-12 col-lg-4">
                    <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".3s">
                        <div class="informasi" data-height="height">
                            <div class="informasi-element">
                                <i class="informasi-icon fa fa-trophy"></i>
                            </div>
                            <div class="informasi-info">
                                <h3>Prestasi</h3>
                                <p class="margin-b-5">Capaian putra-putri Perguruan Muhammadiyah dalam ajang
                                    bergengsi</p>
                            </div>
                            <a href="#" class="content-wrapper-link"></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 sm-margin-b-2 col-md-12 col-lg-4">
                    <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".2s">
                        <div class="informasi" data-height="height">
                            <div class="informasi-element">
                                <i class="informasi-icon fa fa-building"></i>
                            </div>
                            <div class="informasi-info">
                                <h3>Fasilitas</h3>
                                <p class="margin-b-5">Segala hal yang mendukung proses belajarmu dan
                                    fasilitas-fasilitas yang ada didalamnya</p>
                            </div>
                            <a href="#" class="content-wrapper-link"></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".1s">
                        <div class="informasi" data-height="height">
                            <div class="informasi-element">
                                <i class="informasi-icon fa fa-futbol-o"></i>
                            </div>
                            <div class="informasi-info">
                                <h3>Ekstrakulikuler</h3>
                                <p class="margin-b-5">Kegiatan yang mengasah skill kreatifitasmu, jiwa
                                    kepemimpinanmu, dan yang lainnya diluar jam belajar</p>
                            </div>
                            <a href="#" class="content-wrapper-link"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-space-1">
                <div class="col-sm-12 sm-margin-b-2 col-md-12 col-lg-4">
                    <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".4s">
                        <div class="informasi" data-height="height">
                            <div class="informasi-element">
                                <i class="informasi-icon fa fa-history"></i>
                            </div>
                            <div class="informasi-info">
                                <h3>Proses Belajar</h3>
                                <p class="margin-b-5">Dengan menerapkan kurikululum terbaru dan guru yang
                                    profesional </p>
                            </div>
                            <a href="#" class="content-wrapper-link"></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 sm-margin-b-2 col-md-12 col-lg-4">
                    <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".5s">
                        <div class="informasi" data-height="height">
                            <div class="informasi-element">
                                <i class="informasi-icon fa fa-user"></i>
                            </div>
                            <div class="informasi-info">
                                <h3>Siswa</h3>
                                <p class="margin-b-5">Siswa yang aktif dapat membantu dalam proses pembelajaran</p>
                            </div>
                            <a href="#" class="content-wrapper-link"></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".6s">
                        <div class="informasi" data-height="height">
                            <div class="informasi-element">
                                <i class="informasi-icon fa fa-bar-chart"></i>
                            </div>
                            <div class="informasi-info">
                                <h3>Visi dan Misi</h3>
                                <p class="margin-b-5">Menjadi penerus bangsa yang berbudi pekerti dan luhur</p>
                            </div>
                            <a href="#" class="content-wrapper-link"></a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div> --}}

    <div id="tentang">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".2s">
                        <h4>TENTANG KAMI</h4>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".2s">
                        <h3>"Dari Muhammadiyah Untuk Bangsa"</h3>
                        <hr>
                    </div>
                </div>
            </div>



            <div class="row main-content">
                <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration=".3" data-wow-delay=".3s">
                    <div class="content-left">
                        <div class="content-image">
                            <img src="{{ $data['about_us']->img_path }}" alt="coba">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration=".3" data-wow-delay=".4s">
                    <div class="content-right">
                        <div class="content-inner">
                            @php
                                echo strlen(strip_tags($data['about_us']->body, '<br><a><span>')) > 1000 ? substr(strip_tags($data['about_us']->body, '<br><a><span>'), 0, 1000) . '...' : $data['about_us']->body;
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="pengumuman">
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".2s">
                    <h4>Pengumuman</h4>
                </div>
                <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".2s">
                    <h3>Kumpulan pengumuman SMK MULU</h3>
                    <hr>
                </div>
            </div>
            @if (count($data['announcements']) == 0)
                <h4 class="text-center wow fadeInUp">Tidak ada data.</h4>
            @endif
            <div class="row owl-carousel card-content" data-wow-duration=".3" data-wow-delay=".4s">
                @foreach ($data['announcements'] as $announcement)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title mt-3">{{ $announcement->title }}</h5>
                            @php
                                echo strlen(strip_tags($announcement->body)) > 150 ? substr(strip_tags($announcement->body), 0, 150) . '...' : strip_tags($announcement->body);
                            @endphp
                            <br>
                            <br>
                            <a href="{{ $announcement->generateURL('front-user.announcement.show', ['title' => 'title', 'id' => 'id']) }}"
                                class="card-link">Lihat Selengkapnya</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="berita" class="blog-area">
        <div class="berita-inner area-padding">
            <div class="berita-overly"></div>
            <div class="container ">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration=".3" data-wow-delay=".2">
                        <div class="section-headline text-center">
                            <h2><span>BERITA TERKINI</span></h2>
                        </div>
                    </div>
                </div>
                @if (count($data['news']) == 0)
                    <h4 class="text-center wow fadeInUp">Tidak ada data.</h4>
                @endif
                <div class="row berita owl-carousel owl-theme wow fadeInUp" data-wow-duration=".3" data-wow-delay=".3">

                    @foreach ($data['news'] as $news)
                        <div class="single-berita">
                            <div class="single-berita-img">
                                <a
                                    href="{{ $news->generateURL('front-user.news.show', ['title' => 'title', 'id' => 'id']) }}">
                                    <img src="{{ $news->thumbnail() }}" alt="">
                                </a>
                            </div>
                            <div class="berita-meta">
                                <span class="date-type">
                                    <i class="fa fa-calendar"></i>{{ $news->formatted_created_at }}
                                </span>
                            </div>
                            <div class="berita-text">
                                <h4>
                                    <a
                                        href="{{ $news->generateURL('front-user.news.show', ['title' => 'title', 'id' => 'id']) }}">{{ $news->title }}</a>
                                </h4>
                                <p>
                                    @php
                                        echo strlen(strip_tags($news->body)) > 150 ? substr(strip_tags($news->body), 0, 150) . '...' : strip_tags($news->body);
                                    @endphp
                                </p>
                            </div>
                            <span>
                                <a href="{{ $news->generateURL('front-user.news.show', ['title' => 'title', 'id' => 'id']) }}"
                                    class="ready-btn">Baca Selengkapnya</a>
                            </span>
                        </div>
                    @endforeach

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
        var mh = 0;
        $('.informasi').each(function() {
            if ($(this).height() > mh) {
                mh = $(this).height();

            }
        }).height(mh);
    </script>
    <script src="{{ asset('front-user') }}/js/custom.js"></script>

@endpush
