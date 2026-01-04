<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'name' => 'Top Managerial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Human Resource',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'IT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Finance',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
            'name' => 'Operational',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
            'name' => 'Production',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
