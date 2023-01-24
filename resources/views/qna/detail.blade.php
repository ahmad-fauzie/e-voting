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
                <h3>QnA</h3>
            </div>
            <div class="col-12 col-md-6">
                <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('qna.index') }}">QnA</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pesan</li>
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
                        <h3 class="text-secondary m-0">Pesan</h3>
                        @if(Auth::check() && Auth::user()->level === 'admin')
                        <button class="btn btn-secondary p-2">
                            <a href="#" class="text-white deleteAll" id="{{ $id }}"><i class="bi-trash"></i><div style="display: contents;" id="icon"> Hapus Semua</div></a>
                        </button>
                        @endif
                    </div>
                    <div class="card-body pb-0">
                        <chat-messages v-on:messagesent="addMessage" v-on:messagedelete="deleteMessage" v-on:messagegroupdelete="deleteMessageGroup" :kandidat="{{ $id }}" :messages="messages" :user="{{ Auth::user() }}"></chat-messages>
                    </div>
                    <div class="card-footer p-3 p-md-4 pt-0 pt-md-0">
                        <chat-form v-on:messagesent="addMessage" :kandidat="{{ $id }}" :messages="messages" :user="{{ Auth::user() }}"></chat-form>
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
    <script type="application/javascript">
        $(function() {
            var e = window.innerWidth;
            if(e < 915){
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

            $(document).on('click', '.deleteAll', function(e) {
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
                            url: '{{ route('messages.deleteAll') }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                if(response.status == 200) {
                                    toastMixin.fire({
                                        title: 'Data Berhasil Dihapus.',
                                        icon: 'success'
                                    });
                                }
                            }
                        });
                    }
                })
            });
        })
    </script>
@endsection