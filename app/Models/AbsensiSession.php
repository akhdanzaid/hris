<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AbsensiSession extends Model
{
    use HasFactory;

    protected $table = 'absensi_sessions';

    /**
     * Kolom yang boleh diisi mass assignment
     */
    protected $fillable = [
        'tanggal',
        'tipe',          // hadir | pulang
        'token',
        'is_active',
        'jam_mulai',
        'jam_selesai',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'tanggal'   => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Booted model
     * - Generate token otomatis saat CREATE
     * - Menjamin token SELALU ada
     */
    protected static function booted()
    {
        static::creating(function ($session) {
            if (!$session->token) {
                $session->token = (string) Str::uuid();
            }
        });
    }
}
