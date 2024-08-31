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
                <li class="nav-small-cap"><span class="hide-menu">Applications</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('cms.users') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Pending User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('cms.active.users') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Aktif User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('cms.inactive.users') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Non-aktif User</span>
                    </a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Components</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="file-text" class="feather-icon"></i>
                        <span class="hide-menu">Forms</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                        <li class="sidebar-item">
                            <a href="form-inputs.html" class="sidebar-link">
                                <span class="hide-menu">Form Inputs</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="form-input-grid.html" class="sidebar-link">
                                <span class="hide-menu">Form Grids</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="form-checkbox-radio.html" class="sidebar-link">
                                <span class="hide-menu">Checkboxes & Radios</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Authentication</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="authentication-login1.html" aria-expanded="false">
                        <i data-feather="lock" class="feather-icon"></i>
                        <span class="hide-menu">Login</span>
                    </a>
                </li>
                
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="authentication-login1.html" aria-expanded="false">
                        <i data-feather="log-out" class="feather-icon"></i>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>
                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
