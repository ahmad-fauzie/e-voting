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
                <h2>Reset Password</h2>
                <p>Reset password disini dengan email kamu</p>
            </header>
            <br>

            <div class="field-set">
                <form action="{{ route('forget.password.post') }}" method="POST" id="logForm">
                    @csrf
                    @if (Session::has('message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <span class="alert-inner-text">
                                {{ Session::get('message') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($errors->has('email'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <span class="alert-inner-text">
                                {{ $errors->first('email') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="input-group mb-3">
                        <span class="input-item">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control" id="email_address" name="email" placeholder="Email" style="height: auto;"
                            required autofocus>
                    </div>
                    <button class="btn log-in bg-white" type="submit">Kirim</button>

                    <div class="other">
                        <a href="{{ url('/') }}" class="btn submits sign-up"><i class="fa fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
