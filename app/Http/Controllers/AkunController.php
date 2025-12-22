<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function edit()
    {
        // DATA DUMMY
        $user = (object) [
            'username' => 'tommy',
            'email'    => 'tommy@unsada.ac',
            'role'     => 'karyawan',
        ];

        return view('akun.edit', compact('user'));
    }
    public function update(Request $request)
    {
        // Simulasi update (belum ke DB)
        // Biasanya di sini ada User::find()->update()

        return redirect()
            ->route('akun.edit')
            ->with('success', 'Data akun berhasil disimpan (dummy).');
    }
}