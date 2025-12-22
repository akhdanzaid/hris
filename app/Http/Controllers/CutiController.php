<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index()
    {
        return view('cuti.index');
    }

    public function show($id)
    {
        return view('cuti.detail');
    }
}
