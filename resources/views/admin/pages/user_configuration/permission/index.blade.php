@extends('admin.template.master')

@section('page_title', 'Perizinan')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                List Peran
                <div class="card-tools">
                    <a class="btn btn-primary" href="{{ route('admin.user_config.permission.createGet') }}"><i
                            class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                </div>
                <!-- /.card-tools -->
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="main-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Terakhir Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@include('layouts.data_tables.basic_data_tables')

@push('scripts')
<script>
    $(function() {
        $('#main-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! url()->full() !!}',
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    className: "text-center"
                }
            ]
        });
    });
</script>
@endpush
