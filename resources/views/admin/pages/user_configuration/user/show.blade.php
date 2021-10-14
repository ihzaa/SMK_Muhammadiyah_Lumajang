@extends('admin.template.master')

@section('page_title', 'User')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit User {{ $data['obj']->name }}
                </div>
                <form action="{{ route('admin.user_config.user.update', ['id' => $data['obj']->id]) }}" method="POST"
                    autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama User <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama User..."
                                value="{{ $data['obj']->name }}">
                        </div>
                        <div class="form-group">
                            <label for="username">Username User <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" readonly placeholder="Username User..."
                                value="{{ $data['obj']->username }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email User <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email User..."
                                value="{{ $data['obj']->email }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password User <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Kosongkan kolom password jika tidak ingin merubah password" autocomplete="off"
                                value="">
                        </div>
                        <div class="form-group">
                            <label for="role">Peran User <span class="text-danger">*</span></label>
                            <select class="form-control" id="role" name="role">
                                <option value="" disabled @if (count($data['user_role']) == 0) selected @endif>Pilih Peran User...</option>
                                @foreach ($data['roles'] as $k => $v)
                                    <option value="{{ $k }}" @if (count($data['user_role']) > 0)  @if ($data['user_role'][0]==$v) selected @endif
                                @endif>
                                {{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        @if ($data['obj']->trashed())
                            @can('restore')
                                <a class="btn btn-danger btn-info"
                                    href="{{ route('admin.user_config.user.restore', ['id' => $data['obj']->id]) }}"
                                    data-toggle="tooltip" data-placement="top" title="Hapus"
                                    onclick="return confirm('Yakin Mengembalikan?')"><i class="far fa-trash-alt"></i>
                                    Kembalikan</a>
                            @endcan
                        @else
                            @can('user update')
                                <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            @endcan
                            @can('delete')
                                <a class="btn btn-danger btn-delete"
                                    href="{{ route('admin.user_config.user.delete', ['id' => $data['obj']->id]) }}"
                                    data-toggle="tooltip" data-placement="top" title="Hapus"
                                    onclick="return confirm('Yakin Menghapus?')"><i class="far fa-trash-alt"></i> Hapus</a>
                            @endcan
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
