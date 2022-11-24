@extends('layouts.app')

@section('title', 'Waktu')
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
                <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                    <h3 class="text-light">Waktu Pemilihan</h3>
                    <button class="btn btn-light" id="add_waktu" data-bs-toggle="modal" data-bs-target="#addWaktuModal"><i
                            class="bi-clock me-2"></i>Setting Waktu</button>
                </div>
                <div class="card-body" id="show_all_waktu">
                    <h1 class="text-center text-secondary my-5">Loading...</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addWaktuModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Setting Waktu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="add_waktu_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light g-3">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="add_waktu_btn" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editWaktuModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_waktu_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light g-3">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="edit_waktu_btn" class="btn btn-success">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
    @section('script') <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script> --}}
    <script src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"> --}}
    </script>

    <script>
        $(function() {

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
                            Swal.fire(
                                'Berhasil!',
                                'Jadwal Berhasil Dibuat!',
                                'success'
                            )
                            fetchAllWaktu();
                        } else{
                            Swal.fire(
                                'Gagal',
                                'Waktu Awal dan Waktu Akhir Tidak Boleh Sama!',
                                'error',
                            )
                        }
                        $("#add_waktu_btn").text('Simpan');
                        $("#add_waktu_form")[0].reset();
                        $("#addWaktuModal").modal('hide');
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
                            Swal.fire(
                                'Berhasil!',
                                'Waktu Berhasil Diubah!',
                                'success'
                            )
                            fetchAllWaktu();
                        } else{
                            Swal.fire(
                                'Gagal',
                                'Waktu Awal dan Waktu Akhir Tidak Boleh Sama!',
                                'error',
                            )
                        }
                        $("#edit_waktu_btn").text('Simpan');
                        $("#edit_waktu_form")[0].reset();
                        $("#editWaktuModal").modal('hide');
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
                                console.log(response);
                                Swal.fire(
                                    'Berhasil!',
                                    'Data Berhasil Dihapus.',
                                    'success'
                                )
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
                        console.log(response.count);
                        if(response.count > 0){
                            $('#add_waktu').attr('disabled', true);
                        } else{
                            $('#add_waktu').attr('disabled', false);
                        }
                        $("#show_all_waktu").html(response.data);
                    }
                });
            }
        });
    </script>
@endsection
