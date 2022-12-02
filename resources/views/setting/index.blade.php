@extends('layouts.app')

@section('title', 'Setting')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' /> --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" /> --}}
@endsection
@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <h3>Profile</h3>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded mt-3 mb-5">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="text-secondary">Setting Akun</h3>
                        </div>
                        <div class="card-body text-dark">
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
                                    <button type="submit" id="edit_user_btn" class="btn btn-primary">Simpan</button>
                                    <a href="#" class="text-secondary mx-1" data-bs-toggle="modal"
                                        data-bs-target="#editPasswordModal"><i class="bi-pencil-square h4"></i> Reset
                                        Password</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                data-bs-backdrop="static" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title white" id="exampleModalLabel">Reset Password</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="#" method="POST" id="edit_password_form" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body text-dark">
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
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1" id="edit_password_btn" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Simpan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@section('script')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    {{-- <script src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script> --}}
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
