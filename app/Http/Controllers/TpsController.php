<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Tps;
use App\Models\Dapil;
use App\Models\User;
use Illuminate\Http\Request;

class TpsController extends Controller
{
    public function index()
    {
        $tps = Tps::with('dapil', 'users')->get();
        $dapils = Dapil::all();
        $users = User::all();
        return view('tps-master', compact('tps', 'dapils', 'users'));
    }

    public function form()
    {
        $tps = Tps::with('dapil', 'users')->where('id_user', Auth::user()->id)->first();
        return view('tps', compact('tps'));
    }

    public function create()
    {
        return view('tps.create');
    }

    public function store(Request $request)
    {
        // Validasi request di sini sesuai kebutuhan

        Tps::create($request->all());
        return redirect()->route('tps.index')->with('success', 'Data TPS berhasil ditambahkan.');
    }

    public function show($id)
    {
        $tps = Tps::find($id);
        return view('tps.show', compact('tps'));
    }

    public function edit($id)
    {
        $tps = Tps::find($id);
        return view('tps.edit', compact('tps'));
    }

    public function update(Request $request)
    {
        // Validasi request di sini sesuai kebutuhan

        $tps = Tps::find($request->id);
        $tps->update($request->all());
        return redirect()->route('tps.index')->with('success', 'Data TPS berhasil diperbarui.');
    }

    public function vote(Request $request)
    {
        $tps = Tps::find($request->id);
        $tps->update($request->all());
        $user = User::find(Auth::user()->id);
        $user->status = 1;
        $user->save();
        return redirect()->route('tps.form')->with('success', 'Data TPS berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tps = Tps::find($id);
        $tps->delete();
        return redirect()->route('tps.index')->with('success', 'Data TPS berhasil dihapus.');
    }
}
