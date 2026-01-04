<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;
use App\Models\Karyawan;
use App\Models\Cuti;

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

        return view('dashboard.index', compact(
            'todos',
            'currentTask',
            'totalKaryawan',
            'pendingCuti'
        ));
    }

    // dashboard karyawan
    public function indexk()
    {
        $user = Auth::user();
        $karyawan = $user->karyawan;

        $riwayatCuti = collect();

        if ($karyawan) {
            $riwayatCuti = Cuti::where('karyawan_id', $karyawan->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('dashboardk.index', compact('riwayatCuti'));
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

    public function destroy($id)
    {
        Todo::findOrFail($id)->delete();

        return redirect()->route('dashboard.index')
            ->with('success', 'Todo berhasil dihapus');
    }

    public function toggle($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->is_done = !$todo->is_done;
        $todo->save();

        return redirect()->route('dashboard.index');
    }
}
