<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // ⬅️ WAJIB

class AkunController extends Controller
{
    public function edit()
    {
         $user = Auth::user();

    // 🔥 PILIH VIEW BERDASARKAN ROLE
    if ($user->role === 'hrd') {
        return view('akun.edit', [
            'user' => $user
        ]);
    }

    return view('akunk.edit', [
        'user' => $user
    ]);
    }

public function update(Request $request)
{
    $request->validate(
        [
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed',
        ],
        [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]
    );

    $user = User::findOrFail(Auth::id());

    $data = [
        'email' => $request->email,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    // 🔥 LOGIKA REDIRECT BERDASARKAN ROLE
    if ($user->role === 'hrd') {
        return redirect()
            ->route('dashboard.index')
            ->with('success', 'Akun berhasil diperbarui');
    }

    return redirect()
        ->route('dashboardk.index')
        ->with('success', 'Akun berhasil diperbarui');
}

}