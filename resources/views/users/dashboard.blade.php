<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Mutasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    {{-- Navbar --}}
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

    <!-- Main Content -->
    <main class="content" style="margin-top: 0px;">
        @yield('content')
    </main>

    <!-- Footer-->
    <footer style="padding: 20px;" class="py-4 bg-dark">
        <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; BKD DIKLAT BANJARMASIN 2024</p></div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
