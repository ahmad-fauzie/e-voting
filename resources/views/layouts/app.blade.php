<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}" type="image/x-icon">
    
    <script type="application/javascript" src="https://unpkg.com/feather-icons"></script>
    @yield('style')
</head>
<style>
    body {
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-image: linear-gradient(to top, #97d9e1 0%, #82AAE3 100%);
        opacity: .95;
    }
    </style>

<body>
    <div id="app">
        @include('layouts.sidebar')

        <div id="main">
            @include('layouts.navbar')
            @yield('content')
            @include('layouts.footer')
        </div>

        
    </div>
</body>
<script type="application/javascript">feather.replace()</script>
<script type="application/javascript" src="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script type="application/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('script')

</html>
