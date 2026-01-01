<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // logic simpan cuti karyawan
        return redirect()->route('cutik.index')
            ->with('success', 'Cuti berhasil diajukan');
    }

    // public function show($id)
    // {
    //     return view('cutik.detail', compact('id'));
    // }
}
