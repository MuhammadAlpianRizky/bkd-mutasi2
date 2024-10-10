<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>E-Mutasi BKD Diklat Banjarmasin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700&display=swap" rel="stylesheet">

    <style>
        html, body {
            height: 100%; /* Mengatur tinggi body menjadi 100% dari viewport */
            margin: 0; /* Menghilangkan margin default */
            display: flex; /* Mengubah layout menjadi flex */
            flex-direction: column; /* Mengatur arah layout vertikal */
            font-family: 'Montserrat', sans-serif;
        }

        .content {
            flex: 1; /* Mengisi ruang yang tersedia */
        }

        footer {
            background-color: black;
            color: white;
            padding: 20px; /* Memberikan padding untuk footer */
            text-align: center; /* Menyelaraskan teks di tengah */
        }

        .nav-link {
            position: relative;
        }

        .nav-link:hover::after {
            opacity: 1;
        }

        .nav-link::after {
            content:'';
            opacity: 0;
            transition: all 0.2s;
            height: 2px;
            width: 100%;
            background-color: white;
            position: absolute;
            bottom: 0;
            left: 0;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    @include('users.navbar')

    <!-- Main Content -->
    <main class="content" style="margin-top: 0px;">
        @yield('content')
    </main>

    <!-- Footer-->
    @if (!isset($noFooter)) <!-- Cek jika variabel $noFooter tidak di-set -->
        @include('users.footer') <!-- Include footer jika $noFooter tidak ada -->
    @endif
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
