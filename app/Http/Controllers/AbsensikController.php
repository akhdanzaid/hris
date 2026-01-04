<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiSession;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AbsensikController extends Controller
{
    public function index()
    {
        // Ambil sesi aktif hari ini (hadir / pulang)
        $session = AbsensiSession::whereDate('tanggal', today())
            ->where('is_active', true)
            ->first();

        if (!$session) {
            return view('absensik.closed');
        }

        return view('absensik.index', [
            'session' => $session
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required|exists:absensi_sessions,token',
        ]);

        $user = Auth::user();

        // Ambil sesi aktif
        $session = AbsensiSession::where('token', $request->token)
            ->where('is_active', true)
            ->first();

        if (!$session) {
            return back()->with('error', 'Sesi absensi tidak valid atau sudah ditutup.');
        }

        $now = now();

        // Validasi jam sesi
        if (
            $now->lt(Carbon::createFromTimeString($session->jam_mulai)) ||
            $now->gt(Carbon::createFromTimeString($session->jam_selesai))
        ) {
            return back()->with('error', 'Absensi di luar jam yang ditentukan.');
        }

        $tanggal = today();

        $absensi = Absensi::where('karyawan_id', $user->karyawan_id)
            ->where('tanggal', $tanggal)
            ->first();

        /**
         * ======================
         * HADIR
         * ======================
         */
        if ($session->tipe === 'hadir') {

            if ($absensi) {
                return back()->with('error', 'Anda sudah absen hari ini.');
            }

            $status = $now->gt(
                Carbon::createFromTimeString($session->jam_selesai)
            ) ? 'telat' : 'hadir';

            Absensi::create([
                'karyawan_id' => $user->karyawan_id,
                'tanggal'     => $tanggal,
                'jam_masuk'   => $now->format('H:i:s'),
                'status'      => $status,
                'metode'      => 'barcode',
            ]);

            return back()->with('success', 'Absensi hadir berhasil.');
        }

        /**
         * ======================
         * PULANG
         * ======================
         */
        if ($session->tipe === 'pulang') {

            if (!$absensi) {
                return back()->with('error', 'Anda belum absen hadir.');
            }

            if ($absensi->jam_pulang) {
                return back()->with('error', 'Anda sudah absen pulang.');
            }

            $absensi->update([
                'jam_pulang' => $now->format('H:i:s'),
            ]);

            return back()->with('success', 'Absensi pulang berhasil.');
        }
    }
}
