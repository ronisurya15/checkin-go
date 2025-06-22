<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;
use Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('role_id', $request->key)->latest()->get();

        return view('users.index', compact('users', 'request'));
    }

    public function destroy(Request $request, $id)
    {
        User::destroy($id);

        return redirect()->route('user.index', 'key=' . $request->key)->with('success', 'Berhasil menghapus pengguna.');
    }

    // Orang Tua
    public function createOrangtua()
    {
        return view('users.create_orangtua');
    }

    public function storeOrangtua(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'no_hp' => 'required',
            'password' => 'required|min:6',
        ]);

        // Initialize
        $name = $request->nama_pengguna;
        $slug = Str::slug($name);
        $unique = Str::random(4);
        $username = $slug . '-' . strtolower($unique);

        // Simpan user
        User::create([
            'name' => $name,
            'email' => $username,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role_id' => 4
        ]);

        return redirect()->route('user.index', 'key=4')->with('success', 'Orang tua berhasil ditambahkan.');
    }

    public function editOrangtua($id)
    {
        $user = User::where('id', $id)->where('role_id', 4)->first();

        if (!$user) {
            return redirect()->route('user.index', 'key=4')->with('error', 'Pengguna tidak ditemukan.');
        }

        return view('users.edit_orangtua', compact('user'));
    }

    public function updateOrangtua(Request $request, $id)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'no_hp' => 'required',
            'password' => 'nullable|min:6',
        ]);

        // Initialize
        $user = User::where('id', $id)->where('role_id', 4)->first();
        $user->update([
            'name' => $request->nama_pengguna,
            'no_hp' => $request->no_hp,
            'password' => ($request->password) ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('user.index', 'key=4')->with('success', 'Orang tua berhasil diedit.');
    }


    public function createSiswa()
    {
        $kelas = Kelas::all();
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
            'role_id' => 5,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    // public function create()
    // {
    //     $roles = Role::all();
    //     return view('users.create', compact('roles'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama_pengguna' => 'required|string|max:255',
    //         'username' => 'required|unique:users',
    //         'no_hp' => 'required',
    //         'password' => 'required',
    //         'peran' => 'required'
    //     ]);

    //     User::create([
    //         'name' => $request->nama_pengguna,
    //         'username' => $request->username,
    //         'no_hp' => $request->no_hp,
    //         'password' => Hash::make($request->password),
    //         'peran' => $request->peran,
    //     ]);

    //     return redirect()->route('users.index');
    // }

    // public function edit($id)
    // {
    //     $user = User::findOrFail($id);
    //     $roles = Role::all();
    //     return view('users.edit', compact('user', 'roles'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->update([
    //         'name' => $request->nama_pengguna,
    //         'username' => $request->username,
    //         'no_hp' => $request->no_hp,
    //         'peran' => $request->peran,
    //     ]);

    //     if ($request->filled('password')) {
    //         $user->password = Hash::make($request->password);
    //         $user->save();
    //     }

    //     return redirect()->route('users.index');
    // }
}
