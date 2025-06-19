<!DOCTYPE html>
<html>
<head>
    <title>Tambah Presensi</title>
</head>
<body>
    <h2>Tambah Presensi</h2>

    <form action="{{ route('presensi.store') }}" method="POST">
        @csrf

        <div>
            <label>User</label><br>
            <select name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Kelas</label><br>
            <select name="kelas_id" required>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->jenjang_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Tanggal</label><br>
            <input type="date" name="tanggal" required>
        </div>

        <div>
            <label>Waktu Masuk</label><br>
            <input type="datetime-local" name="waktu_masuk">
        </div>

        <div>
            <label>Waktu Keluar</label><br>
            <input type="datetime-local" name="waktu_keluar">
        </div>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('presensi.index') }}">← Kembali ke Daftar</a>
</body>
</html>
