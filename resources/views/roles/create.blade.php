<!DOCTYPE html>
<html>
<head>
    <title>Tambah Role</title>
</head>
<body>
    <h2>Tambah Role</h2>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf

        <div>
            <label>Nama</label><br>
            <input type="text" name="nama" required value="{{ old('nama') }}">
        </div>

        <div>
            <label>No HP</label><br>
            <input type="text" name="no_hp" required value="{{ old('no_hp') }}">
        </div>

        <div>
            <label>Email</label><br>
            <input type="email" name="email" required value="{{ old('email') }}">
        </div>

        <div>
            <label>Role Induk</label><br>
            <select name="role_id" required>
                @foreach($roles as $r)
                    <option value="{{ $r->id }}">{{ $r->nama }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('roles.index') }}">← Kembali ke Daftar</a>
</body>
</html>
