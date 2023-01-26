@extends('layouts.app')

@section('title', 'Feedback')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }
    </style>
@endsection
@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h3>Feedback</h3>
                </div>
                <div class="col-12 col-md-6">
                    <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Feedback</li>
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
                            <h3 class="text-secondary">Masukan</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <h4 class="alert-heading">Catatan</h4>
                                <p>Mohon jawab pertanyaan di bawah ini dengan sejujurnya dan sesuai apa adanya. Terima
                                    Kasih.</p>
                            </div>
                            <ol style="color: #000;">
                                <form action="{{ route('feedback.store') }}" id="add_feedack_form" method="post">
                                    @csrf
                                    <li>Bagaimana pendapatmu mengenai halaman Login dan proses login?</li>
                                    <div class="d-flex justify-content-start align-items-center mb-4 ms-3">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="login" value="Sangat Baik"
                                                    id="login1">
                                                <label class="form-check-label" for="login1">
                                                    Sangat Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="login" value="Baik"
                                                    id="login2">
                                                <label class="form-check-label" for="login2">
                                                    Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="login" id="login3" value="Cukup"
                                                    checked>
                                                <label class="form-check-label" for="login3">
                                                    Cukup
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="login" value="Buruk"
                                                    id="login4">
                                                <label class="form-check-label" for="login4">
                                                    Buruk
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="login" value="Sangat Buruk"
                                                    id="login5">
                                                <label class="form-check-label" for="login5">
                                                    Sangat Buruk
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    @if(Auth::check() && Auth::user()->level === 'siswa')
                                    <li>Bagaimana pendapatmu mengenai halaman Daftar dan proses daftar?</li>
                                    <div class="d-flex justify-content-start align-items-center mb-4 ms-3">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="daftar" value="Sangat Baik"
                                                    id="daftar1">
                                                <label class="form-check-label" for="daftar1">
                                                    Sangat Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="daftar" value="Baik"
                                                    id="daftar2">
                                                <label class="form-check-label" for="daftar2">
                                                    Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="daftar" id="daftar3" value="Cukup"
                                                    checked>
                                                <label class="form-check-label" for="daftar3">
                                                    Cukup
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="daftar" value="Buruk"
                                                    id="daftar4">
                                                <label class="form-check-label" for="daftar4">
                                                    Buruk
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="daftar" value="Sangat Buruk"
                                                    id="daftar5">
                                                <label class="form-check-label" for="daftar5">
                                                    Sangat Buruk
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <li>Bagaimana pendapatmu mengenai halaman Reset Password dan proses reset?</li>
                                    <div class="d-flex justify-content-start align-items-center mb-4 ms-3">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reset" value="Sangat Baik"
                                                    id="reset1">
                                                <label class="form-check-label" for="reset1">
                                                    Sangat Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reset" value="Baik"
                                                    id="reset2">
                                                <label class="form-check-label" for="reset2">
                                                    Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reset" id="reset3" value="Cukup"
                                                    checked>
                                                <label class="form-check-label" for="reset3">
                                                    Cukup
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reset" value="Buruk"
                                                    id="reset4">
                                                <label class="form-check-label" for="reset4">
                                                    Buruk
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reset" value="Sangat Buruk"
                                                    id="reset5">
                                                <label class="form-check-label" for="reset5">
                                                    Sangat Buruk
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <li>Bagaimana pendapatmu mengenai halaman Dashboard?</li>
                                    <div class="d-flex justify-content-start align-items-center mb-4 ms-3">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="dashboard" value="Sangat Baik"
                                                    id="dashboard1">
                                                <label class="form-check-label" for="dashboard1">
                                                    Sangat Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="dashboard" value="Baik"
                                                    id="dashboard2">
                                                <label class="form-check-label" for="dashboard2">
                                                    Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="dashboard" value="Cukup"
                                                    id="dashboard3" checked>
                                                <label class="form-check-label" for="dashboard3">
                                                    Cukup
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="dashboard" value="Buruk"
                                                    id="dashboard4">
                                                <label class="form-check-label" for="dashboard4">
                                                    Buruk
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="dashboard" value="Sangat Buruk"
                                                    id="dashboard5">
                                                <label class="form-check-label" for="dashboard5">
                                                    Sangat Buruk
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if(Auth::check() && Auth::user()->level === 'admin')
                                    <li>Bagaimana pendapatmu mengenai halaman Master Siswa dan proses mengelola data siswa?</li>
                                    <div class="d-flex justify-content-start align-items-center mb-4 ms-3">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="siswa" value="Sangat Baik"
                                                    id="siswa1">
                                                <label class="form-check-label" for="siswa1">
                                                    Sangat Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="siswa" value="Baik"
                                                    id="siswa2">
                                                <label class="form-check-label" for="siswa2">
                                                    Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="siswa" value="Cukup"
                                                    id="siswa3" checked>
                                                <label class="form-check-label" for="siswa3">
                                                    Cukup
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="siswa" value="Buruk"
                                                    id="siswa4">
                                                <label class="form-check-label" for="siswa4">
                                                    Buruk
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="siswa" value="Sangat Buruk"
                                                    id="siswa5">
                                                <label class="form-check-label" for="siswa5">
                                                    Sangat Buruk
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <li>Bagaimana pendapatmu mengenai halaman Master kandidat dan proses mengelola data kandidat?</li>
                                    <div class="d-flex justify-content-start align-items-center mb-4 ms-3">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kandidat" value="Sangat Baik"
                                                    id="kandidat1">
                                                <label class="form-check-label" for="kandidat1">
                                                    Sangat Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kandidat" value="Baik"
                                                    id="kandidat2">
                                                <label class="form-check-label" for="kandidat2">
                                                    Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kandidat" value="Cukup"
                                                    id="kandidat3" checked>
                                                <label class="form-check-label" for="kandidat3">
                                                    Cukup
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kandidat" value="Buruk"
                                                    id="kandidat4">
                                                <label class="form-check-label" for="kandidat4">
                                                    Buruk
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kandidat" value="Sangat Buruk"
                                                    id="kandidat5">
                                                <label class="form-check-label" for="kandidat5">
                                                    Sangat Buruk
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if(Auth::check() && Auth::user()->level === 'siswa')
                                    <li>Bagaimana pendapatmu mengenai halaman Voting dan proses voting?</li>
                                    <div class="d-flex justify-content-start align-items-center mb-4 ms-3">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="voting" value="Sangat Baik"
                                                    id="voting1">
                                                <label class="form-check-label" for="voting1">
                                                    Sangat Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="voting" value="Baik"
                                                    id="voting2">
                                                <label class="form-check-label" for="voting2">
                                                    Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="voting" value="Cukup"
                                                    id="voting3" checked>
                                                <label class="form-check-label" for="voting3">
                                                    Cukup
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="voting" value="Buruk"
                                                    id="voting4">
                                                <label class="form-check-label" for="voting4">
                                                    Buruk
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="voting" value="Sangat Buruk"
                                                    id="voting5">
                                                <label class="form-check-label" for="voting5">
                                                    Sangat Buruk
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <li>Bagaimana pendapatmu mengenai halaman QnA/Diskusi dan proses diskusi?</li>
                                    <div class="d-flex justify-content-start align-items-center mb-4 ms-3">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="qna" value="Sangat Baik"
                                                    id="qna1">
                                                <label class="form-check-label" for="qna1">
                                                    Sangat Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="qna" value="Baik"
                                                    id="qna2">
                                                <label class="form-check-label" for="qna2">
                                                    Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="qna" value="Cukup"
                                                    id="qna3" checked>
                                                <label class="form-check-label" for="qna3">
                                                    Cukup
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="qna" value="Buruk"
                                                    id="qna4">
                                                <label class="form-check-label" for="qna4">
                                                    Buruk
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="qna" value="Sangat Buruk"
                                                    id="qna5">
                                                <label class="form-check-label" for="qna5">
                                                    Sangat Buruk
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    @if(Auth::check() && Auth::user()->level === 'admin')
                                    <li>Bagaimana pendapatmu mengenai halaman Hasil dan proses mengunduh dokumen hasil voting?</li>
                                    @endif
                                    @if(Auth::check() && Auth::user()->level === 'siswa')
                                    <li>Bagaimana pendapatmu mengenai halaman Hasil?</li>
                                    @endif
                                    <div class="d-flex justify-content-start align-items-center mb-4 ms-3">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="hasil" value="Sangat Baik"
                                                    id="hasil1">
                                                <label class="form-check-label" for="hasil1">
                                                    Sangat Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="hasil" value="Baik"
                                                    id="hasil2">
                                                <label class="form-check-label" for="hasil2">
                                                    Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="hasil" value="Cukup"
                                                    id="hasil3" checked>
                                                <label class="form-check-label" for="hasil3">
                                                    Cukup
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="hasil" value="Buruk"
                                                    id="hasil4">
                                                <label class="form-check-label" for="hasil4">
                                                    Buruk
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="hasil" value="Sangat Buruk"
                                                    id="hasil5">
                                                <label class="form-check-label" for="hasil5">
                                                    Sangat Buruk
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    @if(Auth::check() && Auth::user()->level === 'admin')
                                    <li>Bagaimana pendapatmu mengenai halaman Jadwal Voting dan proses penjadwalan?</li>
                                    <div class="d-flex justify-content-start align-items-center mb-4 ms-3">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jadwal" value="Sangat Baik"
                                                    id="jadwal1">
                                                <label class="form-check-label" for="jadwal1">
                                                    Sangat Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jadwal" value="Baik"
                                                    id="jadwal2">
                                                <label class="form-check-label" for="jadwal2">
                                                    Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jadwal" value="Cukup"
                                                    id="jadwal3" checked>
                                                <label class="form-check-label" for="jadwal3">
                                                    Cukup
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jadwal" value="Buruk"
                                                    id="jadwal4">
                                                <label class="form-check-label" for="jadwal4">
                                                    Buruk
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jadwal" value="Sangat Buruk"
                                                    id="jadwal5">
                                                <label class="form-check-label" for="jadwal5">
                                                    Sangat Buruk
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <li>Bagaimana pendapatmu mengenai halaman Profile dan proses perubahan profile?</li>
                                    <div class="d-flex justify-content-start align-items-center mb-4 ms-3">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profile" value="Sangat Baik"
                                                    id="profile1">
                                                <label class="form-check-label" for="profile1">
                                                    Sangat Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profile" value="Baik"
                                                    id="profile2">
                                                <label class="form-check-label" for="profile2">
                                                    Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profile" value="Cukup"
                                                    id="profile3" checked>
                                                <label class="form-check-label" for="profile3">
                                                    Cukup
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profile" value="Buruk"
                                                    id="profile4">
                                                <label class="form-check-label" for="profile4">
                                                    Buruk
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="profile" value="Sangat Buruk"
                                                    id="profile5">
                                                <label class="form-check-label" for="profile5">
                                                    Sangat Buruk
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <li>Mohon berikan rating dan masukanmu secara keseluruhan aplikasi E-Voting ini!</li>
                                    <div class="rate">
                                        <input type="radio" id="star5" class="rate" name="rating"
                                            value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" class="rate" name="rating"
                                            value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" checked id="star3" class="rate" name="rating"
                                            value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" class="rate" name="rating"
                                            value="2">
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" class="rate" name="rating"
                                            value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                    <div class="form-group mb-3">
                                        <textarea class="form-control" id="feedback" rows="3" name="feedback"
                                            placeholder="Tulis pendapatmu disini ..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary ml-1" id="add_feedack_btn"
                                        style="padding: 0.5rem 1.5rem;">
                                        <span>Submit</span>
                                    </button>
                                </form>
                            </ol>
                            <div id="show_feedback">

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
            var e = window.innerWidth;
            if (e < 768) {
                var buttons = document.querySelectorAll('[id=icon]');
                buttons.forEach(function(button) {
                    button.style.display = "none";
                });
            }

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

            $("#add_feedack_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_feedback_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('feedback.store') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            toastMixin.fire({
                                title: 'Feedback Berhasil Ditambahkan!',
                                icon: 'success'
                            });
                            Swal.fire(
                                'Berhasil!',
                                response.message,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Gagal!',
                                response.message,
                                'error'
                            )
                        }
                        fetchAllFeedback();
                        $("#add_feedback_btn").text('Simpan');
                    }
                });
            });

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
                            url: '{{ route('feedback.delete') }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                toastMixin.fire({
                                    title: 'Feedback Berhasil Dihapus.',
                                    icon: 'success'
                                });
                                fetchAllFeedback();
                            }
                        });
                    }
                })
            });

            fetchAllFeedback();

            function fetchAllFeedback() {
                $.ajax({
                    url: '{{ route('feedback.fetchAll') }}',
                    method: 'get',
                    success: function(response) {
                        $("#show_feedback").html(response.data);
                    }
                });
            }

        });
    </script>
@endsection
