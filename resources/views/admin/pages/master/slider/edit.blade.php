@extends('admin.template.master')

@section('page_title', 'Edit Slider')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit Slider
                </div>
                <form action="{{ route('admin.master.slider.update', [$data['id']]) }}" method="POST" autocomplete="off"
                    class="mb-0" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img id="blah" class="img-fluid m-auto" src="{{ asset($data['img_path']) }}"
                                    alt="your image" />
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama"
                                        value="{{ $data['name'] }}">
                                </div>
                                <label>Foto <span class="text-danger">*</span></label>
                                <div class="custom-file mb-5">
                                    <input type="file" class="custom-file-input" id="imgInp" name="image">
                                    <label class="custom-file-label" for="imgInp">Foto Slider</label>
                                    <small class="form-text text-muted">- Ukuran max 2048 KB</small>
                                    <small class="form-text text-muted">- Harus berupa gambar (format: jpg,
                                        jpeg, svg, png , dll)</small>
                                </div>
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

@push('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
    </script>
@endpush
