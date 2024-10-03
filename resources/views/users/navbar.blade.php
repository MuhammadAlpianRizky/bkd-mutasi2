<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style ="background: rgba(0, 0, 0, 0.5); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);" id="mainNav">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#page-top" style="font-size: 14px">
                <img src="{{ asset('landing-page/assets/img/logo.png') }}" alt="Logo" style="height: 30px; width: auto; margin-right: 10px;">
                BKD DIKLAT KOTA BANJARMASIN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}" style="font-size: 16px;">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pengumuman') }}" style="font-size: 16px;">Pengumuman</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('mutasi') }}" style="font-size: 16px;">Mutasi</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="#" style="font-size: 16px;"><i class="fas fa-user"></i> Profil</a></li> --}}
                    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}" style="font-size: 16px;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
</nav>
