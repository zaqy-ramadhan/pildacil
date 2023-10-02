<?php

namespace App\Http\Controllers;

use App\Models\Dapil;
use Illuminate\Http\Request;

class DapilController extends Controller
{
    public function index()
    {
        $dapils = Dapil::all();
        return view('dapil', compact('dapils'));
    }

    public function create()
    {
        return view('dapil');
    }

    public function store(Request $request)
    {
        // Validasi request di sini sesuai kebutuhan

        Dapil::create($request->all());
        return redirect()->route('dapils.index')->with('success', 'Data Dapil berhasil ditambahkan.');
    }

    public function show($id)
    {
        $dapil = Dapil::find($id);
        return view('dapil', compact('dapil'));
    }

    public function edit($id)
    {
        $dapil = Dapil::find($id);
        return view('dapil', compact('dapil'));
    }

    public function update(Request $request)
    {
        // Validasi request di sini sesuai kebutuhan

        $dapil = Dapil::find($request->id);
        $dapil->update($request->all());
        return redirect()->route('dapils.index')->with('success', 'Data Dapil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dapil = Dapil::find($id);
        $dapil->delete();
        return redirect()->route('dapil')->with('success', 'Data Dapil berhasil dihapus.');
    }
}
