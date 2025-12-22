<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Department;
use App\Models\Position;
use App\Models\Status;


class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::with(['department', 'position', 'status'])
            ->orderBy('name')
            ->get();

        return view('employee.index', compact('karyawan'));
    }

    // fungsi tambah
    public function create()
    {
        $departments = Department::all();
        $positions   = Position::all();
        $statuses    = Status::all();

        return view('employee.create', compact(
            'departments',
            'positions',
            'statuses'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik'           => 'required|unique:karyawan,nik',
            'name'          => 'required|string',
            'gender'        => 'required',
            'birth_place'   => 'required|string',
            'birth_date'    => 'required|date',
            'phone'         => 'required',
            'email'         => 'nullable|email',

            'department_id' => 'required|exists:departments,id',
            'position_id'   => 'required|exists:positions,id',
            'status_id'     => 'required|exists:statuses,id',
            'join_date'     => 'required|date',
        ]);

        Karyawan::create($validated);

        return redirect()
            ->route('employee.index')
            ->with('success', 'Data karyawan berhasil ditambahkan');
    }

    // fungsi detail
    public function detail($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $departments = Department::all();
        $positions   = Position::all();
        $statuses    = Status::all();

        return view('employee.detail', compact(
            'karyawan',
            'departments',
            'positions',
            'statuses'
        ));
    }

    // fungsi update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'birth_place'   => 'required|string|max:255',
            'birth_date'    => 'required|date',
            'gender'        => 'required|in:L,P',
            'phone'         => 'required|string|max:20',
            'email'         => 'required|email',
            'department_id' => 'required|exists:departments,id',
            'position_id'   => 'required|exists:positions,id',
            'status_id'     => 'required|exists:statuses,id',
            'join_date'     => 'required|date',
        ]);

        $karyawan = Karyawan::findOrFail($id);

        $karyawan->update([
            'name'          => $request->name,
            'birth_place'   => $request->birth_place,
            'birth_date'    => $request->birth_date,
            'gender'        => $request->gender,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'department_id' => $request->department_id,
            'position_id'   => $request->position_id,
            'status_id'     => $request->status_id,
            'join_date'     => $request->join_date,
        ]);

        return redirect()
            ->route('employee.detail', $id)
            ->with('success', 'Data karyawan berhasil diperbarui');
    }
}

