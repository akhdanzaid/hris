<?php

namespace App\Http\Controllers;

use App\Models\User;

class DatauserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('datauser.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'hrd') {
            return back()->with('error', 'User HRD tidak boleh dihapus');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus');
    }
}


