<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>E-Mutasi BKD Banjarmasin</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('landing-page/assets/favicon.ico') }}" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('landing-page/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
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

        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
        }

        .video-container iframe {
            padding-top: 20px;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body id="page-top" >
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style ="background: rgba(0, 0, 0, 0.5); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);" id="mainNav">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#page-top" style="font-size: 14px">
                <img src="{{ asset('landing-page/assets/img/logo.png') }}" alt="Logo" style="height: 40px; width: auto; margin-right: 10px;">
                BKD DIKLAT BANJARMASIN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header-->
    <header class="text-white" style="position: relative; background-image: url('{{ asset('wallps/menarapandang.jpg') }}'); background-size: cover; background-position: center;">
        <!-- Overlay Hitam -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>

        <!-- Konten -->
        <div class="container px-4 text-center" style="position: relative; z-index: 2; padding: 2rem;">
            <h1 class="fw-bolder">E-MUTASI</h1>
            <p class="lead" style="font-weight: 500;">Sistem Informasi Layanan Mutasi <br> Badan Kepegawaian Daerah Kota Banjarmasin</p>
            <a class="btn btn-lg btn-light" href="#tutorial">Panduan Aplikasi</a>
        </div>
    </header>


    <!-- Alert Partial -->
    {{-- <div class="container mt-4">
        @include('partials.alert')
    </div> --}}

    <!-- Persyaratan Mutasi -->
    <section id="requirements" style="background-color: #e8e9dc; color: #222222; padding: 50px 0;">
        <div class="container px-4">
            <div class="row gx-4 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-center mb-4 fw-bold" style="margin-top: 35px">Persyaratan Mutasi</h2><br>
                    <ul class="list-unstyled" style="line-height: 1.5; text-align: justify;">
                        <!-- List items -->
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Analisis Jabatan dan Analisis Beban Kerja dari Bagian organisasi yang dilegalisir BKD/yang dikeluarkan SKPD disalin oleh BKD.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Surat permohonan yang bersangkutan diketahui pimpinan unit kerja SKPD Asal.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Batas usia paling tinggi 50 (lima puluh) tahun (Peraturan Wali Kota Banjarmasin Nomor 109 Tahun 2022).</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>pangkat Gol. Ruang Penjabat Struktural dan Penjabat Fungsional Umum Paling Tinggi Penata Tingkat I (III/d) dan Penjabat Fungsional Tertentu Paling Tinggi Pembina (IV. a) (Peraturan Wali Kota Banjarmasin Nomor 109 Tahun 2022) .</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Copy + legalisir SK CPNS.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Copy + legalisir SK PNS.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Copy + legalisir SK Pangkat Terakhir.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Copy + legalisir SK Jabatan Struktural. </span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Copy + legalisir SK Jabatan Fungsional.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Copy + legalisir SK Berkala Terakhir.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Copy + legalisir KARPEG.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Copy + legalisir Ijazah Terakhir + Akta IV (Akta IV hanya guru).</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Copy + legalisir SKP 2 Tahun Terakhir (legalisir semua halaman).</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Copy + legalisir Akta Nikah.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Daftar Riwayat Hidup sesuai Perka BKN No. 14 Tahun 2018 + foto KTP.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>SK/Surat Keterangan Bekerja Suami dari Instansi/Perusahaan (bagi PNS wanita yang mutasi karena mengikuti tugas suami).</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Surat Persetujuan dari Suami / Isteri yang Sah.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Surat Keterangan Sehat dari Dokter Pemerintah Kota Banjarmasin (Jasmani, Rohani dan NAPZA).</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Surat Keterangan tidak pernah dijatuhi hukuman disiplin dan tidak dalam proses pidana dari instansi yang bersangkutan dari BKD.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Surat Keterangan Tidak Sedang Tugas Belajar dan Ikatan Dinas dari BKD.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Surat Keterangan Bebas Temuan yang diterbitkan Inspektorat tempat asal PNS.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Surat Keterangan untuk Tidak Menuntut Jabatan di atas materai Rp 10.000.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Surat Keterangan tidak mempunyai Hutang Piutang dengan pihak Bank dan SKPD.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Surat Keterangan dari Penjabat yang berwenang yang menyatakan bahwa Permohonan Mutasi tidak sedang dalam proses Kenaikan Pangkat.</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i><span>Surat Keterangan Bebas dari Kegiatan Dinas/Instansi yang bersangkutan.</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Panduan section-->
    <section class="bg-light" id="tutorial" style="background-image: linear-gradient(#e8e9dc, white);">
        <div class="container px-4">
            <div class="row gx-4 justify-content-center">
                <div class="col-lg-8" style="margin: 0 auto; text-align: center;">
                    <h2 class="fw-bold" style="color: #222222">Panduan Ajukan Mutasi</h2>
                    <div class="video-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/e62K9660bEg?si=c_aycvoWdxyzSIg9" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact section-->
    <section id="contact" style="background-color: #000000; color: #ffffff;">
        <div class="container px-4">
            <div class="row gx-4 justify-content-center">
                <div class="col-lg-6">
                    <!-- Alamat -->
                    <h5 class="mbr-section-subtitle mbr-fonts-style mb-2 display-7"><strong>Alamat</strong></h5>
                    <p class="mbr-text mbr-fonts-style display-7">
                        Jalan. R.E. Martadinata No.1 Banjarmasin
                    </p>

                    <!-- Kontak -->
                    <h5 class="mbr-section-subtitle mbr-fonts-style mb-2 mt-4 display-7"><strong>Kontak</strong></h5>
                    <p class="mbr-text mbr-fonts-style display-7">
                        Email: <a href="mailto:bkd@mail.banjarmasinkota.go.id" style="color: #ffffff;">bkd@mail.banjarmasinkota.go.id</a><br>
                        Phone: <a href="tel:+625114772059" style="color: #ffffff;">0511-3363790</a><br>
                        Fax: 0511-3363790
                    </p>

                    <!-- Feedback -->
                    <h5 class="mbr-section-subtitle mbr-fonts-style mb-2 mt-4 display-7"><strong>Feedback</strong></h5>
                    <p class="mbr-text mbr-fonts-style mb-4 display-7">
                        Silahkan memberikan kritik dan saran terkait layanan kami melalui email atau telepon di atas.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="google-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d245.77709469163923!2d114.58809136142916!3d-3.327518985058716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sbkd%20diklat!5e1!3m2!1sid!2sid!4v1724917240946!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-3" style="background-color: black">
        <div class="container px-4">
            <p class="m-0 text-center text-white">Copyright &copy; BKD DIKLAT BANJARMASIN 2024</p>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('landing-page/js/scripts.js') }}"></script>

    <!-- SweetAlert Script -->
    @if(session('alert'))
        <script>
            Swal.fire({
                icon: '{{ session('alert.type') }}',
                title: 'Informasi',
                text: '{{ session('alert.message') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

</body>
</html>
