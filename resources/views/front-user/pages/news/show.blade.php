@extends('front-user.layouts.master')

@section('meta_title', $data['news']->title)
@section('meta_description', strlen(strip_tags($data['news']->body)) > 550 ? substr(strip_tags($data['news']->body), 0, 550) : strip_tags($data['news']->body))

@section('content')
    <div id="page-berita" class="row ">
        <div class="col-md-8 ">
            <div class="content-left">
                <div class="content-title">
                    <h2>{{ $data['news']->title }}</h2>
                    <p>Penulis - {{ optional($data['news']->createdByUser)->name }}</p>
                    <p class="text-muted">{{ $data['news']->formatted_created_at }}</p>
                </div>
                <div class="content-blog">
                    <img src="{{ $data['news']->img_path }}" alt="" style="width: 100%;">
                    @php
                        echo $data['news']->body;
                    @endphp
                </div>
            </div>
        </div>
        @include('front-user.pages.news.partials.recent_post')
    </div>
@endsection
