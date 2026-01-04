<?php

namespace App\Http\Controllers;
use App\Models\Pengumuman;

use Illuminate\Http\Request;

class PengumumankController extends Controller
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
        return view('pengumumank.index', compact('pengumuman'));
    }
}
