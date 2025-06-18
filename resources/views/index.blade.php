@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Presensi</h2>
    <a href="{{ route('presensi.create') }}" class="btn btn-primary mb-3">+ Tambah Presensi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($presensi as $item)
            <tr>
                <td>{{ $item->user->nama }}</td>
                <td>{{ $item->kelas->jenjang_kelas }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->waktu_masuk }}</td>
                <td>{{ $item->waktu_keluar }}</td>
                <td>
                    <a href="{{ route('presensi.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('presensi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('presensi.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus presensi ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
