<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiSession;
use App\Models\Karyawan;
use App\Models\Cuti;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $tipe = $request->get('tipe', 'hadir');

        if (!in_array($tipe, ['hadir', 'pulang'])) {
            $tipe = 'hadir';
        }

        $session = AbsensiSession::whereDate('tanggal', today())
            ->where('tipe', $tipe)
            ->first();

        $karyawan = Karyawan::orderBy('name')->get();

        $absensiHariIni = Absensi::whereDate('tanggal', today())
            ->get()
            ->keyBy('karyawan_id');

        return view('absensi.index', compact(
            'tipe',
            'session',
            'karyawan',
            'absensiHariIni'
        ));
    }

    // BUKA SESI
    public function startSession(Request $request)
    {
        $request->validate([
            'tipe'       => 'required|in:hadir,pulang',
            'jam_mulai'  => 'required',
            'jam_selesai'=> 'required',
        ]);

        AbsensiSession::updateOrCreate(
            [
                'tanggal' => today(),
                'tipe'    => $request->tipe,
            ],
            [
                'jam_mulai'   => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'is_active'   => true,
            ]
        );

        return redirect()
            ->back()
            ->with('success', 'Sesi absensi berhasil dibuka.');
    }

    // TUTUP SESI
    public function closeSession($id)
    {
        AbsensiSession::where('id', $id)->update([
            'is_active' => false
        ]);

        return redirect()
            ->back()
            ->with('success', 'Sesi absensi berhasil ditutup.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'tipe'        => 'required|in:hadir,pulang',
            'token'       => 'required|exists:absensi_sessions,token',
            'metode'      => 'required|in:barcode,manual',
        ]);

        $tanggal = today();

        // TOKEN
        $session = AbsensiSession::where('token', $request->token)
            ->where('tipe', $request->tipe)
            ->where('is_active', true)
            ->first();

        if (!$session) {
            return back()->with('error', 'Sesi absensi tidak aktif atau tidak valid.');
        }

        // VALIDASI
        $now = now();

        $absensi = Absensi::where('karyawan_id', $request->karyawan_id)
            ->where('tanggal', $tanggal)
            ->first();

        // HADIR
        if ($request->tipe === 'hadir') {

            if ($absensi) {
                return back()->with('error', 'Karyawan sudah absen hari ini.');
            }

            $jamSelesai = Carbon::today()
                ->setTimeFromTimeString($session->jam_selesai);

            $status = $now->greaterThan($jamSelesai)
                ? 'telat'
                : 'hadir';

            Absensi::create([
                'karyawan_id' => $request->karyawan_id,
                'tanggal'     => $tanggal,
                'jam_masuk'   => $now->format('H:i:s'),
                'status'      => $status,
                'metode'      => $request->metode, // manual / barcode
            ]);

            return back()->with('success', 'Absensi hadir berhasil.');
        }

        // PULANG
        if ($request->tipe === 'pulang') {

            if (!$absensi) {
                return back()->with('error', 'Belum melakukan absensi hadir.');
            }

            if ($absensi->jam_pulang) {
                return back()->with('error', 'Karyawan sudah absen pulang.');
            }

            $absensi->update([
                'jam_pulang' => $now->format('H:i:s'),
            ]);

            return back()->with('success', 'Absensi pulang berhasil.');
        }
    }


    public function barcode($tipe)
    {
        // Validasi tipe
        if (!in_array($tipe, ['hadir', 'pulang'])) {
            abort(404);
        }

        // Ambil sesi absensi AKTIF berdasarkan tipe & tanggal
        $session = AbsensiSession::whereDate('tanggal', today())
            ->where('tipe', $tipe)
            ->where('is_active', true)
            ->first();

        // Jika sesi belum dibuka HRD
        if (!$session) {
            return redirect()
                ->route('absensi.index')
                ->with('error', 'Sesi absensi belum dibuka oleh HRD.');
        }

        // Untuk HRD (manual override)
        $karyawan = Karyawan::orderBy('name')->get();

        // INI KUNCI UTAMANYA ⬇️
        return view('absensi.barcode', [
            'session'  => $session,
            'karyawan' => $karyawan,
        ]);
    }

}
