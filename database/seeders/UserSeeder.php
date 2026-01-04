<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // HRD (ADMIN)
        // =========================
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin123'),
                'email' => 'admin@gmail.com',
                'role' => 'hrd',
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
                'karyawan_id' => 2,
            ]
        );
        User::updateOrCreate(
            ['username' => 'iqbal3'],
            [
                'password' => Hash::make('iqbalganteng'),
                'email' => 'iqbal@gmail.com',
                'role' => 'karyawan',
                'karyawan_id' => 3,
            ]
        );
        User::updateOrCreate(
            ['username' => 'riszki'],
            [
                'password' => Hash::make('riszkiganteng'),
                'email' => 'riszki@gmail.com',
                'role' => 'karyawan',
                'karyawan_id' => 4,
            ]
        );
    }
}