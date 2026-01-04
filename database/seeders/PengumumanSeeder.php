<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengumuman;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        Pengumuman::create([
            'jenis_pengumuman' => 'Pengingat',
            'deskripsi' => 'Mengadakan pertemuan dengan perusahaan A',
            'kepada' => 'Produksi Tim Kreatif',
            'waktu' => '2025-01-04',
        ]);

        Pengumuman::create([
            'jenis_pengumuman' => 'Informasi',
            'deskripsi' => 'Libur nasional dalam rangka hari besar',
            'kepada' => 'Semua Karyawan',
            'waktu' => '2025-01-10',
        ]);
    }
}
