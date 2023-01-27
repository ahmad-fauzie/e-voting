@extends('layouts.app')

@section('title', 'Setting')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
@endsection
@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h3>Setting</h3>
                </div>
                <div class="col-12 col-md-6">
                    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Setting</li>
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
                            <h3 class="text-secondary">Setting Aplikasi</h3>
                        </div>
                        <div class="card-body text-dark">
                            <div class="d-flex bg-grey justify-content-start align-items-center p-3" style="box-shadow: 0 2px 6px 0 rgba(0,0,0,.3);">
                                <button class="btn btn-danger deleteVoting p-2" style="height: fit-content;"><i class="bi bi-trash fs-4"></i></button>
                                <div class="card-content ms-3">
                                    <div class="card-title mb-2">Reset Hasil Voting</div>
                                    <div class="card-subtitle">Pilih ini jika anda ingin menghapus seluruh data hasil voting saat ini (termasuk dokumen hasil voting). Lakukan ketika seluruh proses pemilihan sudah selesai.</div>
                                </div>
                            </div>

                            <div class="d-flex bg-grey justify-content-start align-items-center p-3" style="box-shadow: 0 2px 6px 0 rgba(0,0,0,.3);">
                                <button class="btn btn-danger deleteAll p-2" style="height: fit-content;"><i class="bi bi-recycle fs-4"></i></button>
                                <div class="card-content ms-3">
                                    <div class="card-title mb-2">Reset Data Aplikasi</div>
                                    <div class="card-subtitle">Pilih ini jika anda ingin menghapus seluruh data aplikasi E-Voting saat ini (kecuali akun admin).</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@section('script')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
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

            $(document).on('click', '.deleteVoting', function(e) {
                e.preventDefault();
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Apakah Kamu Yakin?',
                    text: "Kamu tidak bisa mengembalikan hasil voting setelah ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus itu!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('setting.deleteVoting') }}',
                            method: 'delete',
                            data: {
                                _token: csrf
                            },
                            success: function(response) {
                                toastMixin.fire({
                                    title: 'Data Berhasil Dihapus.',
                                    icon: 'success'
                                });
                            }
                        });
                    }
                })
            });

            $(document).on('click', '.deleteAll', function(e) {
                e.preventDefault();
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Apakah Kamu Yakin?',
                    text: "Kamu tidak bisa mengembalikan seluruh data aplikasi setelah ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus itu!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('setting.deleteAll') }}',
                            method: 'delete',
                            data: {
                                _token: csrf
                            },
                            success: function(response) {
                                toastMixin.fire({
                                    title: 'Data Berhasil Dihapus.',
                                    icon: 'success'
                                });
                            }
                        });
                    }
                })
            });

        });
    </script>
@endsection