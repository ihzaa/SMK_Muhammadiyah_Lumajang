@extends('admin.template.master')

@section('page_title', 'User')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Tambah User Baru
            </div>
            <form action="{{ route('admin.user_config.user.createPost') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama User <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama User..."
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="username">Username User <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Username User..." value="{{ old('username') }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email User <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email User..."
                            value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password User <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password User...">
                    </div>
                    <div class="form-group">
                        <label for="role">Peran User <span class="text-danger">*</span></label>
                        <select class="form-control" id="role" name="role">
                            <option value="">Pilih Peran User...</option>
                            @foreach ($data['roles'] as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer text-muted text-center">
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
