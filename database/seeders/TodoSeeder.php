<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodoSeeder extends Seeder
{
    public function run(): void
    {

        Todo::insert([
            [
                'title' => 'Training Office Worker',
                'due_date' => '2025-12-16',
                'is_done' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Approval Payroll',
                'due_date' => '2025-12-16',
                'is_done' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Wawancara Calon Karyawan Baru',
                'due_date' => '2025-12-18',
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Print out Laporan',
                'due_date' => '2025-12-22',
                'is_done' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
