<!-- resources/views/partials/sidebar.blade.php -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">User</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('cms.users') }}" aria-expanded="false">
                        <i data-feather="user-plus" class="feather-icon"></i>
                        <span class="hide-menu">User Pending</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('cms.active.users') }}" aria-expanded="false">
                        <i data-feather="user-check" class="feather-icon"></i>
                        <span class="hide-menu">User Aktif</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('cms.inactive.users') }}" aria-expanded="false">
                        <i data-feather="user-x" class="feather-icon"></i>
                        <span class="hide-menu">User Non-Aktif</span>
                    </a>
                </li>

                <li class="nav-small-cap"><span class="hide-menu">Dokumen</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('mutasi.list') }}" aria-expanded="false">
                        <i data-feather="list" class="feather-icon"></i>
                        <span class="hide-menu">Daftar Mutasi</span>
                    </a>
                </li>

                <li class="nav-small-cap"><span class="hide-menu">Persyaratan</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('persyaratan.index') }}" aria-expanded="false">
                        <i data-feather="file-text" class="feather-icon"></i>
                        <span class="hide-menu">Daftar Persyaratan</span>
                    </a>
                </li>

                <li class="nav-small-cap"><span class="hide-menu">Undangan</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('undangan.index') }}" aria-expanded="false">
                        <i data-feather="mail" class="feather-icon"></i>
                        <span class="hide-menu">Undangan Mutasi</span>
                    </a>
                </li>

                <li class="nav-small-cap"><span class="hide-menu">Pengumuman</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('pengumuman.index') }}" aria-expanded="false">
                        <i data-feather="mail" class="feather-icon"></i>
                        <span class="hide-menu">Pengumuman</span>
                    </a>
                </li>

                <!-- Add more links if needed -->
            </ul>
        </nav>
        <!-- End Sidebar navigation-->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

<!-- Add the following JavaScript for the 1500ms delay -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Pilih semua tautan sidebar
        const sidebarLinks = document.querySelectorAll('.sidebar-link');

        // Tambahkan pendengar acara klik untuk setiap tautan
        sidebarLinks.forEach(link => {
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

<!-- Bootstrap CSS untuk spinner (jika belum disertakan dalam proyek) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
