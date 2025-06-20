<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'role_id'
    ];

    public function parentRole()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function childRoles()
    {
        return $this->hasMany(Role::class, 'role_id');
    }
}
