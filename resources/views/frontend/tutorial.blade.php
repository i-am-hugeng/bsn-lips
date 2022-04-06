<!DOCTYPE html>
<html>
<head>

    <title>LIPS | Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/favicon.ico') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>
<body>
    {{-- Navbar Start --}}

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div>
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('logo/web-icon.png') }}" height="40px" alt="">
                    Layanan Internal Permintaan Standar
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Formulir Permintaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('tabel-permintaan') ? 'active' : '' }}" href="{{ url('/tabel-permintaan') }}">Tabel Permintaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('statistik') ? 'active' : '' }}" href="{{ url('/statistik') }}">Statistik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('tutorial') ? 'active' : '' }}" href="{{ url('/tutorial') }}">Tutorial</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Navbar End --}}

    {{-- Content Start --}}
    <div class="container row">
        <div class="col-md-3"></div>
        <div class="col-md-8 top-50 start-50 translate-middle">
            <div class="card mt-5 mb-5">
                <div class="card-header">
                    {{ __('Video Tutorial Pengisian Formulir Permintaan Dokumen Standar Internal') }}
                </div>
                <div class="card-body justify-content-center">
                    <video class="video" controls>
                        <source src="{{ asset('video-tutorial-lips.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
    {{-- Content End --}}

    {{-- Footer Start --}}
    <footer class="footer page-footer font-small text-white bg-dark">
        <div class="container">
            <div class="footer-copyright text-center py-3">Copyright © 2022
                <a href="https://bsn.go.id/" class="text-white"> Badan Standardisasi Nasional</a>
            </div>
        </div>
    </footer>
    {{-- Footer End --}}

</body>
{{-- <script src="{{asset('js/loading.js')}}"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
@include('sweetalert::alert')
</html>
