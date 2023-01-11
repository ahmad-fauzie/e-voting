@extends('layouts.app')

@section('title', 'Hasil')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' /> --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" /> --}}
@endsection

@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h3>Hasil</h3>
                </div>
                <div class="col-12 col-md-6">
                    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Hasil</li>
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
                                <div class="col-md-6">
                                    <h3 class="text-secondary">Hasil Voting</h3>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end align-items-center">
                                    <div class="text-dark">
                                        <span class="fw-bold" id="start-end">Waktu Mulai : </span>
                                        <span class="fw-bold" id="cd-days">00</span> Hari
                                        <span class="fw-bold" id="cd-hours">00</span> Jam
                                        <span class="fw-bold" id="cd-minutes">00</span> Menit
                                        <span class="fw-bold" id="cd-seconds">00</span> Detik
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="show_all_hasil">
                            <div id="container" style="max-width: 100%; height: 500px; margin: 0 auto; display: flex; justify-content: center; align-item: center;"></div>
                            @if (Auth::check() && Auth::user()->level === 'admin')
                                <div id="container-button" style="margin: 0 auto; text-align: center; margin-top: 10px;">
                                </div>
                            @endif
                            <textarea id="infile" style="display:none;"></textarea>
                        </div>
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        $(document).ready(function() {
            var dataPoints, win;

            // fetch all kandidat ajax request
            fetchAllHasil();

            function fetchAllHasil() {
                $.ajax({
                    url: '{{ route('hasil.fetchAll') }}',
                    method: 'get',
                    success: function(response) {
                        let waktu = response.waktu;
                        if (response.waktu_count && response.jumlah != 0) {
                            timer(waktu[0].waktu_awal, waktu[0].waktu_akhir, response.data);
                            dataPoints = response.grup;
                            win = response.win;
                            console.log(response.win);
                        } else if (response.waktu_count && response.jumlah == 0) {
                            $("#show_all_hasil").html(
                                '<h1 class="text-center text-secondary my-5">Hasil Voting Belum Tersedia!</h1>'
                            );
                            timer(waktu[0].waktu_awal, waktu[0].waktu_akhir, response.jumlah);
                        } else {
                            $("#show_all_hasil").html(
                                '<h1 class="text-center text-secondary my-5">Jadwal Voting Belum Ditentukan!</h1>'
                            );
                            // console.log(response.win);
                        }
                    }
                });
            }

            // timer countdown
            function timer(date_start, date_end, data) {
                $.ajax({
                    url: 'http://worldtimeapi.org/api/timezone/Asia/Jakarta',
                    method: 'get',
                    header: {
                        'Access-Control-Allow-Origin': '*',
                    },
                    success: function(response) {
                        // console.log(response);
                        let now = Math.round(new Date(response.datetime).getTime() / 1000);
                        let start = Math.round(new Date(date_start).getTime() / 1000);
                        let end = Math.round(new Date(date_end).getTime() / 1000);
                        // console.log(now);
                        // console.log(start);
                        let timer, days, hours, minutes, seconds;
                        if (now >= start) {
                            // chart(data);
                            $('#container').highcharts(chart(data));
                            $('#start-end').html('Waktu Berakhir : ');
                            $('#container-button').html(
                                '<button class="btn btn-secondary text-white p-2 export"><i class="bi bi-download"></i> Unduh Hasil</button>'
                            );
                            timer = end - now;
                        } else {
                            $("#show_all_hasil").html(
                                '<h1 class="text-center text-secondary my-5">Voting Belum Dimulai!</h1>'
                            );
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

            function chart(data) {
                var chart = {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                };
                var title = {
                    text: 'Hasil Pemilihan Ketua OSIS SMK Negeri 65 Jakarta, 2022'
                };
                var tooltip = {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                };
                var plotOptions = {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',

                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f}%',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) ||
                                    'black'
                            }
                        }
                    }
                };
                var series = [{
                    type: 'pie',
                    name: 'Jumlah',
                    data: data
                }];

                var exporting = {
                    enabled: false,
                };

                var json = {};
                var json1 = {};
                json.chart = chart;
                json.title = title;
                json.tooltip = tooltip;
                json.series = series;
                json.plotOptions = plotOptions;
                json.exporting = exporting;
                json1.chart = chart;
                json1.title = {
                    text: ''
                };
                json1.tooltip = tooltip;
                json1.series = series;
                json1.plotOptions = plotOptions;
                json1.exporting = exporting;
                $('#infile').val(JSON.stringify(json1));
                return json;
            }

            const blob2base64 = (blob1) => new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onerror = reject;
                reader.onload = () => resolve(reader.result);
                reader.readAsDataURL(blob1);
            });

            // get export hasil ajax request
            $(document).on('click', '.export', async (e) => {
                e.preventDefault();
                // const url = '{{ route('hasil.export') }}';
                // window.location = url;

                // Prepare POST data
                const body = new FormData();
                body.append('infile', document.getElementById('infile').value);
                body.append('width', 600);

                // Post it to the export server
                const blob1 = await fetch('https://export.highcharts.com/', {
                    body,
                    method: 'post',
                    header: {
                        'Access-Control-Allow-Origin': '*',
                    },
                }).then(result => result.blob());

                // Create the image
                const img = new Image();
                img.src = await blob2base64(blob1);
                let gambar = img.src;
                // $('img').attr('src', gambar);
                let csrf = '{{ csrf_token() }}';
                Swal.fire(
                    'Berhasil!',
                    'Tunggu Beberapa Saat.',
                    'success'
                );
                $.ajax({
                    type: "POST",
                    url: '{{ route('hasil.export') }}',
                    data: {
                        gambar: gambar,
                        hasil: dataPoints,
                        win: win,
                        _token: csrf
                    },
                    xhrFields: {
                        responseType: 'blob' // to avoid binary data being mangled on charset conversion
                    },
                    success: function(blob, status, xhr) {
                        // check for a filename
                        var filename = "Hasil-Voting";
                        var disposition = xhr.getResponseHeader('Content-Disposition');
                        if (disposition && disposition.indexOf('attachment') !== -1) {
                            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                            var matches = filenameRegex.exec(disposition);
                            if (matches != null && matches[1]) filename = matches[1]
                                .replace(/['"]/g, '');
                        }

                        if (typeof window.navigator.msSaveBlob !== 'undefined') {
                            // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                            window.navigator.msSaveBlob(blob, filename);
                        } else {
                            var URL = window.URL || window.webkitURL;
                            var downloadUrl = URL.createObjectURL(blob);

                            if (filename) {
                                // use HTML5 a[download] attribute to specify filename
                                var a = document.createElement("a");
                                // safari doesn't support this yet
                                if (typeof a.download === 'undefined') {
                                    window.location.href = downloadUrl;
                                } else {
                                    a.href = downloadUrl;
                                    a.download = filename;
                                    document.body.appendChild(a);
                                    a.click();
                                }
                            } else {
                                window.location.href = downloadUrl;
                            }

                            setTimeout(function() {
                                URL.revokeObjectURL(downloadUrl);
                            }, 100); // cleanup
                        }
                    }
                });
            });

        });
    </script>
@endsection
