<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kelas</title>
</head>
<body>
    <h2>Tambah Kelas</h2>

    <form action="{{ route('kelas.store') }}" method="POST">
        @csrf

        <div>
            <label>Jenjang Kelas</label><br>
            <input type="text" name="jenjang_kelas" required value="{{ old('jenjang_kelas') }}">
        </div>

        <div>
            <label>Lokasi Ruangan</label><br>
            <input type="text" name="lokasi_ruangan" required value="{{ old('lokasi_ruangan') }}">
        </div>

        <div>
            <label>Status</label><br>
            <select name="status" required>
                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Non Aktif" {{ old('status') == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
            </select>
        </div>

        <div>
            <label>Tahun Ajaran</label><br>
            <input type="text" name="tahun_ajaran" required value="{{ old('tahun_ajaran') }}">
        </div>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('kelas.index') }}">← Kembali ke Daftar</a>
</body>
</html>
