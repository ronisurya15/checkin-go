@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-white bg-dark d-flex justify-content-between align-items-center">
            <span>Daftar Presensi - <b>{{ $description }}</b></span>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        @if (auth()->user()->role_id != 5)
                        <th>Nama Siswa</th>
                        @endif
                        <th>Tanggal</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presensi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @if (auth()->user()->role_id != 5)
                        <td>{{ $item->user->name }}</td>
                        @endif
                        <td>{{ date('d F Y', strtotime($item->tanggal)) }}</td>
                        <td>{{ $item->waktu_masuk }}</td>
                        <td>{{ ($item->waktu_keluar) ? $item->waktu_keluar : '-' }}</td>
                        <td>{{ $item->kelas->jenjang_kelas }}</td>
                        <td>{{ $item->kelas->tahun_ajaran }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection