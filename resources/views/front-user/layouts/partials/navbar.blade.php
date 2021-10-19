<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light header">
        <div class="container">
            <img src="{{ asset('front-user') }}/images/logo.png" class="top-logo">
            <button class="navbar-toggler navbar-collapse-right no-border" type="button" data-toggle="collapse"
                data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ml-auto text-center">
                    <li class="nav-item">
                        <a class="nav-link scroll-to-section" href="{{ route('front-user.landing-page') }}">
                            <p>Beranda</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll-to-section" href="{{ route('front-user.about-us.index') }}">
                            <p>Tentang MULU</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll-to-section" href="{{ route('front-user.news.index') }}">
                            <p>Berita</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll-to-section" href="">
                            <p>PPDB</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll-to-section" href="">
                            <p>Fasilitas</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
