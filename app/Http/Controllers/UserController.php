<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create() {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'username' => 'required|unique:users',
            'no_hp' => 'required',
            'password' => 'required',
            'peran' => 'required'
        ]);

        User::create([
            'name' => $request->nama_pengguna,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'peran' => $request->peran,
        ]);

        return redirect()->route('users.index');
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->nama_pengguna,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'peran' => $request->peran,
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('users.index');
    }

    public function destroy($id) {
        User::destroy($id);
        return redirect()->route('users.index');
    }

    public function createOrangtua()
{
    return view('users.create_orangtua');
}

public function storeOrangtua(Request $request)
{
    $request->validate([
        'nama_pengguna' => 'required|string|max:255',
        'username' => 'required|unique:users',
        'no_hp' => 'required',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $request->nama_pengguna,
        'username' => $request->username,
        'no_hp' => $request->no_hp,
        'password' => Hash::make($request->password),
        'peran' => 'Orang Tua', // langsung set peran
    ]);

    return redirect()->route('users.index')->with('success', 'Orang tua berhasil ditambahkan.');
}


public function createSiswa()
{
    $kelas = Kelas::all(); // ambil data kelas dari DB
    return view('users.create_siswa', compact('kelas'));
}

public function storeSiswa(Request $request)
{
    $request->validate([
        'nama_pengguna' => 'required|string|max:255',
        'username' => 'required|unique:users',
        'no_hp' => 'required',
        'password' => 'required|min:6',
        'kelas_id' => 'required|exists:kelas,id',
    ]);

    User::create([
        'name' => $request->nama_pengguna,
        'username' => $request->username,
        'no_hp' => $request->no_hp,
        'password' => Hash::make($request->password),
        'peran' => 'Siswa',
        'kelas_id' => $request->kelas_id,
    ]);

    return redirect()->route('users.index')->with('success', 'Siswa berhasil ditambahkan.');
}

}
