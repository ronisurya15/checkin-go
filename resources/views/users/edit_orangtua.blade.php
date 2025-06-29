@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 col-12">
            <div class="card">
                <div class="card-header text-white bg-dark d-flex justify-content-between align-items-center">
                    <span>Tambah Pengguna : Orang Tua</span>
                    <a href="{{ route('user.index') }}?key=4" class="btn btn-sm btn-warning">Kembali</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('orangtua.update', $user->id) }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Nama Pengguna <span class="text-danger">*</span></label>
                            <input type="text" name="nama_pengguna" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="">No HP <span class="text-danger">*</span></label>
                            <input type="number" name="no_hp" class="form-control" value="{{ $user->no_hp }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection