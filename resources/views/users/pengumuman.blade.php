<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Title -->
    <title>E-Mutasi BKD Banjarmasin</title>

    <!-- Core Theme CSS (includes Bootstrap) -->
    <link href="{{ asset('landing-page/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('landing-page/css/beranda.css') }}" rel="stylesheet" />
    <link href="{{ asset('pengumumancss/css/file.css') }}" rel="stylesheet" />

    <!-- Bootstrap and Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700&display=swap" rel="stylesheet">

</head>
<body id="page-top">
    <!-- Navigation -->
    @include('users.navigation')

    <!-- Pengumuman Section -->
    <section id="pengumuman">
        <div class="container" style="margin-top: 80px">
            @foreach($pengumumans as $pengumuman)
                <div class="card mx-auto my-4" style="max-width: 64rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $pengumuman->judul }}</h5>
                        <p class="card-text text-muted">{{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('l, d F Y') }}</p>
                        <p class="card-text">{{ $pengumuman->deskripsi }}</p>
                        @if($pengumuman->file_path) <!-- Memastikan ada file yang diupload -->
                            <a href="{{ route('pengumuman.show', $pengumuman) }}" class="btn btn-sm btn-primary" target="_blank">
                                <i class="fa fa-download"></i> Dokumen Pengumuman
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Contact -->
    @include('users.contact')

    <!-- Footer -->
    @include('users.footer')

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
