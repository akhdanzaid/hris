<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID karyawan secara DINAMIS
        $ihsanId = DB::table('karyawan')->where('email', 'ihsan@gmail.com')->value('id');
        $iqbalId = DB::table('karyawan')->where('email', 'iqbal@gmail.com')->value('id');
        $riszkiId = DB::table('karyawan')->where('email', 'qiszki@gmail.com')->value('id');

        if (!$ihsanId || !$iqbalId || !$riszkiId) {
            throw new \Exception('Seeder User gagal: data karyawan belum lengkap.');
        }

        // =========================
        // HRD
        // =========================
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin123'),
                'email' => 'admin@gmail.com',
                'role' => 'hrd',
                'karyawan_id' => null,
            ]
        );

        // =========================
        // KARYAWAN
        // =========================
        User::updateOrCreate(
            ['username' => 'ihsanAnafi'],
            [
                'password' => Hash::make('ihsanganteng'),
                'email' => 'ihsan@gmail.com',
                'role' => 'karyawan',
                'karyawan_id' => $ihsanId,
            ]
        );

        User::updateOrCreate(
            ['username' => 'iqbal3'],
            [
                'password' => Hash::make('iqbalganteng'),
                'email' => 'iqbal@gmail.com',
                'role' => 'karyawan',
                'karyawan_id' => $iqbalId,
            ]
        );

        User::updateOrCreate(
            ['username' => 'riszki'],
            [
                'password' => Hash::make('riszkiganteng'),
                'email' => 'riszki@gmail.com',
                'role' => 'karyawan',
                'karyawan_id' => $riszkiId,
            ]
        );
    }
}
