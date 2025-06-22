@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-white bg-dark d-flex justify-content-between align-items-center">
            <span>Analisis Kehadiran</span>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>Hadir</th>
                        <th>Izin</th>
                        <th>Sakit</th>
                        <th>Tanpa Keterangan</th>
                        <th>Total</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['siswa']['nama'] }}</td>
                        <td>{{ $item['presensi']['hadir'] }}</td>
                        <td>{{ $item['presensi']['izin'] }}</td>
                        <td>{{ $item['presensi']['sakit'] }}</td>
                        <td>{{ $item['presensi']['tanpa'] }}</td>
                        <td>{{ $item['presensi']['total'] }}</td>
                        <td>{{ $item['kelas']->jenjang_kelas }}</td>
                        <td>{{ $item['kelas']->tahun_ajaran }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection