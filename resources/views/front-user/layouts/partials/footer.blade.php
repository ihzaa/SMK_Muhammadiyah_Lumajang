<div id="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-12 content-left">
                <div class="content-up">
                    <div class="img-content">
                        <img src="{{ asset('front-user') }}/images/logo.png" alt="" style="height: 100%; margin: auto">
                    </div>
                    <p class="text-center">{{ env('APP_NAME') }}</p>
                </div>
                <div class="content-down">
                    <p>Jln.Seruni no 1 , Dau Sengkaling</p>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 content-right">
                <div class="row">
                    <div class="col-md-6 content-sosmed text-center">
                        <div class="footer-content">
                            <p class="footer-sosmed">Lihat Kami DI</p>
                            <div class="icon-sosmed">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="display: flex;justify-content: center;">
                        @php
                            echo App\Models\Master\FooterVideo::find(1)->url;
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
