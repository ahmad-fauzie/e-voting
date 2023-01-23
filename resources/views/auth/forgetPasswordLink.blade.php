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
                <p>Reset password kamu dengan yang baru</p>
            </header>
            <br>

            <div class="field-set">
                <form action="{{ route('reset.password.post') }}" method="POST" id="logForm">
                    @csrf
                    @if (Session::has('error') || $errors->has('email') || $errors->has('password'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <span class="alert-inner-text">
                                <ul style="list-style: none; margin: 0px">
                                    @if(Session::has('error'))<li>{{ Session::get('error') }}</li>@endif
                                    @if($errors->has('email'))<li>{{ $errors->first('email') }}</li>@endif
                                    @if($errors->has('password'))<li>{{ $errors->first('password') }}</li>@endif
                                    @if($errors->has('password_confirmation'))<li>{{ $errors->first('password_confirmation') }}</li>@endif
                                </ul>
                            </span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-group mb-3">
                        <span class="input-item">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control" id="email_address" name="email" placeholder="Email" style="height: auto;"
                            required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-item">
                            <i class="fa fa-key"></i>
                        </span>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password Baru" style="height: auto;" required>
                        <span class="input-group-text">
                            <i class="fa fa-eye" aria-hidden="true" type="button" id="eye1"></i>
                        </span>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-item">
                            <i class="fa fa-key"></i>
                        </span>
                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation"
                            placeholder="Konfirmasi Password Baru" style="height: auto;" required>
                        <span class="input-group-text">
                            <i class="fa fa-eye" aria-hidden="true" type="button" id="eye2"></i>
                        </span>
                    </div>
                    <button class="btn log-in bg-white" type="submit">Reset Password</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/reset.js') }}" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
