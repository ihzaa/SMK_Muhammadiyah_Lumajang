@extends('front-user.layouts.master')

@section('meta_title', 'Berita')

@push('styles')
    <link rel="stylesheet" href="{{ asset('front-user') }}/css/font-awesome.css" />
@endpush

@section('content')
    <div class="col-md-8" style="margin: auto;margin-top: 70px;">
        <form action="{{ url()->current() }}" method="GET">
            <div class="input-group rounded" style="">
                <input type="search" class="form-control rounded" placeholder="Cari Judul Berita" aria-label="Search"
                    aria-describedby="search-addon" name="search" value="{{ request()->search }}" />
                <button class="input-group-text border-0" id="search-addon" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </form>
        <hr>
    </div>


    <div class="col-md-12" style="display: flex; justify-content: center;">
        <h3 style="font-weight: bold;">Kumpulan berita SMK Lumajang</h3>
    </div>


    <div id="page-berita" class="row ">
        <div class="col-md-8 ">
            <div class="content-left">
                <div class="content-blog">
                    @foreach ($data['news'] as $news)
                        <a href="{{ route('news.show', ['title' => urlencode($news->title), 'id' => $news->id]) }}">
                            <div class="card" style="width: 100%">
                                <div class="image-content">
                                    <img src="{{ $news->thumbnail() }}" class="card-img-top" alt="{{ $news->title }}"
                                        style="object-fit: cover;height: 100%;">
                                    <div class="tgl">
                                        <p class="day">
                                            {{ \Carbon\Carbon::parse($news->created_at)->format('d M') }}</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-title">{{ $news->title }}</p>

                                    <p class="card-text">
                                        @php
                                            echo strlen(strip_tags($news->body)) > 150 ? substr(strip_tags($news->body), 0, 150) . '...' : strip_tags($news->body);
                                        @endphp
                                    </p>

                                    <div class="icon-down">
                                        <i class="fa fa-user text-muted card-text" aria-hidden="true">
                                            {{ optional($news->createdByUser)->name }}</i>
                                        <i class="fa fa-calendar-o text-muted card-text" aria-hidden="true">
                                            {{ \Carbon\Carbon::parse($news->created_at)->format('d M') }}</i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @include('front-user.pages.news.partials.recent_post')
    </div>
    {{ $data['news']->links('layouts.general_informations.pagination') }}
@endsection
