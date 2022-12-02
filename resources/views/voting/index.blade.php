@extends('layouts.app')

@section('title', 'Voting')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
@endsection

@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <h3>Voting</h3>
            {{-- <p class="text-subtitle text-muted">A good dashboard to display your statistics</p> --}}
        </div>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded mt-3 mb-5">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="text-secondary">VOTING</h3>
                            <div class="text-dark">
                                <span class="fw-bold" id="start-end">Waktu Mulai : </span>
                                <span class="fw-bold" id="cd-days">00</span> Hari
                                <span class="fw-bold" id="cd-hours">00</span> Jam
                                <span class="fw-bold" id="cd-minutes">00</span> Menit
                                <span class="fw-bold" id="cd-seconds">00</span> Detik
                            </div>
                        </div>
                        <div class="card-body row p-4 gy-md-4" id="show_all_kandidat">
                            <h1 class="text-center text-secondary my-5">Loading...</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script> --}}
    {{-- <script src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {

            // vote ajax request
            $(document).on('click', '.voting', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Apakah Kamu Yakin?',
                    text: "Kamu tidak bisa Memilih Kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, saya yakin!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('voting.store') }}',
                            method: 'post',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                console.log(response);
                                Swal.fire(
                                    'Berhasil!',
                                    'Kamu Telah Berhasil Memilih.',
                                    'success'
                                )
                                fetchAllKandidat();
                            }
                        });
                    }
                })
            });

            // vote error not yet
            $(document).on('click', '.voting-error', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Voting Belum Dimulai',
                    text: "Kamu tidak bisa Memilih Saat Ini!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Oke!'
                })
            });

            // vote error end
            $(document).on('click', '.voting-error-end', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Voting Sudah Selesai',
                    text: "Kamu tidak bisa Memilih Saat Ini!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Oke!'
                })
            });

            // timer countdown
            function timer(date_start, date_end) {
                $.ajax({
                    url: 'http://worldtimeapi.org/api/timezone/Asia/Jakarta',
                    method: 'get',
                    success: function(response) {
                        console.log(response);
                        let now = Math.round(new Date(response.datetime).getTime() / 1000);
                        let start = Math.round(new Date(date_start).getTime() / 1000);
                        let end = Math.round(new Date(date_end).getTime() / 1000);
                        console.log(now);
                        console.log(start);
                        let timer, days, hours, minutes, seconds;
                        if (now >= start && now <= end) {
                            $('#start-end').html('Waktu Berakhir : ');
                            timer = end - now;
                        } else if (now < start) {
                            // $('.voting').attr('id', 0);
                            $('.voting').attr('class', 'btn btn-sm btn-success voting-error');
                            timer = start - now;
                        } else {
                            $('#start-end').html('Waktu Berakhir : ');
                            $('.voting').attr('class', 'btn btn-sm btn-success voting-error-end');
                            timer = start - now;
                        }
                        setInterval(function() {
                            if (--timer < 0) {
                                timer = 0;
                            }
                            days = parseInt(timer / 60 / 60 / 24, 10);
                            hours = parseInt((timer / 60 / 60) % 24, 10);
                            minutes = parseInt((timer / 60) % 60, 10);
                            seconds = parseInt(timer % 60, 10);

                            days = days < 10 ? "0" + days : days;
                            hours = hours < 10 ? "0" + hours : hours;
                            minutes = minutes < 10 ? "0" + minutes : minutes;
                            seconds = seconds < 10 ? "0" + seconds : seconds;

                            $('#cd-days').html(days);
                            $('#cd-hours').html(hours);
                            $('#cd-minutes').html(minutes);
                            $('#cd-seconds').html(seconds);
                        }, 1000);

                    }
                });

            }

            // fetch all kandidat ajax request
            fetchAllKandidat();

            function fetchAllKandidat() {
                $.ajax({
                    url: '{{ route('voting.info') }}',
                    method: 'get',
                    success: function(response) {
                        console.log(response);
                        let waktu = response.waktu;
                        if (response.waktu_count) {
                            $("#show_all_kandidat").html(response.output);
                            timer(waktu[0].waktu_awal, waktu[0].waktu_akhir);
                        } else {
                            $("#show_all_kandidat").html(
                                '<h1 class="text-center text-secondary my-5">Jadwal Voting Tidak Tersedia!</h1>'
                            );
                        }
                    }
                });
            }
        });
    </script>
@endsection
