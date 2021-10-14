@extends('admin.template.master')

@section('page_title', 'Slider')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    List Slider
                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('admin.master.slider.create') }}"><i
                                class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="main-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Foto</th>
                                <th>Dibuat Pada</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>
                                    @include('layouts.data_tables.th_general_status',['model'=>'\App\Models\Master\Slider'])
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('layouts.data_tables.basic_data_tables')
@include('layouts.images_viewer.lightbox')

@push('scripts')
    <script>
        $(function() {
            let table = $('#main-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url()->full() !!}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'img_path',
                        name: 'img_path'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        sortable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: "text-center"
                    }
                ]
            });

            $(".th-select-option").change(function() {
                let url = "{{ url()->full() }}" + "?status=__status";
                if ($(this).val() != "aktif") {
                    url = url.replace('__status', $(this).val())
                } else if ($(this).val() != "delete") {
                    url = url.replace('__status', $(this).val())
                } else {
                    url = url.replace('__status', 'all')
                }
                table.ajax.url(url).load();
            })

        });
    </script>
@endpush
