<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = Cuti::with('karyawan')
            ->orderByRaw("
                CASE
                    WHEN status = 'pending' THEN 1
                    WHEN status = 'approved' THEN 2
                    WHEN status = 'rejected' THEN 3
                END
            ")
            ->orderBy('created_at', 'asc')
            ->get();

        $pending  = Cuti::where('status', 'pending')->count();
        $approved = Cuti::where('status', 'approved')->count();
        $rejected = Cuti::where('status', 'rejected')->count();

        return view('cuti.index', compact(
            'cuti',
            'pending',
            'approved',
            'rejected'
        ));
    }

    // fungsi tambah
    public function create()
    {
        return view('cuti.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id'     => 'required|exists:karyawan,id',
            'alasan'          => 'required',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'berkas'          => 'nullable|file',
        ]);

        $path = null;
        if ($request->hasFile('berkas')) {
            $path = $request->file('berkas')->store('cuti', 'public');
        }

        Cuti::create([
            'karyawan_id'     => $request->karyawan_id,
            'alasan'          => $request->alasan,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'berkas'          => $path,
            'status'          => 'pending',
        ]);

        return redirect()
            ->route('cuti.index')
            ->with('success', 'Pengajuan cuti berhasil dikirim');
    }


    // fungsi approve dan reject pengajuan cuti
    public function show($id)
    {
        $cuti = Cuti::with('karyawan')->findOrFail($id);

        return view('cuti.detail', compact('cuti'));
    }

    public function approve($id)
    {
        $cuti = Cuti::findOrFail($id);

        if ($cuti->status !== 'pending') {
            return back()->with('error', 'Pengajuan sudah diproses');
        }

        $cuti->update([
            'status' => 'approved'
        ]);

        return redirect()
            ->route('cuti.index')
            ->with('success', 'Pengajuan cuti disetujui');
    }

    public function reject($id)
    {
        $cuti = Cuti::findOrFail($id);

        if ($cuti->status !== 'pending') {
            return back()->with('error', 'Pengajuan sudah diproses');
        }

        $cuti->update([
            'status' => 'rejected'
        ]);

        return redirect()
            ->route('cuti.index')
            ->with('success', 'Pengajuan cuti ditolak');
    }


}

