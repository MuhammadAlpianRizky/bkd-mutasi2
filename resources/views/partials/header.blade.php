<style>
    /* Hover state */
    a#validateLogout:hover {
        background-color: #77838d; /* Gray color */
        color: #fff; /* White text */
    }

    /* Active (click) state */
    a#validateLogout:active {
        background-color: #5a6268; /* Slightly darker gray */
    }
</style>

<!-- resources/views/partials/header.blade.php -->
<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar" data-navbarbg="skin6" >
    <nav class="navbar top-navbar navbar-expand-lg">
        <div class="navbar-header" data-logobg="skin6">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-brand">
                <!-- Logo icon -->
                <a href="index.html">
                    <img src="{{ asset('assets/images/freedashDark.svg') }}" alt="" class="img-fluid">
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right ms-auto ms-3 ps-1">
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none; align-items: center">
                        @csrf
                        </form>
                        <a class="dropdown-item py-2 rounded" style="transition: background-color 0.3s, color 0.3s;" href="javascript:void(0)" id="validateLogout" document.getElementById('logout-form').submit();"><i data-feather="power" class="svg-icon me-2"></i>Log Out</a>
                    </a>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->

<script>
    document.getElementById('validateLogout').addEventListener('click', function() {
        Swal.fire({
            title: 'Apakah Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, keluar!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();  // Submit the form
            }
        });
    });
    </script>
