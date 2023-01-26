@extends('layouts.app')

@section('title', 'Dashboard')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' /> --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
@endsection

@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <h3>Dashboard</h3>
            {{-- <p class="text-subtitle text-muted">A good dashboard to display your statistics</p> --}}
        </div>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded mt-3 mb-5">
                        <div class="card-body" id="show_all_kandidat">
                            <div class="row justify-content-around">
                                @if (Auth::check() && Auth::user()->level === 'admin')
                                    <div class="col-md-4 col-sm-12">
                                        <div class="card">
                                            <div class="card-content">
                                                <img class="card-img img-fluid" src="{{ asset('images/siswa-biru.png') }}"
                                                    alt="Card image">
                                                <div
                                                    class="card-img-overlay overlay-dark bg-overlay d-flex justify-content-between flex-column overflow-auto">
                                                    <div class="overlay-content">
                                                        <h4 class="card-title mb-50">Siswa</h4>
                                                        <p class="card-text text-ellipsis mb-0">Vote : {{ $vote }}
                                                        </p>
                                                        <p class="card-text text-ellipsis mb-0">Belum Vote :
                                                            {{ $notVote }}
                                                        </p>
                                                        <p class="card-text text-ellipsis mb-0">Keseluruhan :
                                                            {{ $jumlah }}
                                                        </p>
                                                    </div>
                                                    <div class="overlay-status">
                                                        {{-- <p class="mb-25"><small>Last updated 3 mins ago</small></p> --}}
                                                        <a href="{{ route('siswa.index') }}"
                                                            class="btn btn-outline-white btn-sm">Lihat Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4 col-sm-12">
                                        <div class="card">
                                            <div class="card-content">
                                                <img class="card-img img-fluid" src="{{ asset('images/depan-smk-65.png') }}"
                                                    alt="Card image">
                                                <div
                                                    class="card-img-overlay overlay-dark bg-overlay d-flex justify-content-between flex-column overflow-auto">
                                                    <div class="overlay-content">
                                                        <h4 class="card-title mb-50">Pemberitahuan</h4>
                                                        <p class="card-text text-ellipsis">Lorem ipsum dolor sit amet,
                                                            consectetur adipisicing elit. Saepe quos optio vitae, in
                                                            deleniti ipsa, animi, at ullam distinctio eum nobis corrupti
                                                            blanditiis laudantium harum quae. Sapiente nihil autem dolorem.
                                                        </p>
                                                    </div>
                                                    <div class="overlay-status">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4 col-sm-12">
                                        <div class="card">
                                            <div class="card-content">
                                                <img class="card-img img-fluid" src="{{ asset('images/kandidat.png') }}"
                                                    alt="Card image">
                                                <div
                                                    class="card-img-overlay overlay-dark bg-overlay d-flex justify-content-between flex-column overflow-auto">
                                                    <div class="overlay-content">
                                                        <h4 class="card-title mb-50">Kandidat</h4>
                                                        <p class="card-text text-ellipsis">Keseluruhan : {{ $kandidat }}
                                                        </p>
                                                    </div>
                                                    <div class="overlay-status text-right">
                                                        {{-- <p class="mb-25"><small>Last updated 3 mins ago</small></p> --}}
                                                        <a href="{{ route('kandidat.index') }}"
                                                            class="btn btn-outline-white btn-sm">Lihat
                                                            Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (Auth::check() && Auth::user()->level === 'siswa')
                                    <div class="col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-content">
                                                <img class="card-img img-fluid" src="{{ asset('images/depan-smk-65.png') }}"
                                                    alt="Card image">
                                                <div
                                                    class="card-img-overlay overlay-dark bg-overlay d-flex justify-content-between flex-column overflow-auto">
                                                    <div class="overlay-content d-sm-none">
                                                        <h2 class="card-title mb-2 fs-5">Hai {{ Auth::user()->name }}</h2>
                                                        <p class="card-text text-ellipsis fs-6">
                                                            Selamat Datang Di Aplikasi E-Voting Pemilihan Ketua OSIS SMK
                                                            Negeri 65 Jakarta. Disini Kamu dapat memilih kandidat yang
                                                            tersedia pada menu <strong><a class="text-white"
                                                                    href="{{ route('voting.index') }}">Voting</a></strong>.
                                                            Aplikasi ini juga
                                                            menyediakan fitur <strong><a class="text-white"
                                                                href="{{ route('qna.index') }}">Diskusi</a></strong> yang dapat kamu manfaatkan.
                                                        </p>
                                                    </div>
                                                    <div class="overlay-content d-none d-sm-block">
                                                        <h2 class="card-title mb-3 fs-2">Hai {{ Auth::user()->name }}</h2>
                                                        <p class="card-text text-ellipsis fs-3">
                                                            Selamat Datang Di Aplikasi E-Voting Pemilihan Ketua OSIS SMK
                                                            Negeri 65 Jakarta. Disini Kamu dapat memilih kandidat yang
                                                            tersedia pada menu <strong><a class="text-white"
                                                                    href="{{ route('voting.index') }}">Voting</a></strong>.
                                                            Aplikasi ini juga
                                                            menyediakan fitur <strong><a class="text-white"
                                                                href="{{ route('qna.index') }}">Diskusi</a></strong> yang dapat kamu manfaatkan.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script type="application/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script type="application/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script type="application/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
