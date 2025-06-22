<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;
use App\Models\WaliKelas;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::latest()->get();

        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        $waliKelas = User::where('role_id', 3)->get();

        return view('kelas.create', compact('waliKelas'));
    }

    public function store(Request $request)
    {
        $kelas = Kelas::create($request->all());

        // Create Wali Kelas
        WaliKelas::create([
            'kelas_id' => $kelas->id,
            'guru_id' => $request->wali_kelas
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kelas = Kelas::with('waliKelas')->findOrFail($id);
        $waliKelas = User::where('role_id', 3)->get();

        return view('kelas.edit', compact('kelas', 'waliKelas'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());

        // Update Wali Kelas
        WaliKelas::where('kelas_id', $id)->update([
            'guru_id' => $request->wali_kelas
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diupdate.');
    }

    public function destroy($id)
    {
        Kelas::destroy($id);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
