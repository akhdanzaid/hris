<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login/login');
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // FLAG UNTUK ANIMASI WELCOME
            session()->flash('just_logged_in', true);

            $user = Auth::user();

            // REDIRECT BERDASARKAN ROLE
            if ($user->role === 'hrd') {
                return redirect()->route('dashboard.index');
            }

            return redirect()->route('dashboardk.index');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
