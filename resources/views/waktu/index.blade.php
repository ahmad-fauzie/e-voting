@extends('layouts.app')

@section('title', 'Waktu')
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
                    <h3>Jadwal Voting</h3>
                </div>
                <div class="col-12 col-md-6">
                    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Jadwal Voting</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded mt-3 mb-5">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="text-secondary">Waktu Pemilihan</h3>
                            <button class="btn btn-primary d-flex text-white p-2" id="add_waktu" data-bs-toggle="modal"
                                data-bs-target="#addWaktuModal"><i class="bi bi-clock d-block h-auto"></i>
                                <span class="d-none d-md-block ps-1">Setting Waktu</span></button>
                        </div>
                        <div class="card-body" id="show_all_waktu">
                            <h1 class="text-center text-secondary my-5">Loading...</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addWaktuModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                data-bs-backdrop="static" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title white" id="exampleModalLabel">Setting Waktu</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="#" method="POST" id="add_waktu_form" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body text-dark">
                                <div class="form-group date mb-3">
                                    <label for="awal" class="form-label">Waktu Mulai</label>
                                    <input type="date" name="awal" class="form-control" required>
                                </div>
                                <div class="form-group date mb-3">
                                    <label for="akhir" class="form-label">Waktu Akhir</label>
                                    <input type="date" name="akhir" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <span>Close</span>
                                </button>
                                <button type="submit" id="add_waktu_btn" class="btn btn-primary ml-1"
                                    data-bs-dismiss="modal">
                                    <span>Simpan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editWaktuModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                data-bs-backdrop="static" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title white" id="exampleModalLabel">Ubah Jadwal</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="#" method="POST" id="edit_waktu_form" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body text-dark">
                                <input type="hidden" name="waktu_id" id="waktu_id">
                                <div class="form-group date mb-3">
                                    <label for="awal" class="form-label">Waktu Mulai</label>
                                    <input type="date" id="awal" name="awal" class="form-control" required>
                                </div>
                                <div class="form-group date mb-3">
                                    <label for="akhir" class="form-label">Waktu Akhir</label>
                                    <input type="date" id="akhir" name="akhir" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <span>Close</span>
                                </button>
                                <button type="submit" id="edit_waktu_btn" class="btn btn-primary ml-1"
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
    </script>

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

            // add new waktu ajax request
            $("#add_waktu_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_waktu_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('waktu.store') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            toastMixin.fire({
                                title:  'Jadwal Berhasil Dibuat!',
                                icon: 'success'
                            });
                            $("#add_waktu_form")[0].reset();
                            $("#addWaktuModal").modal('hide');
                            fetchAllWaktu();
                        } else {
                            Swal.fire(
                                'Gagal',
                                response.message,
                                'error',
                            )
                        }
                        $("#add_waktu_btn").text('Simpan');
                    }
                });
            });

            // edit waktu ajax request
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('waktu.edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#awal").val(response.waktu_awal);
                        $("#akhir").val(response.waktu_akhir);
                        $("#waktu_id").val(response.id);
                    }
                });
            });

            // update waktu ajax request
            $("#edit_waktu_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_waktu_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('waktu.update') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            toastMixin.fire({
                                title:  'Waktu Berhasil Diubah!',
                                icon: 'success'
                            });
                            $("#edit_waktu_form")[0].reset();
                            $("#editWaktuModal").modal('hide');
                            fetchAllWaktu();
                        } else {
                            Swal.fire(
                                'Gagal',
                                response.message,
                                'error',
                            )
                        }
                        $("#edit_waktu_btn").text('Simpan');
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
                            url: '{{ route('waktu.delete') }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                toastMixin.fire({
                                    title:  'Data Berhasil Dihapus!',
                                    icon: 'success'
                                });
                                fetchAllWaktu();
                            }
                        });
                    }
                })
            });

            // fetch all waktu ajax request
            fetchAllWaktu();

            function fetchAllWaktu() {
                $.ajax({
                    url: '{{ route('waktu.fetchAll') }}',
                    method: 'get',
                    success: function(response) {
                        if (response.count > 0) {
                            $('#add_waktu').attr('disabled', true);
                        } else {
                            $('#add_waktu').attr('disabled', false);
                        }
                        $("#show_all_waktu").html(response.data);
                    }
                });
            }
        });
    </script>
@endsection
