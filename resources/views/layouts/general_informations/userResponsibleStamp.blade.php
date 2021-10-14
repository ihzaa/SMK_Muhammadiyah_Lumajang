<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Aktifitas Bersangkutan
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Aktivitas</th>
                            <th>Nama User</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Dibuat Oleh</td>
                            <td>{{ optional(\App\Models\User::find($data->created_by))->name }}</td>
                            <td>{{ $data->created_at }}</td>
                        </tr>
                        <tr>
                            <td>Diupdate Oleh</td>
                            <td>{{ optional(\App\Models\User::find($data->updated_by))->name }}</td>
                            <td>{{ $data->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>Dihapus Oleh</td>
                            <td>{{ optional(\App\Models\User::find($data->deleted_by))->name }}</td>
                            <td>{{ $data->deleted_at }}</td>
                        </tr>
                        <tr>
                            <td>Direstore Oleh</td>
                            <td>{{ optional(\App\Models\User::find($data->restored_by))->name }}</td>
                            <td>{{ $data->restored_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
