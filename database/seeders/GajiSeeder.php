<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use App\Models\Gaji;

class GajiSeeder extends Seeder
{
    public function run(): void
    {
        $karyawan = Karyawan::first();

        if (!$karyawan) {
            return;
        }

        $gajiPokok = 20000000;
        $totalPotongan = 0;

        Gaji::create([
            'karyawan_id'    => $karyawan->id,
            'gaji_pokok'     => $gajiPokok,
            'total_potongan' => $totalPotongan,
            'total_gaji'     => $gajiPokok - $totalPotongan,
            'periode'        => '2026-01',
        ]);
    }
}
