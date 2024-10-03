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
                <!-- Persyaratan CRUD Links -->
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('persyaratan.index') }}" aria-expanded="false">
                        <i data-feather="file-text" class="feather-icon"></i>
                        <span class="hide-menu">Daftar Persyaratan</span>
                    </a>
                </li>
                {{-- <li class="nav-small-cap"><span class="hide-menu">Undangan</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('mutasi.invited') }}" aria-expanded="false">
                        <i data-feather="mail" class="feather-icon"></i>
                        <span class="hide-menu">Undangan Mutasi</span>
                    </a>
                </li> --}}

                {{-- <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('persyaratan.create') }}" aria-expanded="false">
                        <i data-feather="file-plus" class="feather-icon"></i>
                        <span class="hide-menu">Tambah Persyaratan</span>
                    </a>
                </li> --}}
                <!-- Add more links if needed -->
                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
