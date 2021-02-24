<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AktivasiController extends Controller
{
    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
    }
}
