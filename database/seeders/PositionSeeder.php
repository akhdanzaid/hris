<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('positions')->insert([
            [
                'name' => 'CEO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HRD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Software Engineer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Staff Keuangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Staff Operasional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Staff Produksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
