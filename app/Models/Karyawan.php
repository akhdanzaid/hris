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
            'department_id', 
            'position_id',
            'join_date', 
            'status_id'
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
    }
