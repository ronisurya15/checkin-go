@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-white bg-dark d-flex justify-content-between align-items-center">
            <span>Daftar Pengguna</span>
            @if ($request->key == 2)
            <a href="{{ route('orangtua.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            @elseif ($request->key == 3)
            <a href="{{ route('guru.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            @elseif ($request->key == 4)
            <a href="{{ route('orangtua.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            @elseif ($request->key == 5)
            <a href="{{ route('siswa.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            @endif
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>No HP</th>
                        <th>Peran</th>
                        @if ($request->key == 5)
                        <th>Kelas</th>
                        @endif
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ ucfirst($item->role->nama) }}</td>
                        @if ($request->key == 5)
                        <td>
                            @foreach ($item->kelas as $key => $kelas)
                            @if ($key == (count($item->kelas) - 1))
                            {{ $kelas->jenjang_kelas }}
                            @endif
                            @endforeach
                        </td>
                        @endif
                        <td>
                            @if($request->key == 4)
                            <a href="{{ route('orangtua.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @elseif ($request->key == 5)
                            <a href="{{ route('siswa.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @elseif ($request->key == 3)
                            <a href="{{ route('guru.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endif

                            <form action="{{ route('user.destroy', $item->id) }}?key={{ $request->key }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm show-confirm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin!',
                    text: "Hapus pengguna ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection