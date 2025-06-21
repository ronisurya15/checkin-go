@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 col-12">
            <div class="card">
                <div class="card-header text-white bg-dark d-flex justify-content-between align-items-center">
                    <span>Tambah Pengguna: Siswa</span>
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-warning">Kembali</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('siswa.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="">Nama Pengguna <span class="text-danger">*</span></label>
                            <input type="text" name="nama_pengguna" class="form-control" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="">No HP <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Kelas <span class="text-danger">*</span></label>
                            <select name="kelas_id" class="form-control" required>
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->jenjang_kelas }} - {{ $item->lokasi_ruangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
