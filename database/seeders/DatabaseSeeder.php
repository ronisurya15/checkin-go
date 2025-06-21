<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kartu;
use App\Models\Kelas;
use App\Models\OrangTuaSiswa;
use App\Models\Role;
use App\Models\User;
use App\Models\UserKelas;
use Illuminate\Database\Seeder;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create Role
        Role::create([
            'nama' => 'Admin'
        ]);

        Role::create([
            'nama' => 'Tenaga Kependidikan'
        ]);

        Role::create([
            'nama' => 'Guru'
        ]);

        Role::create([
            'nama' => 'Orang Tua Siswa'
        ]);

        Role::create([
            'nama' => 'Siswa'
        ]);

        // Create Users
        User::create([
            'name' => 'SMK Mekar Arum',
            'email' => 'adminsekolah',
            'no_hp' => '081222821596',
            'password' => bcrypt('rahasia'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Solehudin',
            'email' => 'solehudin',
            'no_hp' => '081222821597',
            'password' => bcrypt('rahasia'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'Dadang Iskandar',
            'email' => 'dadang',
            'no_hp' => '081222821598',
            'password' => bcrypt('rahasia'),
            'role_id' => 3
        ]);

        User::create([
            'name' => 'Alex Pastor',
            'email' => 'alexpastor',
            'no_hp' => '081222821599',
            'password' => bcrypt('rahasia'),
            'role_id' => 3
        ]);

        $ortuSatu = User::create([
            'name' => 'Emilia Az-zahra',
            'email' => 'emiliaaz',
            'no_hp' => '081222821510',
            'password' => bcrypt('rahasia'),
            'role_id' => 4
        ]);

        $siswaSatu = User::create([
            'name' => 'Seira Az-zahra',
            'email' => 'seiraaz',
            'no_hp' => '081222821511',
            'password' => bcrypt('rahasia'),
            'role_id' => 5
        ]);

        OrangTuaSiswa::create([
            'orang_tua_id' => $ortuSatu->id,
            'siswa_id' => $siswaSatu->id
        ]);

        // Orang tua kedua
        $ortu2 = User::create([
            'name' => 'Rahma Fauziah',
            'email' => 'rahma',
            'no_hp' => '081333933920',
            'password' => bcrypt('rahasia'),
            'role_id' => 4
        ]);

        // Siswa kedua
        $siswa2 = User::create([
            'name' => 'Alya Fauziah',
            'email' => 'alyafz',
            'no_hp' => '081333933921',
            'password' => bcrypt('rahasia'),
            'role_id' => 5
        ]);

        // Hubungan orang tua - siswa
        OrangTuaSiswa::create([
            'orang_tua_id' => $ortu2->id,
            'siswa_id' => $siswa2->id
        ]);

        // Create Kelas
        Kelas::create([
            'jenjang_kelas' => 'X IPA 1',
            'lokasi_ruangan' => 'Gedung A - Lantai 2',
            'status' => 'Aktif',
            'tahun_ajaran' => '2024/2025'
        ]);

        Kelas::create([
            'jenjang_kelas' => 'X IPA 2',
            'lokasi_ruangan' => 'Gedung B - Lantai 2',
            'status' => 'Aktif',
            'tahun_ajaran' => '2024/2025'
        ]);

        Kelas::create([
            'jenjang_kelas' => 'XI IPS 1',
            'lokasi_ruangan' => 'Gedung A - Lantai 1',
            'status' => 'Aktif',
            'tahun_ajaran' => '2024/2025',
        ]);

        Kelas::create([
            'jenjang_kelas' => 'XI IPS 2',
            'lokasi_ruangan' => 'Gedung B - Lantai 1',
            'status' => 'Aktif',
            'tahun_ajaran' => '2024/2025',
        ]);

        Kelas::create([
            'jenjang_kelas' => 'XII Bahasa',
            'lokasi_ruangan' => 'Gedung C - Lantai 3',
            'status' => 'Non Aktif',
            'tahun_ajaran' => '2023/2024',
        ]);

        // Create User Kelas
        UserKelas::create([
            'user_id' => $siswaSatu->id,
            'kelas_id' => 1,
            'tahun_ajaran' => '2024/2025',
            'tanggal_masuk' => now(),
            'tanggal_keluar' => null,
        ]);

        UserKelas::create([
            'user_id' => $siswa2->id,
            'kelas_id' => 2,
            'tahun_ajaran' => '2024/2025',
            'tanggal_masuk' => now(),
            'tanggal_keluar' => null,
        ]);

        // Generate Kartu
        $siswaList = User::where('role_id', 5)->get();

        foreach ($siswaList as $siswa) {
            Kartu::create([
                'uuid' => Str::uuid(),
                'user_id' => $siswa->id,
                'aktif' => true,
                'expired_at' => now()->addYears(3)
            ]);
        }
    }
}
