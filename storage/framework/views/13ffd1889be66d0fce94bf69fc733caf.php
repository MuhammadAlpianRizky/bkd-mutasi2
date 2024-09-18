<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>E-Mutasi BKD Banjarmasin</title>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('landing-page/assets/favicon.ico')); ?>" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?php echo e(asset('landing-page/css/styles.css')); ?>" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert CDN -->
</head>
<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container px-4">
            <a class="navbar-brand" href="#page-top">
                <img src="<?php echo e(asset('landing-page/assets/img/logo.png')); ?>" alt="Logo" style="height: 40px; width: auto; margin-right: 10px;">
                BKD DIKLAT KOTA BANJARMASIN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-primary bg-gradient text-white">
        <div class="container px-4 text-center">
            <h1 class="fw-bolder">E-MUTASI</h1>
            <p class="lead">Sistem Informasi Layanan Mutasi <br> Badan Kepegawaian Daerah Kota Banjarmasin</p>
            <a class="btn btn-lg btn-light" href="#tutorial">Panduan Aplikasi</a>
        </div>
    </header>

    <!-- Alert Partial -->
    

    <!-- Persyaratan Mutasi -->
    <section id="requirements" style="background-color: #f8f9fa; color: #000000; padding: 50px 0;">
        <div class="container px-4">
            <div class="row gx-4 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-center mb-4" style="margin-top: 35px">Persyaratan Mutasi</h2>
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
    <section class="bg-light" id="tutorial">
        <div class="container px-4">
            <div class="row gx-4 justify-content-center">
                <div class="col-lg-8">
                    <h2>Panduan Ajukan Mutasi</h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.</p>
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
                        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d245.77709469163923!2d114.58809136142916!3d-3.327518985058716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sbkd%20diklat!5e1!3m2!1sid!2sid!4v1724917240946!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-4 bg-dark">
        <div class="container px-4">
            <p class="m-0 text-center text-white">Copyright &copy; BKD DIKLAT BANJARMASIN 2024</p>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?php echo e(asset('landing-page/js/scripts.js')); ?>"></script>

    <!-- SweetAlert Script -->
    <?php if(session('alert')): ?>
        <script>
            Swal.fire({
                icon: '<?php echo e(session('alert.type')); ?>',
                title: 'Informasi',
                text: '<?php echo e(session('alert.message')); ?>',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>
</body>
</html>
<?php /**PATH D:\Kuliah\Semester 5\Magang\bkd-mutasi\resources\views/home.blade.php ENDPATH**/ ?>