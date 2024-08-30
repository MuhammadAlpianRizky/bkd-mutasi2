<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>E-Mutasi BKD Banjarmasin</title>
        <link rel="icon" type="image/x-icon" href="{{ 'landing-page/assets/favicon.ico'  }}" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('landing-page/css/styles.css') }}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container px-4">
                 <a class="navbar-brand" href="#page-top">
                <img src="{{ asset('landing-page/assets/img/logo.png') }}" alt="Logo" style="height: 40px; width: auto; margin-right: 10px;">
                BKD DIKLAT KOTA BANJARMASIN
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        {{-- <li class="nav-item"><a class="nav-link" href="#about">About</a></li> --}}
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
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
        <!-- About section-->
        <section id="about">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                        <h2>Persyaratan Mutasi</h2>
                        <p class="lead">This is a great place to talk about your webpage. This template is purposefully unstyled so you can use it as a boilerplate or starting point for you own landing page designs! This template features:</p>
                        <ul>
                            <li>Clickable nav links that smooth scroll to page sections</li>
                            <li>Responsive behavior when clicking nav links perfect for a one page website</li>
                            <li>Bootstrap's scrollspy feature which highlights which section of the page you're on in the navbar</li>
                            <li>Minimal custom CSS so you are free to explore your own unique design options</li>
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
                        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut optio velit inventore, expedita quo laboriosam possimus ea consequatur vitae, doloribus consequuntur ex. Nemo assumenda laborum vel, labore ut velit dignissimos.</p>
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
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                
            </div>
            </div>
            </div>
        </section>


        <!-- Footer-->
        <footer class="py-4 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; BKD DIKLAT BANJARMASIN 2024</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('landing-page/js/scripts.js') }}"></script>
    </body>
</html>
