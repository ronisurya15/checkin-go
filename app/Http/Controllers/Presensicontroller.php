<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\OrangTuaSiswa;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\UserKelas;
use Carbon\Carbon;

class PresensiController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $description = 'Bulan ' . date('F');

        $presensi = Presensi::with('user', 'kelas')
            ->whereMonth('tanggal', $now->month)
            ->whereYear('tanggal', $now->year)
            ->when(auth()->user()->role_id == 5, function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->when(auth()->user()->role_id == 4, function ($query) {
                $childIds = auth()->user()->anak()->pluck('users.id');
                $query->whereIn('user_id', $childIds);
            })
            ->latest()
            ->get();

        return view('presensi.index', compact('presensi', 'description'));
    }

    public function history()
    {
        $description = 'Semua Bulan';
        $presensi = Presensi::with('user', 'kelas')
            ->when(auth()->user()->role_id == 5, function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->when(auth()->user()->role_id == 4, function ($query) {
                $childIds = auth()->user()->anak()->pluck('users.id');
                $query->whereIn('user_id', $childIds);
            })
            ->latest()
            ->get();

        return view('presensi.index', compact('presensi', 'description'));
    }

    public function create()
    {
        // Initialize
        $checkExistsData = Presensi::where('user_id', auth()->user()->id)->where('tanggal', date('Y-m-d'))->first();

        return view('presensi.create', compact('checkExistsData'));
    }

    public function store(Request $request)
    {
        // Check Kelas
        $kelas = UserKelas::where('user_id', auth()->user()->id)->latest()->first();
        $tanggal = $request->tanggal;

        Presensi::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'kelas_id' => $kelas->kelas_id,
                'tanggal' => $tanggal,
                'waktu_masuk' => $request->waktu_masuk,
            ],
            [
                'waktu_keluar' => $request->waktu_keluar,
            ]
        );

        // Create Notif
        Notifikasi::create([
            'user_id' => auth()->user()->id,
            'value' => [
                'message' => 'Kamu telah melakukan presensi Masuk pada (' . $request->tanggal . ' ' . $request->waktu_masuk . ')'
            ]
        ]);

        // Get Orang Tua
        $orangTua = OrangTuaSiswa::where('siswa_id', auth()->user()->id)->first();

        if ($orangTua) {
            Notifikasi::create([
                'user_id' => $orangTua->id,
                'value' => [
                    'message' => 'Siswa dengan Nama (' . auth()->user()->name . ') telah melakukan presensi pada (' . $request->tanggal . ' ' . $request->waktu_masuk . ')'
                ]
            ]);
        }

        return redirect()->route('presensi.index')->with('success', 'Presensi berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        Presensi::destroy($id);
        return redirect()->route('presensi.index')->with('success', 'Presensi berhasil dihapus.');
    }
}
