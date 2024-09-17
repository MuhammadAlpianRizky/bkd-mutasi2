<?php $__env->startSection('content'); ?>
    
        <section id="apply" style="background-color: #f2ff00; color: #000000; padding: 60px 0; margin-top: 0px">
            <div class="container px-4 text-center">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="text-center mb-4">Ajukan Mutasi</h2>
                        <p class="mb-4">Jika Anda memenuhi semua persyaratan, Anda dapat melanjutkan untuk mengajukan permohonan mutasi dengan mengklik tombol di bawah ini.</p>
                        <a href="<?php echo e(route('mutasi.create')); ?>" class="btn btn-primary btn-lg" style="background-color: #0dcb0d; border-color: #2fff00;">Ajukan Mutasi</a>
                    </div>
                </div>
            </div>
        </section>
    
        <section id="requirements" style="background-color: #f8f9fa; color: #000000; padding: 50px 0;">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="text-center mb-4" style="margin-top: 35px">Persyaratan Mutasi</h2>
                        <ul class="list-unstyled" style="line-height: 1.5; text-align: justify;">
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Analisis Jabatan dan Analisis Beban Kerja dari Bagian organisasi yang dilegalisir BKD/yang dikeluarkan SKPD disalin oleh BKD.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Surat permohonan yang bersangkutan diketahui pimpinan unit kerja SKPD Asal.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Batas usia paling tinggi 50 (lima puluh) tahun (Peraturan Wali Kota Banjarmasin Nomor 109 Tahun 2022).</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Copy + legalisir SK CPNS.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Copy + legalisir SK PNS.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Copy + legalisir SK Pangkat Terakhir.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Copy + legalisir SK Jabatan Struktural. </span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Copy + legalisir SK Jabatan Fungsional.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Copy + legalisir SK Berkala Terakhir.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Copy + legalisir KARPEG.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Copy + legalisir Ijazah Terakhir + Akta IV (Akta IV hanya guru).</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Copy + legalisir SKP 2 Tahun Terakhir (legalisir semua halaman).</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Copy + legalisir Akta Nikah.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Daftar Riwayat Hidup sesuai Perka BKN No. 14 Tahun 2018 + foto KTP.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>SK/Surat Keterangan Bekerja Suami dari Instansi/Perusahaan (bagi PNS wanita yang mutasi karena mengikuti tugas suami).</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Surat Persetujuan dari Suami / Isteri yang Sah.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Surat Keterangan Sehat dari Dokter Pemerintah Kota Banjarmasin (Jasmani, Rohani dan NAPZA).</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Surat Keterangan tidak pernah dijatuhi hukuman disiplin dan tidak dalam proses pidana dari instansi yang bersangkutan dari BKD.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Surat Keterangan Tidak Sedang Tugas Belajar dan Ikatan Dinas dari BKD.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Surat Keterangan Bebas Temuan yang diterbitkan Inspektorat tempat asal PNS.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Surat Keterangan untuk Tidak Menuntut Jabatan di atas materai Rp 10.000.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Surat Keterangan tidak mempunyai Hutang Piutang dengan pihak Bank dan SKPD.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Surat Keterangan dari Penjabat yang berwenang yang menyatakan bahwa Permohonan Mutasi tidak sedang dalam proses Kenaikan Pangkat.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Surat Pernyataan bersedia mengikuti Tes Mutasi Masuk.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Surat Pernyataan Bersedia Ditempatkan Dimana Saja di Lingkungan Pemerintah Kota Banjarmasin di atas materai Rp 10.000.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Melampirkan Daftar Gaji Terakhir.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        
        <section id="contact" style="background-color: #000000; color: #ffffff; padding-top: 50px;">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-6">
                        <!-- Alamat -->
                        <h5 class="mbr-section-subtitle mbr-fonts-style mb-2 display-7"><strong>Alamat</strong></h5>
                        <p class="mbr-text mbr-fonts-style display-7">
                            Jalan. R.E. Martadinata No.1 Banjarmasin 70111 Komplek Balaikota Banjarmasin Gedung B Lantai 3 Kelurahan Kertak Baru Ilir, Kecamatan Banjarmasin Tengah, Kota Banjarmasin, Provinsi Kalimantan Selatan
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
                            Silahkan memberikan kritik dan saran terkait layanan kami ke alamat email yang tersedia. Terima kasih atas masukan yang telah diberikan.
                        </p>
                    </div>
                    <div class="col-lg-6">
                        
                        <div class="google-map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d245.77709469163923!2d114.58809136142916!3d-3.327518985058716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sbkd%20diklat!5e1!3m2!1sid!2sid!4v1724917240946!5m2!1sid!2sid"
                                width="100%"
                                height="300"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('users.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Semester 5\Magang\bkd-mutasi\resources\views\users\beranda.blade.php ENDPATH**/ ?>