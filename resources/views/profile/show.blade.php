@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Profil Pengguna
        </div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST" id="form-profil">
                @csrf
                <div class="mb-3">
                    <label>Nama Pengguna <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" value="{{ $user->name }}" name="name" required>
                </div>

                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="{{ $user->email }}" readonly>
                </div>

                <div class="mb-3">
                    <label>No HP <span class="text-danger">*</span></label>
                    <input type="text" name="no_hp" class="form-control" value="{{ $user->no_hp }}" required>
                </div>

                <div class="mb-3">
                    <label>Password <small class="text-info">(Kosongkan jika tidak ingin diubah)</small></label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••">
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection