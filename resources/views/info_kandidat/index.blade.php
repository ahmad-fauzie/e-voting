@extends('layouts.app')

@section('title', 'Informasi Kandidat')
@section('style')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')
{{-- <div class="container"> --}}
        {{-- @error('foto')
            <div class="alert alert-success mt-5">
                {{ $message }}
            </div>
        @enderror --}}
        <div class="row">
            <div class="col-md-12">

                <div class="card border-0 shadow rounded mt-3 mb-5">
                    <div class="card-header">
                        <h5 class="">INFORMASI KANDIDAT</h5>
                    </div>
                    <div class="card-body">

                        
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Recipient's username"
                aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">@example.com</span>
        </div>

        <label for="basic-url" class="form-label">Your vanity URL</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
            <span class="input-group-text">.00</span>
        </div>

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" aria-label="Username">
            <span class="input-group-text">@</span>
            <input type="text" class="form-control" placeholder="Server" aria-label="Server">
        </div>

        <div class="input-group">
            <span class="input-group-text">With textarea</span>
            <textarea class="form-control" aria-label="With textarea"></textarea>
        </div> --}}
    {{-- </div> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if  (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endsection
