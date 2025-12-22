<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Department; 
use App\Models\Position;   

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'nik', 'department_id', 'position_id', 'status'
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function position() {
        return $this->belongsTo(Position::class);
    }

        public function detail($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.detail', compact('employee'));
    }
}
