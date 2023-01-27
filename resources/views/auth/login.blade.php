<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
    <script src="https://kit.fontawesome.com/e3dfa6f57a.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="card px-md-5">
            <header class="head-form">
                <h2>Login</h2>
                <p>Login disini menggunakan email sekolah dan password</p>
            </header>
            <br>

            <div class="field-set">
                <form action="{{ url('proses_login') }}" method="POST" id="logForm">
                    @csrf
                    @error('login_gagal')
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
                            <i class="fa fa-user-circle"></i>
                        </span>
                        <input type="text" class="form-control" id="txt-input" name="email" placeholder="Email/NIS"
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
                    <button class="btn log-in bg-white" type="submit">Login</button>
                    
                    {{-- <hr> --}}
                    {{-- <div class="input-group mb-3"> --}}
                        <h6 class="card-title text-center mb-4">Hasil Voting Sementara Cek <a class="text-dark" href="{{ route('hasil.index') }}"><strong>Disini</strong></a></h6>
                    {{-- <hr> --}}
                    {{-- </div> --}}

                    <div class="other">
                        <a href="{{ route('forget.password.get') }}" class="btn submits frgt-pass">Lupa Password</a>
                        <a href="{{ url('daftar') }}" class="btn submits sign-up">Daftar <i class="fa fa-user-plus"
                                aria-hidden="true"></i></a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/login.js') }}" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
