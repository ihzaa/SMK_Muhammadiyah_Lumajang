<div class="col-md-4">
    <div class="content-right" style="margin-top: 160px; margin-right: 20px;">
        <div class="recent-post">
            <p class="" style="font-size: 20px; font-weight: bold;">Recent Post</p>
            <hr>
            @foreach ($data['recentAnnouncements'] as $recentAnnouncement)
                <div class="card-sidebar d-flex">
                    {{-- <img src="{{ $recentAnnouncement->thumbnail() }}" alt="" style="width: 20%;"> --}}
                    <a href="{{ $recentAnnouncement->generateURL('front-user.announcement.show', ['title' => 'title', 'id' => 'id']) }}"
                        style="text-decoration: none; margin-left: 18px !important; color: black; ">{{ $recentAnnouncement->title }}<br><span
                            class="text-muted">{{ \Carbon\Carbon::parse($recentAnnouncement->created_at)->format('d M') }}</span></a>
                </div>
            @endforeach
        </div>
    </div>
</div>
