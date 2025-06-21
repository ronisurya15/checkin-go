@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-header text-white bg-dark d-flex justify-content-between align-items-center">
                    <span>Edit Pengguna</span>
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-warning">Kembali</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Nama Pengguna <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_pengguna" required value="{{ $user->name }}">
                        </div>

                        <div class="form-group mt-2">
                            <label>Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" required value="{{ $user->username }}">
                        </div>

                        <div class="form-group mt-2">
                            <label>No HP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_hp" required value="{{ $user->no_hp }}">
                        </div>

                        <div class="form-group mt-2">
                            <label>Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <div class="form-group mt-2">
                            <label>Peran <span class="text-danger">*</span></label>
                            <select name="peran" class="form-control" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->nama }}" {{ $user->peran == $role->nama ? 'selected' : '' }}>
                                        {{ ucfirst($role->nama) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-2 mb-2">
                            <hr>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
