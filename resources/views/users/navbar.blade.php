<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: rgba(0, 0, 0, 0.5); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);" id="mainNav">
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
                <li class="nav-item"><a class="nav-link nav-delay" href="{{ route('landing') }}" style="font-size: 16px;">Beranda</a></li>
                <li class="nav-item"><a class="nav-link nav-delay" href="{{ route('mutasi') }}" style="font-size: 16px;">Mutasi</a></li>
                <li class="nav-item"><a class="nav-link nav-delay" href="{{ route('logout') }}" style="font-size: 16px;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- Loading Animation -->
    <div id="loading" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.7); z-index: 9999; text-align: center; justify-content: center; align-items: center;">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</nav>

<!-- JavaScript for Delay and Loading Animation -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Select all navigation links with the 'nav-delay' class
        const navLinks = document.querySelectorAll('.nav-delay');
        
        // Add click event listener to each link
        navLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent immediate navigation

                // Get the URL from the clicked link
                const url = this.getAttribute('href');

                // Show loading animation
                document.getElementById('loading').style.display = 'flex';

                // Add a delay of 500ms before navigating
                setTimeout(() => {
                    window.location.href = url;
                }, 1000); // 1000ms delay
            });
        });
    });
</script>
