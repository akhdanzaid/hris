<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

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

    public function resetPassword($id)
{
    $user = User::findOrFail($id);

    // OPTIONAL: cegah reset password HRD
    if ($user->role === 'hrd') {
        return back()->with('error', 'Password HRD tidak boleh di-reset');
    }

    $user->update([
        'password' => Hash::make('123456')
    ]);

    return back()->with('success', 'Password berhasil di-reset ke 123456');
}

}


