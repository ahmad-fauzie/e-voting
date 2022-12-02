<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}" type="image/x-icon">

    @yield('style')
</head>

<body>
    <div id="app">
        @include('layouts.sidebar')

        <div id="main">
            @include('layouts.navbar')
            @yield('content')
            @include('layouts.footer')
        </div>


        <script src="https://unpkg.com/feather-icons"></script>
        <script src="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <script src="{{ asset('js/main.js') }}"></script>
        @yield('script')
    </div>
</body>

</html>
