@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Presensi</h2>

    <ul>
        <li><strong>User:</strong> {{ $presensi->user->nama }}</li>
        <li><strong>Kelas:</strong> {{ $presensi->kelas->jenjang_kelas }}</li>
        <li><strong>Tanggal:</strong> {{ $presensi->tanggal }}</li>
        <li><strong>Masuk:</strong> {{ $presensi->waktu_masuk }}</li>
        <li><strong>Keluar:</strong> {{ $presensi->waktu_keluar }}</li>
    </ul>

    <a href="{{ route('presensi.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
