<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
        <div class="container px-4">
            <a class="navbar-brand" href="#page-top">
                <img src="{{ asset('landing-page/assets/img/logo.png') }}" alt="Logo" style="height: 40px; width: auto; margin-right: 10px;">
                <span style="font-size: 16px;">BKD DIKLAT BANJARMASIN</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}" style="font-size: 16px;">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('mutasi') }}" style="font-size: 16px;">Mutasi</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="#" style="font-size: 16px;"><i class="fas fa-user"></i> Profil</a></li> --}}
                    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}" style="font-size: 16px;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
</nav>
