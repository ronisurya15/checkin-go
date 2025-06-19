<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenjang_kelas',
        'lokasi_ruangan',
        'status',
        'tahun_ajaran'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
}
