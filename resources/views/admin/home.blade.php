<!-- resources/views/pages/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<style>
    #userStatusChart {
        width: 100% !important;  /* Ensure the canvas takes full width of its container */
        height: 400px !important; /* Fixed height for the chart */
    }
    .card {
        margin-bottom: 20px; /* Add space between cards */
    }
</style>


<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    {{-- <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ $welcomeMessage }}</h3>
            </div>
        </div>
    </div> --}}
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row">
            <!-- Card for Pending Users -->
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $pendingUsersCount }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0">User Pending</h6>
                            </div>
                            <div class="ms-auto">
                                <span class="text-muted"><i data-feather="user"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card for Active Users -->
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $activeUsersCount }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0">Sudah Divalidasi</h6>
                            </div>
                            <div class="ms-auto">
                                <span class="text-muted"><i data-feather="user-check"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card for Inactive Users -->
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $inactiveUsersCount }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0">Belum Divalidasi</h6>
                            </div>
                            <div class="ms-auto">
                                <span class="text-muted"><i data-feather="user-x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card for Mutasi -->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $mutasiCount }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0">Pengajuan Mutasi</h6>
                            </div>
                            <div class="ms-auto">
                                <span class="text-muted"><i data-feather="file"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graph for User Data -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Statistics</h4>
                        <canvas id="userStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>

<!-- Ensure Chart.js script is loaded -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('userStatusChart').getContext('2d');
        var userStatusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pending Users', 'Divalidasi', 'Belum Divalidasi'],
                datasets: [{
                    label: 'User Status',
                    data: [{{ $pendingUsersCount }}, {{ $activeUsersCount }}, {{ $inactiveUsersCount }}],
                    backgroundColor: ['#f39c12', '#2ecc71', '#e74c3c'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    });
</script>
@endsection
