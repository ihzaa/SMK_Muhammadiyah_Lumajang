@extends('admin.template.master')

@section('page_title', 'Halaman Tentang SMK MULU')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Halaman Tentang SMK MULU
                </div>
                <form action="{{ route('admin.pages.about-us.update') }}" method="POST" autocomplete="off"
                    class="mb-0" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <img id="img-preview" class="img-fluid m-auto" src="{{ asset($data->img_path) }}"
                                    alt="your image" />
                            </div>
                            <div class="col-md-8">
                                <label>Foto <span class="text-danger">*</span></label>
                                <div class="custom-file mb-5">
                                    <input type="file" class="custom-file-input img-input" data-previewTarget="#img-preview"
                                        name="image">
                                    <label class="custom-file-label">Pilih Foto</label>
                                    <small class="form-text text-muted">- Ukuran max 2048 KB</small>
                                    <small class="form-text text-muted">- Harus berupa gambar (format: jpg,
                                        jpeg, svg, png , dll)</small>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="">Isi / Body <span class="text-danger">*</span></label>
                                <textarea id="summernote" name="body">{{ $data->body }}</textarea>
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
            $('#summernote').summernote({
                placeholder: 'Tuliskan disini.',
                toolbar: [
                    ['style', ['style']],
                    ['fontname', ['fontname']],
                    ['font', ['bold', 'underline', 'italic', 'strikethrough', 'superscript',
                        'subscript', 'clear'
                    ]],
                    ['color', ['forecolor', 'backcolor']],
                    ['para', ['ul', 'ol', 'paragraph', 'height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            });

            $('form').submit(function() {
                if ($('#summernote').summernote('isEmpty')) {
                    alert('Isi / Body Tidak Boleh Kosong!')
                    event.preventDefault();
                }
            })
        });
    </script>
@endpush
