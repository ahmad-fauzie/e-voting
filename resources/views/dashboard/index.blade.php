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
                            <div class="row">
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
                                                        <p class="card-text text-ellipsis">Vote : {{ $vote }}</p>
                                                        <p class="card-text text-ellipsis">Belum Vote : {{ $notVote }}
                                                        </p>
                                                        <p class="card-text text-ellipsis">Keseluruhan : {{ $jumlah }}
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
                                    <div class="col-md-4 col-sm-12">
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
                                                        {{-- <p class="mb-25"><small>Last updated 3 mins ago</small></p> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                        <a href="{{ route('kandidat.index') }}" class="btn btn-outline-white btn-sm">Lihat
                                                            Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (Auth::check() && Auth::user()->level === 'siswa')
                                <div class="col-md-12 col-sm-12">
                                    <div class="card" style="text-align: center;">
                                        <div class="card-content">
                                            <img class="card-img img-fluid" src="{{ asset('images/depan-smk-65.png') }}"
                                                alt="Card image">
                                            <div
                                                class="card-img-overlay overlay-dark bg-overlay d-flex justify-content-between flex-column overflow-auto">
                                                <div class="overlay-content">
                                                    <h2 class="card-title mb-5 fs-2">Pemberitahuan</h2>
                                                    <p class="card-text text-ellipsis fs-3">Lorem ipsum dolor sit amet,
                                                        consectetur adipisicing elit. Sapiente facere vitae hic tempore
                                                        dicta expedita veritatis, dolorum earum iure tempora perferendis
                                                        repudiandae. Sunt alias numquam ducimus ea laborum aperiam harum.
                                                    </p>
                                                </div>
                                                <div class="overlay-status">
                                                    {{-- <p class="mb-25"><small>Last updated 3 mins ago</small></p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
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
    <script src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
