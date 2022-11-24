@extends('layouts.app')

@section('title', 'Daftar Kandidat')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded mt-3 mb-5">
                <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                    <h3 class="text-light">Daftar Kandidat</h3>
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addKandidatModal"><i
                            class="bi-plus-circle me-2"></i>Tambah Kandidat</button>
                </div>
                <div class="card-body" id="show_all_kandidat">
                    <h1 class="text-center text-secondary my-5">Loading...</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addKandidatModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kandidat Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="add_kandidat_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light g-3">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan Nama"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan Email"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS"
                                    required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <div class="row">
                                    <div class="col-6 col-md-6">
                                        <select name="kelas" class="form-select">
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <select name="jurusan" class="form-select">
                                            <option value="rpl">RPL</option>
                                            <option value="mm">MM</option>
                                            <option value="pftv">PFTV</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="visi" class="form-label">Visi</label>
                                <textarea name="visi" name="visi" class="form-control" placeholder="Masukkan Visi" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="misi" class="form-label">Misi</label>
                                <textarea name="misi" name="misi" class="form-control" placeholder="Masukkan Misi" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" name="foto" row="10" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="add_kandidat_btn" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editKandidatModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Kandidat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_kandidat_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light g-3">
                        <div class="row">
                            <input type="hidden" name="kandidat_id" id="kandidat_id">
                            <input type="hidden" name="kandidat_foto" id="kandidat_foto">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Masukkan Nama" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Masukkan Email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nis" class="form-label">Email</label>
                                <input type="text" id="nis" name="nis" class="form-control"
                                    placeholder="Masukkan NIS" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <div class="row">
                                    <div class="col-6 col-md-6">
                                        <select name="kelas" id="kelas" class="form-select">
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <select name="jurusan" id="jurusan" class="form-select">
                                            <option value="rpl">RPL</option>
                                            <option value="mm">MM</option>
                                            <option value="pftv">PFTV</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="visi" class="form-label">Visi</label>
                                <textarea name="visi" id="visi" name="visi" class="form-control" placeholder="Masukkan Visi" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="misi" class="form-label">Misi</label>
                                <textarea name="misi" id="misi" name="misi" class="form-control" placeholder="Masukkan Misi" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" name="foto" row="10">
                            </div>
                            <div class="col-md-12 text-center mt-2" id="foto">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="edit_kandidat_btn" class="btn btn-success">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script> --}}
    <script src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {

            // add new kandidat ajax request
            $("#add_kandidat_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_kandidat_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('kandidat.store') }}',
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
                                'Kandidat Berhasil Ditambahkan!',
                                'success'
                            )
                        } else{
                            Swal.fire(
                                'Gagal!',
                                'Terdapat kesamaan Data Dengan Kandidat Lain!',
                                'error'
                            )
                        }
                        fetchAllKandidat();
                        $("#add_kandidat_btn").text('Simpan');
                        $("#add_kandidat_form")[0].reset();
                        $("#addKandidatModal").modal('hide');
                    }
                });
            });

            // edit kandidat ajax request
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('kandidat.edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#name").val(response.name);
                        $("#email").val(response.email);
                        $("#nis").val(response.nis);
                        $("#kelas").val(response.kelas);
                        $("#jurusan").val(response.jurusan);
                        $("#visi").val(response.visi);
                        $("#misi").val(response.misi);
                        $("#foto").html(
                            `<img src="storage/kandidats/${response.foto}" width="100" class="img-fluid img-thumbnail">`
                        );
                        $("#kandidat_id").val(response.id);
                        $("#kandidat_foto").val(response.foto);
                    }
                });
            });

            // update kandidat ajax request
            $("#edit_kandidat_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_kandidat_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('kandidat.update') }}',
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
                                'Kandidat Berhasil Diubah!',
                                'success'
                            )
                        } else{
                            Swal.fire(
                                'Gagal!',
                                'Terdapat kesamaan Email/NIS Dengan Kandidat Lain!',
                                'error'
                            )
                        }
                        fetchAllKandidat();
                        $("#edit_kandidat_btn").text('Simpan');
                        $("#edit_kandidat_form")[0].reset();
                        $("#editKandidatModal").modal('hide');
                    }
                });
            });

            // delete kandidat ajax request
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
                            url: '{{ route('kandidat.delete') }}',
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
                                fetchAllKandidat();
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
                            url: '{{ route('kandidat.deleteAll') }}',
                            method: 'delete',
                            data: {
                                _token: csrf
                            },
                            success: function(response) {
                                console.log(response);
                                Swal.fire(
                                    'Berhasil!',
                                    'Data Berhasil Dihapus.',
                                    'success'
                                )
                                fetchAllKandidat();
                            }
                        });
                    }
                })
            });

            // fetch all kandidat ajax request
            fetchAllKandidat();

            function fetchAllKandidat() {
                $.ajax({
                    url: '{{ route('kandidat.fetchAll') }}',
                    method: 'get',
                    success: function(response) {
                        $("#show_all_kandidat").html(response);
                        $("table").DataTable({
                            order: [0, 'asc']
                        });
                    }
                });
            }
        });
    </script>
@endsection
