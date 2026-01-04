<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Department;
use App\Models\Position;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::with(['department', 'position', 'status']);

        // Fitur search (nama atau NIK)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Pagination akan menampilkan 10 data per halaman
        $karyawan = $query
            ->orderBy('id', 'asc')
            ->paginate(10);
            // ->withQueryString(); // agar search tetap aktif saat pindah halaman

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

    // fungsi insert dan auto generate user
public function store(Request $request)
{
    $request->validate([
        'nik'           => 'required|unique:karyawan,nik',
        'name'          => 'required|string',
        'gender'        => 'required|in:L,P',
        'birth_place'   => 'required|string',
        'birth_date'    => 'required|date',
        'phone'         => 'required',
        'email'         => 'required|email|unique:karyawan,email|unique:users,email',
        'department_id' => 'required|exists:departments,id',
        'position_id'   => 'required|exists:positions,id',
        'status_id'     => 'required|exists:statuses,id',
        'join_date'     => 'required|date',
        'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp',
    ]);

    DB::beginTransaction();

    try {
        // SIMPAN FOTO (JIKA ADA)
        $imageName = null;
        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('images/karyawan'), $imageName);
        }

        // SIMPAN KARYAWAN
        $karyawan = Karyawan::create([
            'nik'           => $request->nik,
            'name'          => $request->name,
            'gender'        => $request->gender,
            'birth_place'   => $request->birth_place,
            'birth_date'    => $request->birth_date,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'department_id' => $request->department_id,
            'position_id'   => $request->position_id,
            'status_id'     => $request->status_id,
            'join_date'     => $request->join_date,
            'photo'         => $imageName,
        ]);

        // BUAT USER
        $namaDepan = Str::of($karyawan->name)->explode(' ')->first();
        $username  = strtolower($namaDepan).$karyawan->id;

        User::create([
            'username'     => $username,
            'email'        => $karyawan->email,
            'password'     => Hash::make('123456'),
            'role'         => 'karyawan',
            'karyawan_id'  => $karyawan->id,
        ]);

        DB::commit();

        return redirect()
            ->route('employee.index')
            ->with('success', 'Karyawan berhasil ditambahkan.');

    } catch (\Throwable $e) {
        DB::rollBack();

        return back()
            ->withInput()
            ->with('error', 'Gagal menyimpan data: '.$e->getMessage());
    }
}


    // fungsi detail
    public function detail($id)
    {
        $karyawan = Karyawan::with([
            'department',
            'position',
            'status',
            'gajis' => function ($q) {
                $q->orderBy('periode', 'desc');
            }
        ])->findOrFail($id);

        $departments = Department::all();
        $positions   = Position::all();
        $statuses    = Status::all();

        // ambil gaji TERBARU (opsional)
        $gajiTerakhir = $karyawan->gajis->first();

        return view('employee.detail', compact(
            'karyawan',
            'departments',
            'positions',
            'statuses',
            'gajiTerakhir'
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
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $karyawan = Karyawan::findOrFail($id);

        // update data utama
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

        // update foto
        if ($request->hasFile('photo')) {
            if ($karyawan->photo && file_exists(public_path('images/karyawan/'.$karyawan->photo))) {
                unlink(public_path('images/karyawan/'.$karyawan->photo));
            }

            $imageName = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('images/karyawan'), $imageName);

            $karyawan->photo = $imageName;
            $karyawan->save();
        }

        return redirect()
            ->route('employee.index')
            ->with('success', 'Data karyawan berhasil diperbarui');
    }

    // fungsi delete
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        // Hapus file foto jika ada
        if ($karyawan->photo && file_exists(public_path('images/karyawan/' . $karyawan->photo))) {
            unlink(public_path('images/karyawan/' . $karyawan->photo));
        }

        // Hapus data karyawan
        $karyawan->delete();

        return redirect()
            ->route('employee.index')
            ->with('success', 'Data karyawan berhasil dihapus');
    }

}

