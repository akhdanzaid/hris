<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cuti;


class CutikController extends Controller
{
    public function index()
    {
        return view('cutik/create');
    }

    public function create()
    {
        return view('cutik.create');
    }

    public function store(Request $request)
    {
        $karyawan = Auth::user()->karyawan;

        if (!$karyawan) {
            abort(403, 'Akun tidak terhubung dengan data karyawan');
        }

        $request->validate([
            'alasan'           => 'required|string',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
            'berkas'           => 'nullable|file|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('berkas')) {
            $path = $request->file('berkas')->store('cuti', 'public');
        }

        Cuti::create([
            'karyawan_id'     => $karyawan->id,
            'alasan'          => $request->alasan,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'berkas'          => $path,
            'status'          => 'pending',
        ]);

        // 🔔 notif + redirect ke dashboard karyawan
        return redirect()
            ->route('dashboardk.index')
            ->with('success', 'Pengajuan cuti berhasil dikirim dan menunggu persetujuan HRD');
    }
}
