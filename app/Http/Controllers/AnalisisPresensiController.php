<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AnalisisPresensiController extends Controller
{
    public function index()
    {
        $siswa = User::where('role_id', 5)->get();
        $data = [];

        foreach ($siswa as $user) {
            $hadir = $user->presensi()->where('keterangan', 'Hadir')->count();
            $izin = $user->presensi()->where('keterangan', 'Izin')->count();
            $sakit = $user->presensi()->where('keterangan', 'Sakit')->count();
            $tanpa = $user->presensi()->where('keterangan', 'Tanpa Keterangan')->count();
            $total = ($hadir + $izin + $sakit + $tanpa);
            $persentase = $total > 0 ? round(($hadir / $total) * 100, 2) : 0;

            $row['presensi'] = [
                'hadir' => $hadir,
                'izin' => $izin,
                'sakit' => $sakit,
                'tanpa' => $tanpa,
                'total' => $total,
                'persentase' => $persentase
            ];

            $row['siswa'] = [
                'nama' => $user->name
            ];

            $row['kelas'] = $user->kelas->last();

            $data[] = $row;
        }

        return view('analisis.index', compact('data'));
    }
}
