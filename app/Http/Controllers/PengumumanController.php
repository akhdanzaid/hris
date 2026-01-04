<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
         $pengumuman = Pengumuman::when($search, function ($query) use ($search) {
        $query->where('jenis_pengumuman', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%")
              ->orWhere('kepada', 'like', "%{$search}%");
        })
        ->latest()
        ->get();
        return view('pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('pengumuman.create');
    }

    public function store(Request $request)
    {
       $request->validate([
        'jenis_pengumuman' => 'required|string|max:255',
        'deskripsi'        => 'required|string',
        'kepada'           => 'required|string',
        'tanggal'          => 'required|date',
    ]);

    Pengumuman::create([
        'jenis_pengumuman' => $request->jenis_pengumuman,
        'deskripsi'        => $request->deskripsi,
        'kepada'           => $request->kepada,
        'waktu'       => $request->tanggal,
    ]);

    return redirect()
        ->route('pengumuman.index')
        ->with('success', 'Pengumuman berhasil ditambahkan');
    }


}
