<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // sementara pakai view langsung (data dummy di Blade)
        return view('laporan.index');
    }

    public function show($id)
    {
        // nanti bisa dipakai untuk detail absensi per karyawan
        return view('laporan.detail');
    }
}
