<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee; 
use App\Models\Department;
use App\Models\Position;


class KaryawanController extends Controller
{
public function index(Request $request)
{
    $query = Employee::query()->with(['department', 'position']);

    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('nik')) {
        $query->where('nik', 'like', '%' . $request->nik . '%');
    }

    if ($request->filled('department_id')) {
        $query->where('department_id', $request->department_id);
    }

    if ($request->filled('position_id')) {
        $query->where('position_id', $request->position_id);
    }

    $employees = $query->paginate(10);

    $departments = Department::all();
    $positions = Position::all();

    return view('employee.index', compact('employees', 'departments', 'positions'));
}

public function create()
{
    // Ambil data departemen dan posisi dari database
    $departments = Department::all();
    $positions = Position::all();

    // Tampilkan view form tambah karyawan
    return view('employee.create', compact('departments', 'positions'));
}

public function detail($id)
{
    // sementara pakai data dummy
    return view('employee.detail', [
        'employeeId' => $id
    ]);
}


}

