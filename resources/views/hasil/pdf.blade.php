<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
</head>
<style type="text/css">
    @page {
        margin: 0;
    }

    html {
        margin: 40px 50px;
    }

    h2 {
        text-align: center;
        font-size: 22px;
        margin-bottom: 15px;
    }

    body {
        /* background:#f2f2f2; */
        /* background: #fff; */
    }

    .container {
        max-width: 95%;
        margin-top: 0px;
        padding: 0px;
    }

    .table-custom{
        padding-inline: 8rem;
    }

    .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        width: 100%;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        border: 1px solid #5a8dee;
    }

    .styled-table thead tr {
        background-color: #5a8dee;
        color: #ffffff;
        text-align: left;
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #5a8dee;
    }

    #chart{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .pdf-btn {
        margin-top: 30px;
    }
</style>

<body>
    <div class="container">
        <div class="panel-heading">
            <img src="storage/kop-65.png"
                style="max-width: 100%; margin: 0 auto; padding: 0 auto; margin-bottom: 10px;">
        </div>
        <div class="panel-body">
            <h2>Hasil Pemilihan Ketua OSIS SMK Negeri 65 Jakarta {{ $tahun }}</h2>
            <h3 class="text-end" style="font-weight: normal; font-style: italic; margin-bottom: 3rem;">Jakarta{{ $tanggal }}</h3>
            <h3 style="font-weight: normal; margin-left: 15px; margin-bottom: 0.5rem;">
                <pre style="margin-bottom: 0px;">Jumlah Seluruh Siswa  : {{ $siswa->count() }}</pre>
            </h3>
            <h3 style="font-weight: normal; margin-left: 15px; margin-bottom: 0.5rem;">
                <pre style="margin-bottom:0px;">Siswa Yang Memilih    : {{ $vote }}</pre>
            </h3>
            <h3 style="font-weight: normal; margin-left: 15px;">
                <pre style="margin-bottom:0px;">Siswa Tidak Memilih   : {{ $notVote }}</pre>
            </h3>
            {{-- <div id="chart"> --}}
                {{-- <img src="{{ $gambar }}" style="width: 100%; margin-bottom: 10px;" /> --}}
            {{-- </div> --}}
            {{-- <div class="table-responsive" style="max-width: 80%; margin: 0 auto; margin-top: 10px;"> --}}
            <div class="table-custom">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Jumlah Pemilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach ($hasils as $hasil)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $hasil['name'] }}</td>
                                <td class="text-center">{{ $hasil['kelas'] }} <span style="text-transform:uppercase">{{ $hasil['jurusan'] }}</span></td>
                                <td class="text-center">{{ $hasil['total_usage'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- </div> --}}
            <h3 style="font-weight: normal; margin-left: 15px;">
                <p style="text-indent: 50px; line-height: 1.5; margin-left: 15px;">Berdasarkan Hasil Pemilihan Ketua OSIS SMK Negeri 65 Jakarta tahun {{ $tahun }} dengan ini menyatakan bahwa <b>{{ $win }}</b> terpilih sebagai Ketua OSIS periode {{ $tahun }}/{{ $tahun+1 }}.</p>
            </h3>

        </div>
    </div>
</body>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</html>
