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
