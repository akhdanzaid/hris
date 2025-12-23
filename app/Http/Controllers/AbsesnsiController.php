<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiSession;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AbsensiController extends Controller
{
    /**
     * Proses absensi hadir / pulang
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'tipe'        => 'required|in:hadir,pulang',
            'metode'      => 'nullable|in:barcode,manual',
        ]);

        $tanggal = Carbon::today();

        // 1. Cek sesi absensi aktif
        $session = AbsensiSession::where('tanggal', $tanggal)
            ->where('tipe', $request->tipe)
            ->where('is_active', true)
            ->first();

        if (!$session) {
            return back()->with('error', 'Sesi absensi tidak aktif.');
        }

        // 2. Ambil absensi hari ini (jika ada)
        $absensi = Absensi::where('karyawan_id', $request->karyawan_id)
            ->where('tanggal', $tanggal)
            ->first();

        // ======================
        // HADIR
        // ======================
        if ($request->tipe === 'hadir') {

            if ($absensi) {
                return back()->with('error', 'Anda sudah melakukan absensi hari ini.');
            }

            Absensi::create([
                'karyawan_id' => $request->karyawan_id,
                'tanggal'     => $tanggal,
                'jam_masuk'   => now(),
                'status'      => 'hadir',
                'metode'      => $request->metode ?? 'barcode',
            ]);

            return back()->with('success', 'Absensi hadir berhasil.');
        }

        // ======================
        // PULANG
        // ======================
        if ($request->tipe === 'pulang') {

            if (!$absensi) {
                return back()->with('error', 'Belum melakukan absensi hadir.');
            }

            if ($absensi->jam_pulang) {
                return back()->with('error', 'Absensi pulang sudah dilakukan.');
            }

            $absensi->update([
                'jam_pulang' => now(),
            ]);

            return back()->with('success', 'Absensi pulang berhasil.');
        }
    }
}
