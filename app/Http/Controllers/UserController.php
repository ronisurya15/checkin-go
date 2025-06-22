<?php

namespace App\Http\Controllers;

use App\Models\Kartu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;
use App\Models\OrangTuaSiswa;
use App\Models\UserKelas;
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
            'password' => Hash::make('rahasia'),
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

    // Siswa
    public function createSiswa()
    {
        $kelas = Kelas::where('status', 'Aktif')->get();
        $orangTua = User::where('role_id', 4)->get();

        return view('users.create_siswa', compact('kelas', 'orangTua'));
    }

    public function storeSiswa(Request $request)
    {
        // Initialize
        $name = $request->nama_pengguna;
        $slug = Str::slug($name);
        $unique = Str::random(4);
        $username = $slug . '-' . strtolower($unique);
        $kelas = Kelas::where('id', $request->kelas_id)->first();

        $user = User::create([
            'name' => $name,
            'email' => $username,
            'no_hp' => $request->no_hp,
            'password' => Hash::make('rahasia'),
            'role_id' => 5,
        ]);

        // Create User Kelas
        UserKelas::create([
            'kelas_id' => $request->kelas_id,
            'user_id' => $user->id,
            'tahun_ajaran' => $kelas->tahun_ajaran,
            'tanggal_masuk' => now(),
            'tanggal_keluar' => null,
        ]);

        // Create Kartu
        Kartu::create([
            'user_id' => $user->id,
            'aktif' => 1,
            'uuid' => Str::uuid(),
            'expired_at' => now()->addYears(3)
        ]);

        // Create Orang Tua
        OrangTuaSiswa::create([
            'orang_tua_id' => $request->orangtua_id,
            'siswa_id' => $user->id
        ]);

        return redirect()->route('user.index', 'key=5')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function editSiswa($id)
    {
        $kelas = Kelas::where('status', 'Aktif')->get();
        $orangTua = User::where('role_id', 4)->get();
        $user = User::where('id', $id)->where('role_id', 5)->first();

        if (!$user) {
            return redirect()->route('user.index', 'key=5')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Initialize
        $kelasId = null;
        $orangtuaId = OrangTuaSiswa::where('siswa_id', $user->id)->first();

        if ($orangtuaId) {
            $orangtuaId = $orangtuaId->orang_tua_id;
        }

        foreach ($user->kelas as $key => $item) {
            if ($key == (count($user->kelas) - 1)) {
                $kelasId = $item->id;
            }
        }

        return view('users.edit_siswa', compact('kelas', 'orangTua', 'user', 'kelasId', 'orangtuaId'));
    }

    public function updateSiswa(Request $request, $id)
    {
        $user = User::where('id', $id)->where('role_id', 5)->first();

        if (!$user) {
            return redirect()->route('user.index', 'key=5')->with('error', 'Pengguna tidak ditemukan.');
        }

        $name = $request->nama_pengguna;
        $kelas = Kelas::where('id', $request->kelas_id)->first();

        $user->update([
            'name' => $name,
            'no_hp' => $request->no_hp
        ]);

        // Update Kelas
        $userKelas = UserKelas::where('user_id', $id)->latest()->first();

        if ($userKelas) {
            $userKelas->update([
                'kelas_id' => $request->kelas_id,
                'tahun_ajaran' => $kelas->tahun_ajaran
            ]);
        }

        // Update Orang Tua
        OrangTuaSiswa::where('siswa_id', $id)->delete();

        OrangTuaSiswa::create([
            'orang_tua_id' => $request->orangtua_id,
            'siswa_id' => $user->id
        ]);

        return redirect()->route('user.index', 'key=5')->with('success', 'Siswa berhasil diedit.');
    }

    public function profil()
    {
        $user = auth()->user();
        return view('users.profil', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username' => 'required|string|unique:users,username,' . $user->id,
            'no_hp' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);

        $user->username = $request->username;
        $user->no_hp = $request->no_hp;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
