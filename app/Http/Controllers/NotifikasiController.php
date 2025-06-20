<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\User;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::with('user')->get();
        return view('notifikasi.index', compact('notifikasi'));
    }

    public function create()
    {
        $users = User::all();
        return view('notifikasi.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'value' => 'required|string',
        ]);

        Notifikasi::create($request->all());
        return redirect()->route('notifikasi.index')->with('success', 'Notifikasi berhasil ditambahkan');
    }

    public function show($id)
    {
        $notifikasi = Notifikasi::with('user')->findOrFail($id);
        return view('notifikasi.show', compact('notifikasi'));
    }

    public function edit($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        $users = User::all();
        return view('notifikasi.edit', compact('notifikasi', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'value' => 'required|string',
        ]);

        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->update($request->all());
        return redirect()->route('notifikasi.index')->with('success', 'Notifikasi berhasil diupdate');
    }

    public function destroy($id)
    {
        Notifikasi::destroy($id);
        return redirect()->route('notifikasi.index')->with('success', 'Notifikasi berhasil dihapus');
    }
    
}
