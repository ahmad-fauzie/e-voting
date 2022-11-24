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
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
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
            <h3 class="text-end" style="font-weight: normal; font-style: italic;">Jakarta{{ $tanggal }}</h3>
            <h3 style="font-weight: normal; margin-left: 15px;">
                <pre>Jumlah Seluruh Siswa  : {{ $siswa->count() }}</pre>
            </h3>
            <h3 style="font-weight: normal; margin-left: 15px;">
                <pre>Siswa Yang Memilih    : {{ $vote }}</pre>
            </h3>
            <h3 style="font-weight: normal; margin-left: 15px; margin-bottom: 0px;">
                <pre>Siswa Tidak Memilih   : {{ $notVote }}</pre>
            </h3>
            <img src="{{ $gambar }}" style="max-width: 100%; margin: 0 auto; margin-bottom: 10px;" />
            {{-- <div class="table-responsive" style="max-width: 80%; margin: 0 auto; margin-top: 10px;"> --}}
            <table class="table table-bordered border-dark" style="max-width: 80%; margin: 0 auto; margin: 15px;">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Nama</th>
                        <th class="text-center">Jumlah Pemilih</th>
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach ($hasils as $hasil)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $hasil['name'] }}</td>
                            <td class="text-center">{{ $hasil['total_usage'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
{{-- <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}

</html>
