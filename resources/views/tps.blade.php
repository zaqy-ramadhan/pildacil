@extends('layouts.admin_layout')

@section('content')

<div class="container-fluid p-4">
    <div class="card mb-3 mt-5">
        <div class="card-header">
            <h3><i class="fa fa-check-square-o"></i> TPS Form</h3>
        </div>
            
        <div class="card-body">
            @if($tps != null)
            <form action="{{ route('tps.vote') }}" method="post">
              @csrf
              <input type="text" name="id" value="{{ $tps->id }}" class="form-control" hidden>
              <div class="form-group">
                <label>Nama TPS</label>
                <input type="text" value="{{ $tps->nama_tps }}" class="form-control" disabled>
              </div>

              <div class="form-group">
                <label>Dapil</label>
                <input type="text" value="{{ $tps->dapil->nama_dapil }}" class="form-control" disabled>
              </div>

              <div class="form-group">
                <label>Nama Caleg</label>
                <input type="text" value="{{ $caleg->nama }}" class="form-control" disabled>
              </div>

              <div class="form-group">
                <label>Nama Petugas</label>
                <input type="text" value="{{ $tps->users->name }}" class="form-control" disabled>
              </div>

              @if(Auth::user()->status == 0)
              <div class="form-group">
                <label>Perolehan Suara Caleg</label>
                <input type="number" name="suara_caleg" class="form-control" required>
              </div>
              @foreach($partais as $partai)
              <div class="form-group">
                <label>Perolehan Suara Partai {{ $partai->nama }}</label>
                <input type="number" name="id_partai[]" value="{{ $partai->id }}" class="form-control" hidden>
                <input type="number" name="suara_partai" class="form-control" required>
              </div>
              @endforeach
              @else
              <div class="form-group">
                <label>Perolehan Suara</label>
                <input type="number" value="{{ $tps->suara_caleg }}" name="suara_caleg" class="form-control" disabled>
              </div>
              @foreach($suaras as $suara)
              <div class="form-group">
                <label>Perolehan Suara Partai {{ $suara->partai->nama }}</label>
                <input type="number" name="suara_partai" value="{{ $suara->suara_partai }}" class="form-control" disabled>
              </div>
              @endforeach
              @endif

              <div class="form-check mb-4">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" required>
                  Saya telah mengisi form ini dengan benar
                </label>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            @else
            <h4>Anda tidak memiliki akses ke TPS</h4>
            @endif
                                            
        </div>														
    </div><!-- end card-->
</div>

@endsection