<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <label>Nama Pengguna</label>
    <input type="text" name="nama_pengguna" required><br>

    <label>Username</label>
    <input type="text" name="username" required><br>

    <label>No HP</label>
    <input type="text" name="no_hp" required><br>

    <label>Password</label>
    <input type="password" name="password" required><br>

    <label>Peran</label>
    <select name="peran" required>
        @foreach($roles as $role)
            <option value="{{ $role }}">{{ ucfirst($role) }}</option>
        @endforeach
    </select><br>

    <button type="submit">Simpan</button>
</form>
