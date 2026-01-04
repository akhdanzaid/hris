<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil status
        $statusId = DB::table('statuses')
            ->where('name', 'Tetap')
            ->value('id');

        // Ambil department
        $deptHR   = DB::table('departments')->where('name', 'Human Resource')->value('id');
        $deptIT   = DB::table('departments')->where('name', 'IT')->value('id');
        $deptFin  = DB::table('departments')->where('name', 'Finance')->value('id');
        $deptOps  = DB::table('departments')->where('name', 'Operational')->value('id');

        // Ambil position
        $posHRD   = DB::table('positions')->where('name', 'HRD')->value('id');
        $posIT    = DB::table('positions')->where('name', 'Software Engineer')->value('id');
        $posFin   = DB::table('positions')->where('name', 'Staff Keuangan')->value('id');
        $posOps   = DB::table('positions')->where('name', 'Staff Operasional')->value('id');

        if (
            !$statusId ||
            !$deptHR || !$deptIT || !$deptFin || !$deptOps ||
            !$posHRD || !$posIT || !$posFin || !$posOps
        ) {
            throw new \Exception('Seeder gagal: data master belum lengkap.');
        }

        DB::table('karyawan')->insert([
            // HRD
            [
                'nik' => '20219001',
                'name' => 'Mahasigma',
                'gender' => 'Laki-laki',
                'birth_place' => 'Jakarta Timur',
                'birth_date' => '2000-01-01',
                'phone' => '085214321876',
                'email' => 'hrd@company.test',
                'photo' => null,

                'department_id' => $deptHR,
                'position_id'   => $posHRD,
                'status_id'     => $statusId,
                'join_date'     => '2019-01-01',

                'created_at' => now(),
                'updated_at' => now(),
            ],

            // IT
            [
                'nik' => '20219002',
                'name' => 'Ihsan Anafi Putra',
                'gender' => 'Laki-laki',
                'birth_place' => 'Bekasi',
                'birth_date' => '2005-01-01',
                'phone' => '081298765432',
                'email' => 'ihsan@gmail.com',
                'photo' => null,

                'department_id' => $deptIT,
                'position_id'   => $posIT,
                'status_id'     => $statusId,
                'join_date'     => '2020-03-12',

                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Finance
            [
                'nik' => '20219003',
                'name' => 'Iqbal Khairy',
                'gender' => 'Laki-laki',
                'birth_place' => 'Jakarta Timur',
                'birth_date' => '2004-01-01',
                'phone' => '082112223333',
                'email' => 'iqbal@gmail.com',
                'photo' => null,

                'department_id' => $deptFin,
                'position_id'   => $posFin,
                'status_id'     => $statusId,
                'join_date'     => '2021-07-01',

                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Operational
            [
                'nik' => '20219004',
                'name' => 'Riszki Fadillah',
                'gender' => 'Laki-laki',
                'birth_place' => 'Jakarta Utara',
                'birth_date' => '2004-01-01',
                'phone' => '083344556677',
                'email' => 'qiszki@gmail.com',
                'photo' => null,

                'department_id' => $deptOps,
                'position_id'   => $posOps,
                'status_id'     => $statusId,
                'join_date'     => '2018-10-15',

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
