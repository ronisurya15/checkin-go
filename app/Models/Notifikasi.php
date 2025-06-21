<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';
    protected $casts = ['value' => 'array'];

    protected $fillable = [
        'user_id',
        'value'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
