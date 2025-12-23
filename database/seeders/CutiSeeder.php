<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cuti;
use App\Models\Karyawan;

class CutiSeeder extends Seeder
{
    public function run(): void
    {
        // ambil satu karyawan pertama (dummy)
        $karyawan = Karyawan::first();

        if (!$karyawan) {
            return;
        }

        Cuti::create([
            'karyawan_id'   => $karyawan->id,
            'alasan'        => 'Berobat',
            'tanggal_mulai' => '2025-12-12',
            'tanggal_selesai' => '2025-12-15',
            'status'        => 'pending',
        ]);

        Cuti::create([
            'karyawan_id'   => $karyawan->id,
            'alasan'        => 'Acara keluarga',
            'tanggal_mulai' => '2025-12-20',
            'tanggal_selesai' => '2025-12-21',
            'status'        => 'approved',
        ]);
    }
}
