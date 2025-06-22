@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Profil Pengguna
        </div>
        <div class="card-body">
            <form action="{{ route('profil.update') }}" method="POST" id="form-profil">
                @csrf

                <div class="mb-3">
                    <label>Nama Pengguna</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="{{ $user->username }}" readonly>
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ $user->no_hp }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Password (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" readonly>
                </div>

                <div class="mb-3">
                    <label>Peran</label>
                    <input type="text" class="form-control" value="{{ $user->peran }}" readonly>
                </div>

                <div id="tombol-edit">
                    <button type="button" class="btn btn-primary" onclick="aktifkanEdit()">Edit</button>
                </div>

                <div id="tombol-simpan" class="d-none">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" onclick="batalEdit()">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
    function aktifkanEdit() {
        const form = document.getElementById('form-profil');
        const inputs = form.querySelectorAll('input');

        inputs.forEach(input => {
            if (input.name !== '' && input.getAttribute('name') !== 'password') {
                input.removeAttribute('readonly');
            }
            if (input.name === 'password') {
                input.removeAttribute('readonly');
                input.value = '';
            }
        });

        document.getElementById('tombol-edit').classList.add('d-none');
        document.getElementById('tombol-simpan').classList.remove('d-none');
    }

    function batalEdit() {
        location.reload();
    }
</script>
@endsection
