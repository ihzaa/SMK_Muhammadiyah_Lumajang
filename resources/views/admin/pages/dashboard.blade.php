@extends('admin.template.master')

@section('page_title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-lime">
                <div class="inner">
                    <h3>{{ $data['user'] }}</h3>
                    <p>User</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('admin.user_config.user.index') }}" class="small-box-footer">Lihat <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3>{{ $data['slider'] }}</h3>
                    <p>Slider</p>
                </div>
                <div class="icon">
                    <i class="fa fa-images"></i>
                </div>
                <a href="{{ route('admin.master.slider.index') }}" class="small-box-footer">Lihat <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-navy">
                <div class="inner">
                    <h3>{{ $data['news'] }}</h3>
                    <p>Berita</p>
                </div>
                <div class="icon">
                    <i class="fa fa-newspaper"></i>
                </div>
                <a href="{{ route('admin.master.news.index') }}" class="small-box-footer">Lihat <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $data['announcement'] }}</h3>
                    <p>Pengumuman</p>
                </div>
                <div class="icon">
                    <i class="fa fa-bullhorn"></i>
                </div>
                <a href="{{ route('admin.master.announcement.index') }}" class="small-box-footer">Lihat <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $data['facility'] }}</h3>
                    <p>Fasilitas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-handshake"></i>
                </div>
                <a href="{{ route('admin.master.facility.index') }}" class="small-box-footer">Lihat <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection
