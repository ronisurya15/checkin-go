<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}
