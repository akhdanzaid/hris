<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        return view('pengumuman.index');
    }

    public function create()
    {
        return view('pengumuman.create');
    }

    public function store(Request $request)
    {
        // logic simpan (nanti)
        return redirect()->route('pengumuman.index');
    }

    public function show($id)
    {
        return view('pengumuman.show');
    }
}
