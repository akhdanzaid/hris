<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $departmentId = DB::table('departments')
            ->where('name', 'Top Managerial')
            ->value('id');

        $positionId = DB::table('positions')
            ->where('name', 'CEO')
            ->value('id');

        $statusId = DB::table('statuses')
            ->where('name', 'Tetap')
            ->value('id');

        if (!$departmentId || !$positionId || !$statusId) {
            throw new \Exception('Seeder gagal: data relasi belum tersedia.');
        }

        DB::table('karyawan')->insert([
            [
                'nik' => '20219001',
                'name' => 'Mahasigma',
                'gender' => 'Laki-laki',
                'birth_place' => 'Jakarta Timur',
                'birth_date' => '2000-02-28',
                'phone' => '085214321876',
                'email' => 'teamanggur@unsada.ac',

                'department_id' => $departmentId,
                'position_id'   => $positionId,
                'status_id'     => $statusId,

                'join_date' => '2019-01-01',

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
