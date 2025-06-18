@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Presensi</h2>

    <form action="{{ route('presensi.update', $presensi->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $presensi->tanggal }}">
        </div>
        <div class="mb-3">
            <label>Waktu Masuk</label>
            <input type="datetime-local" name="waktu_masuk" class="form-control" value="{{ $presensi->waktu_masuk }}">
        </div>
        <div class="mb-3">
            <label>Waktu Keluar</label>
            <input type="datetime-local" name="waktu_keluar" class="form-control" value="{{ $presensi->waktu_keluar }}">
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
