<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $pilihtps = $request->input('pilihtps');
        $pilihdapil = $request->input('pilihdapil');
        $listtps = DB::table('tps')->where('suara_caleg', '!=', null)->get();
        $listdapil = DB::table('dapils')->get();
        // dd($listdapil);
        $tps = DB::table('tps')->select('nama_tps', 'suara_caleg')->get();
        $dapil = DB::table('tps')->select('tps.id_dapil', DB::raw('SUM(tps.suara_caleg) as total_suara_caleg'), 'dapils.nama_dapil')->groupBy('tps.id_dapil', 'dapils.nama_dapil')->join('dapils', 'tps.id_dapil', '=', 'dapils.id')->get();
        // $partaitps = DB::table('detail_suaras')->select('detail_suaras.id_partai', DB::raw('SUM(detail_suaras.suara_partai) as total_suara_caleg'), 'partais.nama')->groupBy('detail_suaras.id_partai', 'partais.nama')->join('partais', 'detail_suaras.id_partai', '=', 'partais.id')->get();

        // dd($listdapil[0]);
        // tps
        if($pilihtps != null){
            $idtpspilihan = $pilihtps;
        }else{
            if(!empty($listtps) && isset($listtps[0]->id)){
                $idtpspilihan = $listtps[0]->id;
            }else{
                $idtpspilihan = 0;
            }
        }

        if($pilihdapil != null){
            $iddapilpilihan = $pilihdapil;
        }else{
            if(!empty($iddapilpilihan) && isset($iddapilpilihan[0]->id)){
                $iddapilpilihan = $listdapil[0]->id;
            }else{
                $iddapilpilihan = 0;
            }
        }
        $partaitps = DB::table('detail_suaras')->select('detail_suaras.id_partai', 'detail_suaras.suara_partai', 'partais.nama', 'tps.nama_tps')->join('partais', 'detail_suaras.id_partai', '=', 'partais.id')->join('tps', 'detail_suaras.id_tps', '=', 'tps.id')->where('id_tps', $idtpspilihan)->get();
        $partaidapil = DB::table('dapils')->select('dapils.nama_dapil', 'partais.nama', DB::raw('SUM(detail_suaras.suara_partai) as total_suara_partai'))->join('tps', 'dapils.id', '=', 'tps.id_dapil')->join('detail_suaras', 'tps.id', '=', 'detail_suaras.id_tps')->join('partais', 'detail_suaras.id_partai', '=', 'partais.id')->where('dapils.id', $iddapilpilihan)->groupBy('detail_suaras.id_partai')->get();

        $tampilnamatps = DB::table('tps')->where('suara_caleg', '!=', null)->where('id', $idtpspilihan)->first();
        $tampilnamadapil = DB::table('dapils')->where('id', $iddapilpilihan)->first();
        // dd($partaitps[0]->nama_tps);
        $labelspertps = [];
        $datapertps = [];
        $labelsperdapil = [];
        $dataperdapil = [];
        $labelspartaipertps = [];
        $datapartaipertps = [];
        $labelspartaiperdapil = [];
        $datapartaiperdapil = [];

        foreach ($tps as $tpsdata) {
            $labelspertps[] = $tpsdata->nama_tps;
            $datapertps[] = $tpsdata->suara_caleg;
        }

        foreach ($dapil as $dapildata) {
            $labelsperdapil[] = $dapildata->nama_dapil;
            $dataperdapil[] = $dapildata->total_suara_caleg;
        }
        foreach ($partaitps as $partaitpsdata) {
            $labelspartaipertps[] = $partaitpsdata->nama;
            $datapartaipertps[] = $partaitpsdata->suara_partai;
        }

        foreach ($partaidapil as $partaidapildata) {
            $labelspartaiperdapil[] = $partaidapildata->nama;
            $datapartaiperdapil[] = $partaidapildata->total_suara_partai;
        }


        return view('home', [
            'listtps' => $listtps,
            'listdapil' => $listdapil,
            'tampilnamatps' => $tampilnamatps,
            'tampilnamadapil' => $tampilnamadapil,
            'labelspertps' => array_values($labelspertps),
            'datapertps' => array_values($datapertps),
            'labelsperdapil' => array_values($labelsperdapil),
            'dataperdapil' => array_values($dataperdapil),
            'labelspartaipertps' => array_values($labelspartaipertps),
            'datapartaipertps' => array_values($datapartaipertps),
            'labelspartaiperdapil' => array_values($labelspartaiperdapil),
            'datapartaiperdapil' => array_values($datapartaiperdapil)
        ]);
    }
}
