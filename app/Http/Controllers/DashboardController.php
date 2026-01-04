<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;
use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Gaji;


class DashboardController extends Controller
{
    public function index()
    {
        // Todo list
        $todos = Todo::orderBy('is_done')
            ->orderBy('due_date')
            ->get();

        // Current task = todo yang belum selesai
        $currentTask = Todo::where('is_done', false)->count();

        // Jumlah karyawan
        $totalKaryawan = Karyawan::count();

        // Pengajuan cuti yang MASIH pending
        $pendingCuti = Cuti::where('status', 'pending')->count();

        // Total karyawan yang hadir hari ini
        $totalHadir = Absensi::whereDate('tanggal', today())
        ->whereNotNull('jam_masuk')
        ->count();

        return view('dashboard.index', compact(
            'todos',
            'currentTask',
            'totalKaryawan',
            'pendingCuti',
            'totalHadir'
        ));
    }

    // dashboard karyawan
    public function indexk()
    {
        $user = Auth::user();
        $karyawan = $user->karyawan;

        $riwayatCuti = collect();
        $gajiTerakhir = null;

        if ($karyawan) {

            // Riwayat cuti karyawan
            $riwayatCuti = Cuti::where('karyawan_id', $karyawan->id)
                ->orderBy('created_at', 'desc')
                ->get();

            // Gaji terakhir karyawan
            $gajiTerakhir = Gaji::where('karyawan_id', $karyawan->id)
                ->orderBy('created_at', 'desc')
                ->first();
        }

        return view('dashboardk.index', compact(
            'riwayatCuti',
            'gajiTerakhir'
        ));
    }

    public function storeTodo(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);

        Todo::create([
            'title' => $request->title,
            'due_date' => $request->due_date,
            'is_done' => false,
        ]);

        return redirect()->route('dashboard.index')
            ->with('success', 'Todo berhasil ditambahkan');
    }

    public function destroyTodo($id)
    {
        Todo::findOrFail($id)->delete();

        return redirect()->route('dashboard.index')
            ->with('success', 'Todo berhasil dihapus');
    }

    public function toggleTodo($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->is_done = !$todo->is_done;
        $todo->save();

        return redirect()->route('dashboard.index');
    }
}
