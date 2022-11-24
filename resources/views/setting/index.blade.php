@extends('layouts.app')

@section('title', 'Setting')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> --}}
<link rel="stylesheet" {{-- href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css"> --}} @endsection
    @section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded mt-3 mb-5">
                <div class="card-header bg-danger">
                    <h3 class="text-light">Setting Akun</h3>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" id="edit_user_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="user_id" name="user_id">
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Masukkan Nama" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Masukkan Email" required>
                        </div>
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <button type="submit" id="edit_user_btn" class="btn btn-success">Ubah</button>
                            <a href="#" class="text-success mx-1" data-bs-toggle="modal" data-bs-target="#editPasswordModal"><i class="bi-pencil-square h4"></i> Ubah Password</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_password_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light g-3">
                        <div class="form-group date mb-3">
                            <label for="lama" class="form-label">Password Lama</label>
                            <input type="password" name="lama" class="form-control" required>
                        </div>
                        <div class="form-group date mb-3">
                            <label for="baru" class="form-label">Password Baru</label>
                            <input type="password" name="baru" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="edit_password_btn" class="btn btn-success">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
    @section('script') <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </script>

    <script>
        $(function() {

            // update setting ajax request
            $("#edit_user_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_user_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('setting.update') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Berhasil!',
                                'Data Berhasil Diubah!',
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Data Gagal Diubah!',
                                'error'
                            )
                        }
                        fetchUser();
                        $("#edit_user_btn").text('Ubah');
                    }
                });
            });

            // update password ajax request
            $("#edit_password_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_password_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('setting.updatePassword') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Berhasil!',
                                'Password Berhasil Diubah!',
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Gagal!',
                                response.message,
                                'error'
                            )
                        }
                        fetchUser();
                        $("#edit_password_btn").text('Ubah');
                        $("#edit_password_form")[0].reset();
                        $("#editPasswordModal").modal('hide');
                    }
                });
            });

            // fetch user ajax request
            fetchUser();

            function fetchUser() {
                $.ajax({
                    url: '{{ route('setting.fetchUser') }}',
                    method: 'get',
                    success: function(response) {
                        console.log(response.user);
                        console.log(response.password);
                        let user = response.user;
                        $('#user_id').val(user.id);
                        $('#name').val(user.name);
                        $('#email').val(user.email);
                    }
                });
            }

        });
    </script>
@endsection
