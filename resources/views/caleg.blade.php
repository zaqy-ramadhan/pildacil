@extends('layouts.admin_layout')

@section('content')

<div class="container-fluid p-4">
    <div class="card mb-3 mt-5">
        <div class="card-header">
            <h3><i class="fa fa-table"></i>Caleg Table</h3>
        </div>
            
        <div class="card-body">
            <a href="" class="btn btn-success mb-4" data-toggle="modal" data-target="#addModal">New Data</a>
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-hover display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Caleg</th>
                        <th>Action</th>
                    </tr>
                </thead>										
                <tbody>
                    <?php $num = 1 ?>
                    @foreach($calegs as $caleg)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $caleg->nama }}</td>
                        <td>
                            <a href="#" class="btn btn-warning"  data-toggle="modal" data-target="#editModal{{ $caleg->id }}">Edit</a>
                            <a href="" class="btn btn-danger delete-btn" data-id={{ $caleg->id }}>Delete</a>
                        </td>

                        <!-- Modal Edit-->
								        <div class="modal fade" id="editModal{{ $caleg->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('caleg.update')}}" method="post">
                                                @csrf
                                                <input type="text" name="id" value="{{ $caleg->id }}" hidden>
                                                <div class="form-group">
                                                  <label>Nama</label>
                                                  <input name="nama" value="{{ $caleg->nama }}" type="text" class="form-control">
                                                </div>
                                  
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                              </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            
        </div>														
    </div>

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
                                            <form action="{{ route('caleg.store')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                  <label>Nama Caleg</label>
                                                  <input name="nama" type="text" class="form-control" required>
                                                </div>
                                  
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                              </form>
                                        </div>
                                      </div>
                                    </div>
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
                fetch(`/caleg/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => {
                    if (response.ok) {
                        // Redirect ke halaman lain jika penghapusan berhasil
                        window.location.href = '{{ route("caleg.index") }}';
                    }
                })
                .catch(error => console.error(error));
            }
        });
    });
</script>
@endsection