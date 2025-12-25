<?php

namespace App\Http\Controllers;

use App\Models\User;

class datauserController extends Controller
{
    // TAMPIL DATA USER
    public function index()
    {
        $users = User::all();
        return view('datauser/datauser', compact('users'));
    }

    // DELETE USER
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Optional: cegah hapus HRD
        if ($user->role === 'hrd') {
            return back()->with('error', 'User HRD tidak boleh dihapus');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }
}
