<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Karyawan extends Model
    {
        protected $table = 'karyawan';

        protected $fillable = [
            'nik',
            'name',
            'gender',
            'birth_place',
            'birth_date',
            'phone',
            'email',
            'photo',
            'department_id',
            'position_id',
            'status_id',
            'join_date'
        ];


        public function department()
        {
            return $this->belongsTo(Department::class);
        }

        public function position()
        {
            return $this->belongsTo(Position::class);
        }

        public function status()
        {
            return $this->belongsTo(Status::class);
        }

        public function gajis()
        {
            return $this->hasMany(Gaji::class);
        }

        public function cuti()
        {
            return $this->hasMany(Cuti::class);
        }

        public function user()
        {
            return $this->hasOne(User::class);
        }

        public function absensis()
        {
            return $this->hasMany(Absensi::class);
        }


    }
