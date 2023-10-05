<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Http\Requests\StoreCalegRequest;
use App\Http\Requests\UpdateCalegRequest;
use Illuminate\Http\Request;

class CalegController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calegs = Caleg::all();
        return view('caleg', compact('calegs'));
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
        Caleg::create($request->all());
        return redirect()->route('caleg.index')->with('success', 'Data caleg berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Caleg $caleg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Caleg $caleg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Caleg $caleg)
    {
        $caleg = Caleg::find($request->id);
        $caleg->update($request->all());
        return redirect()->route('caleg.index')->with('success', 'Data Caleg berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $caleg = Caleg::find($id);
        $caleg->delete();
        return redirect()->route('caleg')->with('success', 'Data Caleg berhasil dihapus.');
    }
}
