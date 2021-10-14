@extends('admin.template.master')

@section('page_title', 'Perizinan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="{{ route('admin.user_config.permission.createPost') }}" method="POST">
                <div class="card-header">
                    Tambah Perizinan
                    <div class="card-tools">

                    </div>
                    <!-- /.card-tools -->
                </div>
                @csrf
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="name">Nama Peran<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Nama Peran" name="name"
                            value="{{ old('name') }}">
                    </div>
                    <hr>
                    <h4>List Perizinan</h4>
                    <table class="table table-bordered" id="main-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Aktif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                                $grubCounter = 0;
                                $checkedCounter = 0;
                            @endphp
                            @foreach ($data['permission'] as $permission)
                                @if ($i == 0)
                                    <tr>
                                        <td>
                                            <strong>
                                                {{ substr($permission->name, strpos($permission->name, ' ') + 1) }}
                                            </strong>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input master-checkbox"
                                                    id="master-checkbox-{{ $grubCounter }}"
                                                    data-id="{{ $grubCounter }}" type="checkbox">
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td class="text-center">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input permission-checkbox checkbox-{{ $grubCounter }}"
                                                data-id="{{ $grubCounter }}" type="checkbox"
                                                value="{{ $permission->id }}" name="permission[]"
                                                @if (old('permission') != null)
                                                    @if (in_array($permission->id,old('permission')))
                                                        {{ 'checked' }}
                                                        @php
                                                            $checkedCounter++;
                                                        @endphp
                                                    @endif
                                                @endif>
                </div>
                </td>
                </tr>
                @if ($checkedCounter == 5)
                    @push('scripts')
                        <script>
                            let masterCheckboxId = "{{ $grubCounter }}";
                            document.getElementById("master-checkbox-" + masterCheckboxId).checked = true;
                        </script>
                    @endpush
                @endif
                @if ($i == 4)
                    <tr>
                        <td colspan="2" style="background-color: #b0b0b0"></td>
                    </tr>
                @endif
                @php
                    $i++;
                    if ($i == 5) {
                        $i = 0;
                        $grubCounter++;
                        $checkedCounter = 0;
                    }
                @endphp
                @endforeach
                </tbody>
                </table>
                <div class="row pt-2">
                    <div class="col-md-12">
                        <small class="mt-2">Perizinan <strong>view</strong> akan otomatis terisi jika perizinan
                            dibawahnya diizinkan.</small>
                    </div>
                </div>
        </div>
        <div class="card-footer d-flex">
            <button class="btn btn-primary ml-auto mr-2" type="submit"><i class="fa fa-check" aria-hidden="true"></i>
                Tambah</button>
        </div>
        </form>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('AdminLTE-3.1.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
@endpush

@push('scripts')
<script>
    $('.permission-checkbox').change(function() {
        let id = $(this).data('id')
        let checkbox = $('.checkbox-' + id)
        checkbox = $.map(checkbox, function(value, index) {
            return [value];
        });
        firstCheckbox = checkbox[0]
        checkbox = checkbox.slice(1)
        isChecked = 0;
        for (let i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked) {
                isChecked++;
            }
        }
        if (firstCheckbox != this) {
            if (isChecked > 0) {
                firstCheckbox.checked = true;
            }
        } else {
            if (isChecked > 0) {
                firstCheckbox.checked = true;
                alert('Perizinan view harus aktif jika perizinan dibawahnya diizinkan!')
            }
        }
    })

    $('.master-checkbox').change(function() {
        let id = $(this).data('id')
        let checkbox = $('.checkbox-' + id)
        checkbox = $.map(checkbox, function(value, index) {
            return [value];
        });
        let checked = this.checked

        if (checked) {
            for (let i = 0; i < checkbox.length; i++) {
                checkbox[i].checked = true;
            }
        } else {
            for (let i = 0; i < checkbox.length; i++) {
                checkbox[i].checked = false;
            }
        }
    })
</script>
@endpush
