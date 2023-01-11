<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script> --}}
    <script src="https://kit.fontawesome.com/e3dfa6f57a.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="card px-md-5">
            <header class="head-form">
                <h2>Daftar</h2>
                <p>Daftar disini menggunakan email dan nis sekolah</p>
            </header>
            <br>

            <div class="field-set">
                <form action="{{ url('proses_register') }}" method="POST" id="logForm">
                    @csrf
                    @error('register_gagal')
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <span class="alert-inner-text">
                                {{ $message }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-item">
                            <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" id="txt-input" name="nama" placeholder="Nama"
                            required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-item">
                            <i class="fa fa-id-card"></i>
                        </span>
                        <input type="text" class="form-control" id="txt-input" name="nis" placeholder="NIS"
                            required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-item">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control" id="txt-input" name="email" placeholder="Email"
                            required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-item">
                            <i class="fa fa-key"></i>
                        </span>
                        <input type="password" class="form-control" id="pwd" name="password"
                            placeholder="Password" required>
                        <span class="input-group-text">
                            <i class="fa fa-eye" aria-hidden="true" type="button" id="eye"></i>
                        </span>
                    </div>
                    <button class="btn log-in bg-white" type="submit">Daftar</button>

                    <div class="other">
                        <a href="{{ url('/') }}" class="btn submits sign-up"><i class="fa fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/login.js') }}" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
</body>
</html>
