<!DOCTYPE html>
<html>
<head>
    <title>Tambah Notifikasi</title>
</head>
<body>
    <h2>Tambah Notifikasi</h2>

    <form action="{{ route('notifikasi.store') }}" method="POST">
        @csrf

        <div>
            <label>User</label><br>
            <select name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Pesan</label><br>
            <textarea name="value" rows="4" cols="50" required>{{ old('value') }}</textarea>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('notifikasi.index') }}">← Kembali ke Daftar</a>
</body>
</html>
