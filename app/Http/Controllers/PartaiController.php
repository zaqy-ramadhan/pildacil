<?php

namespace App\Http\Controllers;

use App\Models\Partai;
use App\Http\Requests\StorePartaiRequest;
use App\Http\Requests\UpdatePartaiRequest;
use Illuminate\Http\Request;

class PartaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partais = Partai::all();
        return view('partai', compact('partais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Partai::create($request->all());
        return redirect()->route('partai.index')->with('success', 'Data partai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partai $partai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partai $partai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partai $partai)
    {
        $partai = Partai::find($request->id);
        $partai->update($request->all());
        return redirect()->route('partai.index')->with('success', 'Data Partai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $partai = Partai::find($id);
        $partai->delete();
        return redirect()->route('partai')->with('success', 'Data partai berhasil dihapus.');
    }
}
