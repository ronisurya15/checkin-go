@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Presensi</h2>

    <form action="{{ route('presensi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Kelas</label>
            <select name="kelas_id" class="form-control">
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->jenjang_kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Waktu Masuk</label>
            <input type="datetime-local" name="waktu_masuk" class="form-control">
        </div>
        <div class="mb-3">
            <label>Waktu Keluar</label>
            <input type="datetime-local" name="waktu_keluar" class="form-control">
        </div>
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
