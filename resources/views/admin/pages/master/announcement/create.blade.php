@extends('admin.template.master')

@section('page_title', 'Tambah Pengumuman')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tambah Pengumuman Baru
                </div>
                <form action="{{ route('admin.master.announcement.store') }}" method="POST" autocomplete="off"
                    class="mb-0" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label for="title">Judul <span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" id="title" name="title"
                                        placeholder="Judul">{{ old('title') }}</textarea>
                                </div>
                                <label for="">Isi / Body <span class="text-danger">*</span></label>
                                <textarea id="summernote" name="body">{{ old('body') }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <p><span class="text-danger">*</span> : Harus diisi</p>
                        </div>
                    </div>
                    <div class="card-footer text-muted d-flex">
                        <a href="{{ route('admin.master.announcement.index') }}" class="btn btn-secondary mr-auto"><i
                                class="fas fa-long-arrow-alt-left"></i> Kembali</a>
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
