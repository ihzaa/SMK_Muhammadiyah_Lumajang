@extends('admin.template.master')

@section('page_title', 'Pengaturan Footer')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Pengaturan Footer
                </div>
                <form action="{{ route('admin.pages.footer.update') }}" method="POST" autocomplete="off"
                    class="mb-0" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Tata Cara Menginputkan Video Youtube</h3>
                                <ol>
                                    <li>Buka video yang ingin ditampilkan</li>
                                    <li>Klik bagikan dibawah video</li>
                                    <li>Pilih sematkan dan tekan tombol salin</li>
                                    <li>Pastekan pada salah satu inputan dibawah dan simpan</li>
                                </ol>
                                <small><a href="https://support.google.com/youtube/answer/171780?hl=id">Tata cara juga dapat
                                        dilihat dilink ini.</a></small>
                                <hr>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="">URL Video Youtube <span class="text-danger">*</span></label>
                                <textarea name="url" class="form-control" rows="5" required>{{ $data->url }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>Terakhir update oleh <strong>{{ optional($data->updatedByUser)->name }}</strong> pada
                                    <strong>{{ \Carbon\Carbon::parse($data->updated_at)->format('H:i d-m-Y') }}</strong>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <p><span class="text-danger">*</span> : Harus diisi</p>
                        </div>

                    </div>
                    <div class="card-footer text-muted text-center">
                        <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@include('layouts.images_viewer.image_with_preview')
@include('layouts.wysiwyg.summernote')

@push('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
