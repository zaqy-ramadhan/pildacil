<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Tps;
use App\Models\Dapil;
use App\Models\User;
use App\Models\Detail_suara;
use App\Models\Caleg;
use App\Models\Partai;
use Illuminate\Http\Request;

class TpsController extends Controller
{
    public function index()
    {
        $tps = Tps::with('dapil', 'users')->get();
        $suaras = Detail_suara::with('partai')->get();
        $dapils = Dapil::all();
        $calegs = Caleg::all()->first();
        $users = User::all();
        return view('tps-master', compact('tps', 'dapils', 'users', 'calegs', 'suaras'));
    }

    public function form()
    {
        $caleg = Caleg::all()->first();
        $partais = Partai::all();
        $tps = Tps::with('dapil', 'users')->where('id_user', Auth::user()->id)->first();
        $suaras = Detail_suara::with('partai')->where('id_tps', $tps->id)->get();
        return view('tps', compact('tps', 'partais', 'suaras', 'caleg'));
    }

    public function create()
    {
        return view('tps.create');
    }

    public function store(Request $request)
    {
        $tps = Tps::create($request->all());
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
        $tps->suara_caleg = $request->suara_caleg;
        $tps->save();
        $user = User::find(Auth::user()->id);
        $user->status = 1;
        $user->save();
        $partaiIDs = $request->input('id_partai');
        // dd($request->suara_partai);
        foreach ($partaiIDs as $key => $value) {
            Detail_suara::create([
                'id_tps' => $tps->id,
                'id_partai' => $value,
                'suara_partai' => $request->suara_partai[$key]
            ]);
        }
        return redirect()->route('tps.form')->with('success', 'Data TPS berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tps = Tps::find($id);
        $tps->delete();
        return redirect()->route('tps.index')->with('success', 'Data TPS berhasil dihapus.');
    }
}
