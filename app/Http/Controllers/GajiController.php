<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Gaji;

class GajiController extends Controller
{
    // fungsi view index
    public function index(Request $request)
    {
        $query = Gaji::with('karyawan');

        if ($request->filled('search')) {
            $query->whereHas('karyawan', function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('nik', 'like', '%'.$request->search.'%');
            });
        }

        $gajis = $query->orderBy('id', 'asc')->get();

        return view('gaji.index', compact('gajis'));
    }

    // fungsi tambah
    public function create(Request $request)
    {
        $karyawan = null;

        if ($request->filled('nik')) {
            $karyawan = Karyawan::where('nik', $request->nik)->first();
        }

        return view('gaji.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'        => 'required|exists:karyawan,nik',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        $karyawan = Karyawan::where('nik', $request->nik)->firstOrFail();

        $totalPotongan = 0;

        Gaji::create([
            'karyawan_id'    => $karyawan->id,
            'gaji_pokok'     => $request->gaji_pokok,
            'total_potongan' => $totalPotongan,
            'total_gaji'     => $request->gaji_pokok - $totalPotongan,
            'periode'        => now()->format('Y-m'),
        ]);

        return redirect()
            ->route('gaji.index')
            ->with('success', 'Data gaji berhasil ditambahkan');
    }


    // fungsi edit
    public function edit($id)
    {
        $gaji = Gaji::with('karyawan')->findOrFail($id);

        return view('gaji.edit', compact('gaji'));
    }

    // fungsi update
    public function update(Request $request, $id)
    {
        $request->validate([
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        $gaji = Gaji::findOrFail($id);

        // sementara potongan = 0 (nanti dari absensi)
        $totalPotongan = 0;

        $gaji->update([
            'gaji_pokok'     => $request->gaji_pokok,
            'total_potongan' => $totalPotongan,
            'total_gaji'     => $request->gaji_pokok - $totalPotongan,
        ]);

        return redirect()
            ->route('gaji.index')
            ->with('success', 'Data gaji berhasil diperbarui');
}

}
