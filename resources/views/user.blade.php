@extends('layouts.admin_layout')

@section('content')


<div class="container-fluid p-4">
    <div class="card mb-3 mt-5">
        <div class="card-header">
            <h3><i class="fa fa-table"></i> User Table</h3>
        </div>
            
        <div class="card-body">
            <a href="#" class="btn btn-success mb-4" data-toggle="modal" data-target="#addModal">New Data</a>
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-hover display">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>No. telp</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>										
                <tbody>
                  <?php $num = 1 ?>
                    @foreach($users as $user)
                    <tr>
                      <td>{{ $num++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->notelp }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="#" class="btn btn-warning"  data-toggle="modal" data-target="#editModal{{ $user->id }}">Edit</a>
                            <a href="" class="btn btn-danger delete-btn" data-id={{ $user->id }}>Delete</a>
                        </td>

                        <!-- Modal Edit-->
								        <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('users.update')}}" method="post">
                                                @csrf
                                                <input type="text" name="id" value="{{ $user->id }}" hidden>
                                                <div class="form-group">
                                                  <label>Nama</label>
                                                  <input name="name" value="{{ $user->name }}" type="text" class="form-control">
                                                </div>
                                  
                                                <div class="form-group">
                                                  <label>Email</label>
                                                  <input name="email" value="{{ $user->email }}" type="text" class="form-control">
                                                </div>
                                  
                                                <div class="form-group">
                                                  <label>No. Telp</label>
                                                  <input value="{{ $user->notelp }}" type="text" name="notelp" class="form-control">
                                                </div>
                                  
                                                <div class="form-group">
                                                  <label>Role</label>
                                                  <select class="form-control" name="role">
                                                    <option value="0" @if($user->role == 0) selected @endif>Super Admin</option>
                                                    <option value="1" @if($user->role == 1) selected @endif>Admin</option>
                                                    <option value="2" @if($user->role == 2) selected @endif>Petugas</option>
                                                  </select>
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
    <!-- end card-->
    
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
                                        <form action="{{ route('users.store')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label>Nama</label>
                                              <input name="name" type="text" class="form-control" required>
                                            </div>
                              
                                            <div class="form-group">
                                              <label>Email</label>
                                              <input name="email" type="text" class="form-control" required>
                                            </div>
                              
                                            <div class="form-group">
                                              <label>No. Telp</label>
                                              <input name="notelp" type="number" class="form-control" required>
                                            </div>
                              
                                            <div class="form-group">
                                              <label>Role</label>
                                              <select class="form-control" name="role" required>
                                                <option value="0">Super Admin</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Petugas</option>
                                              </select>
                                            </div>

                                            <div class="form-group">
                                              <label>Password</label>
                                              <input name="password" type="text" class="form-control" required>
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
                fetch(`/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => {
                    if (response.ok) {
                        // Redirect ke halaman lain jika penghapusan berhasil
                        window.location.href = '{{ route("users.index") }}';
                    } else {
                        // Tampilkan pesan jika terjadi kesalahan
                        alert('Gagal menghapus data.');
                    }
                })
                .catch(error => console.error(error));
            }
        });
    });
</script>
@endsection