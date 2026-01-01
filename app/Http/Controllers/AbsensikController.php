<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsensikController extends Controller
{
    public function index()
    {
        return view('absensik.index');
    }

    public function store(Request $request)
    {
        // logic simpan absensi
        return redirect()->back()
            ->with('success', 'Absensi berhasil');
    }

    public function history()
    {
        return view('absensik.history');
    }
}
