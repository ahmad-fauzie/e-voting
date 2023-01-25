@extends('layouts.app')

@section('title', 'QnA')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
@endsection
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6">
                <h3>Question and Answer</h3>
            </div>
            <div class="col-12 col-md-6">
                <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">QnA</li>
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
                        <h3 class="text-secondary">Discussion</h3>
                    </div>
                    <div class="card-body">
                        @if(count($kandidats) > 0)
                            <div class="row">
                                @php
                                    $no=0;
                                @endphp
                                @foreach($kandidats as $kandidat)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-content bg-info p-3 text-center">
                                            <h4 class="card-title mb-2 text-white">{{ ++$no }}</h4>
                                            <h6 class="card-subtitle text-white">{{ $kandidat['name'] }}</h6>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between">
                                                <div class="avatar avatar-lg me-3">
                                                    <img src="storage/kandidats/{{ $kandidat['foto'] }}" alt="" srcset="">
                                                </div>
                                            <button id="{{ $kandidat['id'] }}" class="btn btn-success chatKandidat h5 text-white m-0 px-3 py-0" style="border-radius: 50%; box-shadow: 0 2px 6px 0 rgba(0,0,0,.3);">
                                                <i class="bi bi-chat-dots-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <h1 class="text-center text-secondary my-5">Data Kandidat Tidak Tersedia!</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
    <script type="application/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script type="application/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </script>
    <script type="application/javascript">
        $(function() {
            var toastMixin = Swal.mixin({
                toast: true,
                icon: 'success',
                title: 'General Title',
                animation: false,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            $(document).on('click', '.chatKandidat', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: `chat/${id}`,
                    method: 'get',
                    success: function(response) {
                        Swal.fire(
                            'Memuat!',
                            'Pesan Sedang Dimuat.',
                            'info'
                        )
                        setTimeout(function() {
                            window.location = `chat/${id}`;
                        }, 2000);
                    }
                });
            });
        });
    </script>
@endsection