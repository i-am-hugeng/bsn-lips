<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LIPS | @yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/favicon.ico') }}">

    <!-- Font Family -->
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" type="text/css" />

    <!-- Bootstrap -->
    {{-- <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- CSS Extention -->
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed dark-mode text-sm">
    <div class="wrapper">
        {{-- Navbar --}}
        @include('components.navbar')

        {{-- Content --}}
        <div class="content-wrapper">

            @yield('content')

        </div>

        {{-- Footer --}}
        @include('components.footer')

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <!-- Scripts Extention -->
    @yield('scripts')

    @include('sweetalert::alert')
</body>

</html>
