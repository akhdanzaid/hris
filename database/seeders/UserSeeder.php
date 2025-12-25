<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'email' => 'admin@gmail.com',
            'role' => 'hrd'
        ]);

         User::create([
            'username' => 'ihsanAnafi',
            'password' => Hash::make('ihsanganteng'),
            'email' => 'ihsan@gmail.com',
            'role' => 'karyawan'
        ]);
    }
}
