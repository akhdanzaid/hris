<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Karyawan;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'email',
        'role',
        'karyawan_id',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // ======================
    // RELASI USER → KARYAWAN
    // ======================
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    // ======================
    // HELPER
    // ======================
    public function isHRD(): bool
    {
        return $this->role === 'hrd';
    }

    public function isKaryawan(): bool
    {
        return $this->role === 'karyawan';
    }
}
