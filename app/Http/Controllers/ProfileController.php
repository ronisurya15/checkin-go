<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'password' => ($request->password) ? bcrypt($request->password) : $user->password
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diedit.');
    }
}
