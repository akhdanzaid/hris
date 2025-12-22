<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index()
    {
        $gajis = [
            [
                'id' => 1,
                'nik' => '20191001',
                'nama' => 'Mahasigma',
                'gaji_pokok' => 10000000,
                'potongan' => 100000,
            ],
        ];

        return view('gaji.index', compact('gajis'));
    }

    public function create()
    {
        return view('gaji.create');
    }

    // ✅ TAMBAHKAN INI
    public function edit($id)
    {
        // data dummy sementara
        $gaji = [
            'id' => $id,
            'nik' => '20191001',
            'nama' => 'Tommy Satrio W.',
            'gaji_pokok' => 10000000,
        ];

        return view('gaji.edit', compact('gaji'));
    }

    // ✅ TAMBAHKAN INI JUGA (meski belum dipakai)
    public function update(Request $request, $id)
    {
        // nanti logic update ke database di sini
        return redirect()->route('gaji.index')
                         ->with('success', 'Data gaji berhasil diperbarui');
    }
}
