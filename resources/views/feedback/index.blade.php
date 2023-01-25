@extends('layouts.app')

@section('title', 'Feedback')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.0.7/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    
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
                                <p>Mohon jawab pertanyaan di bawah ini dengan sejujurnya dan sesuai apa adanya. Terima Kasih.</p>
                            </div>
                            <ol style="color: #000;">
                                <li>Bagaimana pendapatmu mengenai halaman Login dan proses login?</li>
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <div class="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="login" id="login1">
                                            <label class="form-check-label" for="login1">
                                                Sangat Baik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="login" id="login2">
                                            <label class="form-check-label" for="login2">
                                                Baik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="login" id="login3" checked>
                                            <label class="form-check-label" for="login3">
                                                Cukup
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="login" id="login4">
                                            <label class="form-check-label" for="login4">
                                                Buruk
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="login" id="login5">
                                            <label class="form-check-label" for="login5">
                                                Sangat Buruk
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <li>Bagaimana pendapatmu mengenai halaman Daftar dan proses daftar?</li>
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <div class="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="daftar" id="daftar1">
                                            <label class="form-check-label" for="daftar1">
                                                Sangat Baik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="daftar" id="daftar2">
                                            <label class="form-check-label" for="daftar2">
                                                Baik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="daftar" id="daftar3" checked>
                                            <label class="form-check-label" for="daftar3">
                                                Cukup
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="daftar" id="daftar4">
                                            <label class="form-check-label" for="daftar4">
                                                Buruk
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="daftar" id="daftar5">
                                            <label class="form-check-label" for="daftar5">
                                                Sangat Buruk
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <li>Bagaimana pendapatmu mengenai halaman Dashboard?</li>
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <div class="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dashboard" id="dashboard1">
                                            <label class="form-check-label" for="dashboard1">
                                                Sangat Baik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dashboard" id="dashboard2">
                                            <label class="form-check-label" for="dashboard2">
                                                Baik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dashboard" id="dashboard3" checked>
                                            <label class="form-check-label" for="dashboard3">
                                                Cukup
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dashboard" id="dashboard4">
                                            <label class="form-check-label" for="dashboard4">
                                                Buruk
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dashboard" id="dashboard5">
                                            <label class="form-check-label" for="dashboard5">
                                                Sangat Buruk
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <li>Bagaimana pendapatmu mengenai halaman Voting dan proses voting?</li>
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <div class="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="voting" id="voting1">
                                            <label class="form-check-label" for="voting1">
                                                Sangat Baik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="voting" id="voting2">
                                            <label class="form-check-label" for="voting2">
                                                Baik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="voting" id="voting3" checked>
                                            <label class="form-check-label" for="voting3">
                                                Cukup
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="voting" id="voting4">
                                            <label class="form-check-label" for="voting4">
                                                Buruk
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="voting" id="voting5">
                                            <label class="form-check-label" for="voting5">
                                                Sangat Buruk
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <li>Bagaimana pendapatmu mengenai halaman QnA/Diskusi dan proses diskusi?</li>
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <div class="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="qna" id="qna1">
                                            <label class="form-check-label" for="qna1">
                                                Sangat Baik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="qna" id="qna2">
                                            <label class="form-check-label" for="qna2">
                                                Baik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="qna" id="qna3" checked>
                                            <label class="form-check-label" for="qna3">
                                                Cukup
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="qna" id="qna4">
                                            <label class="form-check-label" for="qna4">
                                                Buruk
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="qna" id="qna5">
                                            <label class="form-check-label" for="qna5">
                                                Sangat Buruk
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <li>Bagaimana pendapatmu mengenai halaman Hasil?</li>
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <div class="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hasil" id="hasil1">
                                            <label class="form-check-label" for="hasil1">
                                                Sangat Baik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hasil" id="hasil2">
                                            <label class="form-check-label" for="hasil2">
                                                Baik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hasil" id="hasil3" checked>
                                            <label class="form-check-label" for="hasil3">
                                                Cukup
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hasil" id="hasil4">
                                            <label class="form-check-label" for="hasil4">
                                                Buruk
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hasil" id="hasil5">
                                            <label class="form-check-label" for="hasil5">
                                                Sangat Buruk
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <li>Mohon berikan rating dan masukanmu secara keseluruhan aplikasi E-Voting ini!</li>
                                <form action="#basic-example-9" method="post">
                                    <input id="input-9" name="input-9" required class="rating-loading">
                                    <hr>
                                    <button type="submit" class="btn btn-primary">Submit</button>&nbsp;
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </form>
                                <div class="form-group mb-3">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Tulis pendapatmu disini ..."></textarea>
                                </div>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.0.7/js/star-rating.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#input-9').rating();
        });
    </script>
@endsection