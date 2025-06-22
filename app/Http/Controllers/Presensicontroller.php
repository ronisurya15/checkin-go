<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\OrangTuaSiswa;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\User;
use App\Models\UserKelas;
use App\Models\WaliKelas;
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
            ->when(auth()->user()->role_id == 3, function ($query) {
                $kelasId = WaliKelas::where('guru_id', auth()->id())->value('kelas_id');
                $siswaIds = UserKelas::where('kelas_id', $kelasId)->pluck('user_id');

                $query->whereIn('user_id', $siswaIds);
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
            ->when(auth()->user()->role_id == 3, function ($query) {
                $kelasId = WaliKelas::where('guru_id', auth()->id())->value('kelas_id');
                $siswaIds = UserKelas::where('kelas_id', $kelasId)->pluck('user_id');

                $query->whereIn('user_id', $siswaIds);
            })
            ->latest()
            ->get();

        return view('presensi.index', compact('presensi', 'description'));
    }

    public function create()
    {
        // Initialize
        $checkExistsData = Presensi::where('user_id', auth()->user()->id)->where('tanggal', date('Y-m-d'))->first();
        $siswa = [];

        if (auth()->user()->role_id == 3) {
            $kelasId = WaliKelas::where('guru_id', auth()->id())->value('kelas_id');

            $siswaIds = UserKelas::where('kelas_id', $kelasId)->pluck('user_id');

            $siswa = User::where('role_id', 5)
                ->whereIn('id', $siswaIds)
                ->get();
        }

        return view('presensi.create', compact('checkExistsData', 'siswa'));
    }

    public function store(Request $request)
    {
        // Check Kelas
        $userId = (auth()->user()->role_id == 5) ?  auth()->user()->id : $request->user_id;
        $kelas = UserKelas::where('user_id', $userId)->latest()->first();
        $tanggal = $request->tanggal;
        $keterangan = (auth()->user()->role_id == 5) ? 'Hadir' : $request->keterangan;
        $checkSiswa = User::where('id', $userId)->first();
        $namaSiswa = (auth()->user()->role_id == 5) ? auth()->user()->name : $checkSiswa->id;

        Presensi::updateOrCreate(
            [
                'user_id' => $userId,
                'kelas_id' => $kelas->kelas_id,
                'tanggal' => $tanggal,
                'waktu_masuk' => $request->waktu_masuk,
            ],
            [
                'waktu_keluar' => $request->waktu_keluar,
                'keterangan' => $keterangan
            ]
        );

        // Create Notif
        Notifikasi::create([
            'user_id' => $userId,
            'value' => [
                'message' => 'Kamu telah melakukan Presensi pada (' . $request->tanggal . ' ' . $request->waktu_masuk . ') dengan keterangan (' . $keterangan . ')'
            ]
        ]);

        // Get Orang Tua
        $orangTua = OrangTuaSiswa::where('siswa_id', $userId)->first();

        if ($orangTua) {
            Notifikasi::create([
                'user_id' => $orangTua->id,
                'value' => [
                    'message' => 'Siswa dengan Nama (' . $namaSiswa . ') telah melakukan presensi pada (' . $request->tanggal . ' ' . $request->waktu_masuk . ') dengan keterangan (' . $keterangan . ')'
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
