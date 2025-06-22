<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    protected $guarded = [];
    protected $table = 'wali_kelas';

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
