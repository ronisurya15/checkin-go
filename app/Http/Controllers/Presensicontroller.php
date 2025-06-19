<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\User;
use App\Models\Kelas;

class PresensiController extends Controller
{
    public function index()
    {
        $presensi = Presensi::with('user', 'kelas')->get();
        return view('presensi.index', compact('presensi'));
    }

    public function create()
    {
        $users = User::all();
        $kelas = Kelas::all();
        return view('presensi.create', compact('users', 'kelas'));
    }

    public function store(Request $request)
    {
        Presensi::create($request->all());
        return redirect()->route('presensi.index')->with('success', 'Data presensi berhasil ditambahkan');
    }

    public function show($id)
    {
        $presensi = Presensi::with('user', 'kelas')->findOrFail($id);
        return view('presensi.show', compact('presensi'));
    }

    public function edit($id)
    {
        $presensi = Presensi::findOrFail($id);
        return view('presensi.edit', compact('presensi'));
    }

    public function update(Request $request, $id)
    {
        $presensi = Presensi::findOrFail($id);
        $presensi->update($request->all());
        return redirect()->route('presensi.index')->with('success', 'Data presensi berhasil diupdate');
    }

    public function destroy($id)
    {
        Presensi::destroy($id);
        return redirect()->route('presensi.index')->with('success', 'Data presensi berhasil dihapus');
    }
}
