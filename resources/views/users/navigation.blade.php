<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: rgba(0, 0, 0, 0.5); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);" id="mainNav">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#page-top" style="font-size: 14px">
            <img src="{{ asset('landing-page/assets/img/bkddiklat.png') }}" alt="Logo" style="height: 40px; width: auto; margin-right: 10px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link nav-delay" href="{{ route('landing') }}">Beranda</a></li>
                @if ($pengumumans->isNotEmpty())
                    <li class="nav-item"><a class="nav-link nav-delay" href="{{ route('pengumuman') }}">Pengumuman</a></li>
                @endif
                <li class="nav-item"><a class="nav-link nav-delay" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link nav-delay" href="{{ route('register') }}">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- JavaScript untuk Delay Navigasi -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Pilih semua tautan navigasi dengan kelas 'nav-delay'
        const navLinks = document.querySelectorAll('.nav-delay');

        // Tambahkan pendengar acara klik untuk setiap tautan
        navLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault(); // Cegah navigasi langsung

                // Dapatkan URL dari tautan yang diklik
                const url = this.getAttribute('href');

                // Tambahkan delay 1000ms sebelum navigasi
                setTimeout(() => {
                    window.location.href = url;
                }, 1000); // Delay 1000ms
            });
        });
    });
</script>
