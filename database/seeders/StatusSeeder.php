<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('statuses')->insert([
            [
                'name' => 'Tetap',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kontrak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Magang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
