<div class="col-md-4">
    <div class="content-right" style="margin-top: 160px; margin-right: 20px;">
        <div class="recent-post">
            <p class="" style="font-size: 20px; font-weight: bold;">Recent Post</p>
            <hr>
            @foreach ($data['recentNews'] as $recentNews)
                <div class="card-sidebar d-flex">
                    <img src="{{ $recentNews->thumbnail() }}" alt="" style="width: 20%;">
                    <a href="{{ $recentNews->generateURL('front-user.news.show', ['title' => 'title', 'id' => 'id']) }}"
                        style="text-decoration: none; margin-left: 18px !important; color: black; ">{{ $recentNews->title }}<br><span
                            class="text-muted">{{ \Carbon\Carbon::parse($recentNews->created_at)->format('d M') }}</span></a>
                </div>
            @endforeach
        </div>
    </div>
</div>
