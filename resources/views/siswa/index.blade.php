@extends('layouts.app')

@section('title', 'Daftar Siswa')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
@endsection

@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h3>Data Master Siswa</h3>
                </div>
                <div class="col-12 col-md-6">
                    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Siswa</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded mt-3 mb-5">
                        <div class="card-header">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-lg-5 col-md-6">
                                    <h3 class="text-secondary">Daftar Siswa</h3>
                                </div>
                                <div class="col-lg-7 col-md-6 d-flex justify-content-end align-items-center nav-button"
                                    style="gap: 3px;">
                                    <button class="btn btn-danger p-2">
                                        <a href="#" class="text-white deleteAll d-flex"><i class="bi bi-trash d-block h-auto"></i>
                                            <span class="d-none d-md-block ps-1">Hapus Semua</span></a>
                                    </button>
                                    <button class="btn btn-primary p-2 d-flex" data-bs-toggle="modal"
                                        data-bs-target="#addSiswaModal"><i class="bi bi-plus-circle d-block h-auto"></i>
                                        <span class="d-none d-md-block ps-1">Tambah Siswa</span></button>
                                    <button class="btn btn-secondary p-2 d-flex" data-bs-toggle="modal"
                                        data-bs-target="#importSiswaModal"><i class="bi-file-earmark-spreadsheet d-block h-auto"></i><span class="d-none d-md-block ps-1">Import File</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="show_all_siswa">
                            <h1 class="text-center text-secondary my-5">Loading...</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="importSiswaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                data-bs-backdrop="static" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title white" id="exampleModalLabel">Import File</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="#" method="POST" id="import_siswa_form" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <button id="download_excel" class="btn btn-primary p-2"><i class="bi bi-download"></i>
                                        Template</button>
                                </div>
                                <div class="custom-file text-left">
                                    <input type="file" name="siswa" class="custom-file-input" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <span>Close</span>
                                </button>
                                <button type="submit" id="import_siswa_btn" class="btn btn-primary ml-1"
                                    data-bs-dismiss="modal">
                                    <span>Simpan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addSiswaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                data-bs-backdrop="static" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title white" id="exampleModalLabel">Siswa Baru</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="#" method="POST" id="add_siswa_form" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body text-dark">
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Masukkan Nama" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Masukkan Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">NIS</label>
                                    <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS"
                                        required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <span>Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1" id="add_siswa_btn"
                                    data-bs-dismiss="modal">
                                    <span>Simpan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editSiswaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                data-bs-backdrop="static" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title white" id="exampleModalLabel">Data Siswa</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="#" method="POST" id="edit_siswa_form" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body text-dark">
                                <input type="hidden" name="siswa_id" id="siswa_id">
                                <input type="hidden" name="siswa_id_kandidat" id="siswa_id_kandidat">
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Masukkan Nama" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="Masukkan Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="nis" class="form-label">NIS</label>
                                    <input type="text" id="nis" name="nis" class="form-control"
                                        placeholder="Masukkan NIS" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <span>Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1" id="edit_siswa_btn"
                                    data-bs-dismiss="modal">
                                    <span>Simpan</span>
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
    <script src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {

            var toastMixin = Swal.mixin({
                toast: true,
                icon: 'success',
                title: 'General Title',
                animation: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            // get export template ajax request
            $(document).on('click', '#download_excel', function(e) {
                e.preventDefault();
                const url = '{{ route('siswa.export') }}';
                window.location = url;
            });


            // import siswa ajax request
            $("#import_siswa_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#import_siswa_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('siswa.storeImport') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            toastMixin.fire({
                                title:  'Siswa Berhasil Ditambahkan!',
                                icon: 'success'
                            });
                            fetchAllSiswa();
                        }
                        $("#import_siswa_btn").text('Simpan');
                        $("#import_siswa_form")[0].reset();
                        $("#importSiswaModal").modal('hide');
                    }
                });
            });

            // add new siswa ajax request
            $("#add_siswa_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_siswa_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('siswa.store') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            toastMixin.fire({
                                title: 'Siswa Berhasil Ditambahkan!',
                                icon: 'success'
                            });
                            $("#add_siswa_form")[0].reset();
                            $("#addSiswaModal").modal('hide');
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Terdapat Kesamaan Data Dengan Siswa Lain!',
                                'error'
                            )
                        }
                        fetchAllSiswa();
                        $("#add_siswa_btn").text('Simpan');
                    }
                });
            });

            // edit siswa ajax request
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('siswa.edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        let siswa = response.siswa;
                        $("#name").val(siswa.name);
                        $("#email").val(siswa.email);
                        $("#nis").val(siswa.nis);
                        $("#siswa_id").val(siswa.id);
                        $("#siswa_id_kandidat").val(response.kandidat);
                        if (response.status == 406) {
                            Swal.fire({
                                title: 'Apakah Kamu Yakin?',
                                text: response.message,
                                icon: 'warning',
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya!'
                            });
                        }
                    }
                });
            });

            // update siswa ajax request
            $("#edit_siswa_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_siswa_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('siswa.update') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            toastMixin.fire({
                                title: 'Siswa Berhasil Diubah!',
                                icon: 'success'
                            });
                            $("#edit_siswa_form")[0].reset();
                            $("#editSiswaModal").modal('hide');
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Terdapat kesamaan Data Dengan Siswa Lain!',
                                'error'
                            )
                        }
                        fetchAllSiswa();
                        $("#edit_siswa_btn").text('Simpan');
                    }
                });
            });

            // delete siswa ajax request
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Apakah Kamu Yakin?',
                    text: "Kamu tidak bisa mengembalikan data ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus itu!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('siswa.delete') }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                console.log(response.status);
                                if (response.status == 200){
                                    toastMixin.fire({
                                        title: 'Data Berhasil Dihapus.',
                                        icon: 'success'
                                    });
                                } else{
                                    toastMixin.fire({
                                        title: 'Data Gagal Dihapus.',
                                        icon: 'error'
                                    });
                                }
                                fetchAllSiswa();
                            }
                        });
                    }
                })
            });

            // delete all siswa ajax request
            $(document).on('click', '.deleteAll', function(e) {
                e.preventDefault();
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Apakah Kamu Yakin?',
                    text: "Kamu tidak bisa mengembalikan data ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus itu!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('siswa.deleteAll') }}',
                            method: 'delete',
                            data: {
                                _token: csrf
                            },
                            success: function(response) {
                                toastMixin.fire({
                                    title: 'Data Berhasil Dihapus.',
                                    icon: 'success'
                                });
                                fetchAllSiswa();
                            }
                        });
                    }
                })
            });

            // fetch all siswa ajax request
            fetchAllSiswa();

            function fetchAllSiswa() {
                $.ajax({
                    url: '{{ route('siswa.fetchAll') }}',
                    method: 'get',
                    success: function(response) {
                        $("#show_all_siswa").html(response.data);
                        $("table").DataTable({
                            order: [0, 'asc']
                        });
                    }
                });
            }
        });
    </script>
@endsection
