@extends('layouts.admin_layout')

@section('content')


<div class="container-fluid p-4">
    <div class="card mb-3 mt-5">
        <div class="card-header">
            <h3><i class="fa fa-table"></i> TPS Table</h3>
        </div>
            
        <div class="card-body">

          @if(Auth::user()->role === 0)          
            <a href="" class="btn btn-success mb-4" data-toggle="modal" data-target="#addModal">New Data</a>
          @endif

            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-hover display">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Alamat TPS</th>
                        <th>Nama TPS</th>
                        <th>Dapil</th>
                        <th>Petugas</th>
                        <th>Caleg</th>
                        <th>Partai</th>
                        <th>Suara</th>
                        @if(Auth::user()->role === 0) 
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>										
                <tbody>
                  <?php $num = 1 ?>
                  @foreach($tps as $data)
                  <tr>
                      <td>{{ $num++ }}</td>
                      <td>{{ $data->alamat }}</td>
                      <td>{{ $data->nama_tps }}</td>
                      <td>{{ $data->dapil->nama_dapil }}</td>
                      <td>{{ $data->users->name }}</td>
                      <td>{{ $data->nama_caleg }}</td>
                      <td>{{ $data->partai_caleg }}</td>
                      <td>{{ $data->perolehan_suara }}</td>
                      @if(Auth::user()->role === 0) 
                      <td>
                          <a href="#" class="btn btn-warning"  data-toggle="modal" data-target="#editModal{{ $data->id }}">Edit</a>
                          <a href="" class="btn btn-danger delete-btn" data-id={{ $data->id }}>Delete</a>
                      </td>
                      @endif

                      @if(Auth::user()->role === 0) 
                      <!-- Modal Edit-->
                      <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                          <form action="{{ route('tps.update')}}" method="post">
                                              @csrf
                                              <input type="text" name="id" value="{{ $data->id }}" hidden>
                                              <div class="form-group">
                                                <label>Nama TPS</label>
                                                <input name="nama_tps" value="{{ $data->nama_tps }}" type="text" class="form-control">
                                              </div>

                                              <div class="form-group">
                                                <label>Alamat TPS</label>
                                                <input name="alamat" value="{{ $data->alamat }}" type="text" class="form-control">
                                              </div>

                                              <div class="form-group">
                                                <label>Dapil</label>
                                                <select name="id_dapil" class="form-control">
                                                  @foreach($dapils as $dapil)
                                                  <option value="{{ $dapil->id }}"  @if($data->id_dapil === $dapil->id) selected @endif>{{ $dapil->nama_dapil }}</option>
                                                  @endforeach
                                                </select>
                                              </div>

                                              <div class="form-group">
                                                <label>Petugas</label>
                                                <select name="id_user" class="form-control">
                                                  @foreach($users as $user)
                                                  <option value="{{ $user->id }}" @if($data->id_user === $user->id) selected @endif>{{ $user->name }}</option>
                                                  @endforeach
                                                </select>
                                              </div>

                                              <div class="form-group">
                                                <label>Caleg</label>
                                                <input name="nama_caleg" value="{{ $data->nama_caleg }}" type="text" class="form-control">
                                              </div>

                                              <div class="form-group">
                                                <label>Partai</label>
                                                <input name="partai_caleg" value="{{ $data->partai_caleg }}" type="text" class="form-control">
                                              </div>
                                
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                          </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                      @endif

                  </tr>
                  @endforeach
              </tbody>
            </table>
            </div>
            
        </div>														
    </div>
    
    @if(Auth::user()->role === 0) 
    <!-- Modal Tambah-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('tps.store')}}" method="post">
              @csrf
              <div class="form-group">
                <label>Nama TPS</label>
                <input name="nama_tps" type="text" class="form-control">
              </div>

              <div class="form-group">
                <label>Alamat TPS</label>
                <input name="alamat" type="text" class="form-control">
              </div>

              <div class="form-group">
                <label>Dapil</label>
                <select name="id_dapil" class="form-control">
                  @foreach($dapils as $dapil)
                  <option value="{{ $dapil->id }}">{{ $dapil->nama_dapil }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Petugas</label>
                <select name="id_user" class="form-control">
                  @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Caleg</label>
                <input name="nama_caleg" type="text" class="form-control">
              </div>

              <div class="form-group">
                <label>Partai</label>
                <input name="partai_caleg" type="text" class="form-control">
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    @endif

  </div>

</div>

@endsection

@section('script')
<script>
  // Tangani klik tombol hapus
  const deleteButtons = document.querySelectorAll('.delete-btn');
  deleteButtons.forEach(button => {
      button.addEventListener('click', function() {
          const userId = this.getAttribute('data-id');
          const confirmation = confirm('Apakah Anda yakin ingin menghapus data ini?');
          
          if (confirmation) {
              // Jika pengguna mengonfirmasi, kirim permintaan DELETE menggunakan fetch API
              fetch(`/tps/${userId}`, {
                  method: 'DELETE',
                  headers: {
                      'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  },
              })
              .then(response => {
                  if (response.ok) {
                      // Redirect ke halaman lain jika penghapusan berhasil
                      window.location.href = '{{ route("tps.index") }}';
                  }
              })
              .catch(error => console.error(error));
          }
      });
  });
</script>
@endsection