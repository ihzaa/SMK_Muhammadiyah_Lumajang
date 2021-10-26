<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light header">
        <div class="container">
            <img src="{{ asset('front-user') }}/images/logo.png" class="top-logo" alt="tol-logo">
            <button class="navbar-toggler navbar-collapse-right no-border" type="button" data-toggle="collapse"
                data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ml-auto text-center">
                    <li class="nav-item {{strpos(Route::currentRouteName(), 'front-user.landing-page') !== false ? 'active' : ''}}">
                        <a class="nav-link" href="{{ route('front-user.landing-page') }}">
                            <p>Beranda</p>
                        </a>
                    </li>
                    <li class="nav-item  {{strpos(Route::currentRouteName(), 'front-user.about-us.index') !== false ? 'active' : ''}}">
                        <a class="nav-link" href="{{ route('front-user.about-us.index') }}">
                            <p>Tentang MULU</p>
                        </a>
                    </li>
                    <li class="nav-item {{strpos(Route::currentRouteName(), 'front-user.news') !== false ? 'active' : ''}}">
                        <a class="nav-link" href="{{ route('front-user.news.index') }}">
                            <p>Berita</p>
                        </a>
                    </li>
                    <li class="nav-item {{strpos(Route::currentRouteName(), 'front-user.announcement') !== false ? 'active' : ''}}">
                        <a class="nav-link" href="{{ route('front-user.announcement.index') }}">
                            <p>Pengumuman</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <p>PPDB</p>
                        </a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link {{strpos(Route::currentRouteName(), 'front-user.facility') !== false ? 'active' : ''}} dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Fasilitas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @php
                                $facilities = \App\Models\Master\Facility::get();
                            @endphp
                            @foreach ($facilities as $facility)
                                <a class="dropdown-item"
                                    href="{{ $facility->generateUrl('front-user.facility.show', ['title' => 'title', 'id' => 'id']) }}">{{ $facility->title }}</a>

                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
