<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiSession extends Model
{
    use HasFactory;

    protected $table = 'absensi_sessions';

    protected $fillable = [
        'tanggal',
        'tipe',
        'token',
        'is_active',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_active' => 'boolean',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];
}
