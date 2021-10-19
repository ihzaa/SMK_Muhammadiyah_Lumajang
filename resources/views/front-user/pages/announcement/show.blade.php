@extends('front-user.layouts.master')

@section('meta_title', $data['announcements']->title)
@section('meta_description', strlen(strip_tags($data['announcements']->body)) > 550 ? substr(strip_tags($data['announcements']->body), 0, 550) : strip_tags($data['announcements']->body))


@section('content')
    <div id="page-berita" class="row ">
        <div class="col-md-8 ">
            <div class="content-left">
                <div class="content-title">
                    <h2>{{ $data['announcements']->title }}</h2>
                    <p>Penulis - {{ optional($data['announcements']->createdByUser)->name }}</p>
                    <p class="text-muted">{{ $data['announcements']->formatted_created_at }}</p>
                </div>
                <div class="content-blog">
                    <img src="{{ $data['announcements']->img_path }}" alt="" style="width: 100%;">
                    @php
                        echo $data['announcements']->body;
                    @endphp
                </div>
            </div>
        </div>
        @include('front-user.pages.announcement.partials.recent_post')
    </div>
@endsection
