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
